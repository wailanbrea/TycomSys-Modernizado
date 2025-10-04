<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RepairEquipment;
use App\Models\EquipmentStatus;
use App\Models\User;
use App\Models\Invoice;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RepairEquipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipments = RepairEquipment::with([
            'assignedTechnician', 
            'createdBy', 
            'statusHistory',
            'invoices' => function($query) {
                $query->orderBy('created_at', 'desc');
            }
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json($equipments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technicians = User::whereHas('roles', function($query) {
            $query->where('name', 'tecnico');
        })->select('id', 'name', 'email')->get();

        return response()->json([
            'technicians' => $technicians
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('🔧 RepairEquipment Store - Request received', [
            'user_id' => Auth::id(),
            'data' => $request->all(),
            'headers' => $request->headers->all(),
            'content_type' => $request->header('Content-Type')
        ]);

        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'brand_id' => 'required|exists:equipment_brands,id',
            'type_id' => 'required|exists:equipment_types,id',
            'model_id' => 'required|exists:equipment_models,id',
            'serial_number' => 'nullable|string|max:255',
            'problem_description' => 'required|string',
            'accessories' => 'nullable|string',
            'notes' => 'nullable|string',
            'estimated_cost' => 'nullable|numeric|min:0',
            'estimated_delivery' => 'nullable|date',
            'assigned_technician_id' => 'nullable|exists:users,id'
        ]);

        if ($validator->fails()) {
            \Log::error('🔧 Validation failed', ['errors' => $validator->errors()->toArray()]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            \Log::info('🔧 Starting transaction...');
            DB::beginTransaction();

            $equipmentData = [
                'ticket_number' => RepairEquipment::generateTicketNumber(),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                'brand_id' => $request->brand_id,
                'type_id' => $request->type_id,
                'model_id' => $request->model_id,
                'serial_number' => $request->serial_number,
                'problem_description' => $request->problem_description,
                'accessories' => $request->accessories,
                'notes' => $request->notes,
                'estimated_cost' => $request->estimated_cost,
                'estimated_delivery' => $request->estimated_delivery,
                'assigned_technician_id' => $request->assigned_technician_id,
                'created_by' => Auth::id(),
                'status' => 'received'
            ];

            \Log::info('🔧 Creating equipment with data:', $equipmentData);
            $equipment = RepairEquipment::create($equipmentData);
            \Log::info('🔧 Equipment created successfully with ID:', ['id' => $equipment->id]);

            // Crear primer estado
            EquipmentStatus::create([
                'repair_equipment_id' => $equipment->id,
                'status' => 'received',
                'description' => 'Equipo recibido en el sistema',
                'updated_by' => Auth::id()
            ]);

            // Crear factura automáticamente en borrador (temporalmente deshabilitado para debugging)
            try {
                $invoice = $this->createAutoInvoice($equipment);
                \Log::info('🔧 Auto invoice created successfully');
            } catch (\Exception $invoiceError) {
                \Log::warning('🔧 Auto invoice creation failed, continuing without invoice:', [
                    'message' => $invoiceError->getMessage()
                ]);
                $invoice = null;
            }

            DB::commit();

            return response()->json([
                'message' => 'Equipo registrado exitosamente' . ($invoice ? '. Factura en borrador creada automáticamente.' : '.'),
                'equipment' => $equipment->load(['assignedTechnician', 'createdBy', 'invoices']),
                'invoice' => $invoice
            ], 201);

        } catch (\Exception $e) {
            \Log::error('🔧 Error creating equipment:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            DB::rollBack();
            return response()->json([
                'message' => 'Error al registrar el equipo: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipment = RepairEquipment::with([
            'assignedTechnician', 
            'createdBy', 
            'statusHistory.updatedBy'
        ])->findOrFail($id);

        return response()->json($equipment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $equipment = RepairEquipment::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'brand_id' => 'required|exists:equipment_brands,id',
            'type_id' => 'required|exists:equipment_types,id',
            'model_id' => 'required|exists:equipment_models,id',
            'serial_number' => 'nullable|string|max:255',
            'problem_description' => 'required|string',
            'accessories' => 'nullable|string',
            'notes' => 'nullable|string',
            'estimated_cost' => 'nullable|numeric|min:0',
            'final_cost' => 'nullable|numeric|min:0',
            'estimated_delivery' => 'nullable|date',
            'assigned_technician_id' => 'nullable|exists:users,id',
            'status' => 'required|in:received,in_review,in_repair,waiting_parts,ready,delivered,cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $oldStatus = $equipment->status;
        $equipment->update($request->all());

        // Si el estado cambió, crear nuevo registro de estado
        if ($oldStatus !== $request->status) {
            EquipmentStatus::create([
                'repair_equipment_id' => $equipment->id,
                'status' => $request->status,
                'description' => $request->status_description ?? 'Estado actualizado',
                'notes' => $request->status_notes,
                'updated_by' => Auth::id()
            ]);

            // Si se marca como entregado, actualizar fecha de entrega
            if ($request->status === 'delivered') {
                $equipment->update(['delivered_at' => now()]);
            }
        }

        return response()->json([
            'message' => 'Equipo actualizado exitosamente',
            'equipment' => $equipment->load(['assignedTechnician', 'createdBy', 'statusHistory'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipment = RepairEquipment::findOrFail($id);
        $equipment->delete();

        return response()->json(['message' => 'Equipo eliminado exitosamente']);
    }

    /**
     * Update equipment status
     */
    public function updateStatus(Request $request, string $id)
    {
        $equipment = RepairEquipment::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:received,in_review,in_repair,waiting_parts,ready,delivered,cancelled',
            'description' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $oldStatus = $equipment->status;
        $equipment->update(['status' => $request->status]);

        // Crear nuevo registro de estado
        EquipmentStatus::create([
            'repair_equipment_id' => $equipment->id,
            'status' => $request->status,
            'description' => $request->description,
            'notes' => $request->notes,
            'updated_by' => Auth::id()
        ]);

        // Si se marca como entregado, actualizar fecha de entrega
        if ($request->status === 'delivered') {
            $equipment->update(['delivered_at' => now()]);
        }

        return response()->json([
            'message' => 'Estado actualizado exitosamente',
            'equipment' => $equipment->load(['assignedTechnician', 'createdBy', 'statusHistory'])
        ]);
    }

    /**
     * Get equipment by ticket number (for customer query)
     */
    public function getByTicketNumber(string $ticketNumber)
    {
        $equipment = RepairEquipment::with([
            'assignedTechnician', 
            'statusHistory.updatedBy'
        ])->where('ticket_number', $ticketNumber)->first();

        if (!$equipment) {
            return response()->json(['message' => 'Equipo no encontrado'], 404);
        }

        return response()->json($equipment);
    }

    /**
     * Crear factura automáticamente para un equipo
     */
    private function createAutoInvoice(RepairEquipment $equipment)
    {
        \Log::info('🔧 Creating auto invoice for equipment:', ['equipment_id' => $equipment->id]);
        
        try {
            $invoiceNumber = Invoice::generateInvoiceNumber();
            \Log::info('🔧 Generated invoice number:', ['invoice_number' => $invoiceNumber]);
            
            $invoice = new Invoice([
                'invoice_number' => $invoiceNumber,
                'repair_equipment_id' => $equipment->id,
                'ticket_id' => $equipment->ticket_number, // Almacenar como string
                'customer_name' => $equipment->customer_name,
                'customer_phone' => $equipment->customer_phone,
                'customer_email' => $equipment->customer_email,
                'customer_address' => $equipment->customer_address ?? '',
                'customer_tax_id' => $equipment->customer_tax_id ?? '',
                'invoice_date' => now(),
                'due_date' => now()->addDays(15), // 15 días para pago
                'status' => 'draft',
                'notes' => 'Factura generada automáticamente al recibir el equipo. Ticket: ' . $equipment->ticket_number,
            ]);
            $invoice->created_by = Auth::id();
            $invoice->save();
            \Log::info('🔧 Invoice created successfully:', ['invoice_id' => $invoice->id]);

            // Cargar relaciones necesarias
            $equipment->load(['brand', 'model']);
            
            // Añadir item de diagnóstico por defecto
            $invoice->items()->create([
                'item_type' => 'service',
                'item_name' => 'Diagnóstico de Equipo',
                'description' => 'Revisión inicial del equipo ' . $equipment->brand->name . ' ' . $equipment->model->name,
                'quantity' => 1,
                'unit' => 'hrs',
                'unit_price' => SystemSetting::get('default_diagnostic_price', 250.00),
                'tax_rate' => SystemSetting::get('default_tax_rate', 16.00),
            ]);

            $invoice->calculateTotals();
            $invoice->save();
            \Log::info('🔧 Invoice totals calculated and saved');

            return $invoice->load('items');
        } catch (\Exception $e) {
            \Log::error('🔧 Error creating auto invoice:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            throw $e;
        }
    }
}
