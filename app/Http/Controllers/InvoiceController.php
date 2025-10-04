<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\RepairEquipment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
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
        $invoices = Invoice::with(['repairEquipment.brand', 'repairEquipment.type', 'repairEquipment.model', 'repairEquipment.assignedTechnician', 'ticket', 'createdBy', 'items'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json($invoices);
    }

    /**
     * Crear una factura en borrador a partir de un equipo de reparación
     */
    public function createFromEquipment($equipmentId)
    {
        $equipment = \App\Models\RepairEquipment::with(['tickets', 'brand', 'model'])->findOrFail($equipmentId);

        $invoice = Invoice::create([
            'invoice_number' => Invoice::generateInvoiceNumber(),
            'repair_equipment_id' => $equipment->id,
            'ticket_id' => $equipment->ticket_number, // Usar el número de ticket como string
            'customer_name' => $equipment->customer_name,
            'customer_phone' => $equipment->customer_phone,
            'customer_email' => $equipment->customer_email,
            'customer_address' => $equipment->customer_address,
            'customer_tax_id' => $equipment->customer_tax_id,
            'invoice_date' => now()->toDateString(),
            'due_date' => now()->addDays(15)->toDateString(),
            'status' => 'draft',
            'notes' => 'Factura creada desde equipo ' . ($equipment->brand->name ?? '') . ' ' . ($equipment->model->name ?? '') . ' (Ticket: ' . ($equipment->ticket_number ?? 'N/A') . ')',
            'created_by' => Auth::id()
        ]);

        return response()->json([
            'message' => 'Factura en borrador creada desde el equipo',
            'invoice' => $invoice->load(['repairEquipment.brand', 'repairEquipment.model', 'ticket', 'items'])
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener equipos de reparación que no tienen factura
        $equipments = RepairEquipment::whereDoesntHave('invoices')
            ->with(['brand', 'type', 'model', 'assignedTechnician'])
            ->get();

        // Obtener tickets disponibles
        $tickets = Ticket::with(['repairEquipment'])
            ->get();

        return response()->json([
            'equipments' => $equipments,
            'tickets' => $tickets
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'repair_equipment_id' => 'required|exists:repair_equipment,id',
            'ticket_id' => 'nullable|exists:tickets,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'customer_address' => 'nullable|string',
            'customer_tax_id' => 'nullable|string|max:50',
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date|after:invoice_date',
            'payment_method' => 'nullable|in:cash,card,transfer,check,credit',
            'notes' => 'nullable|string',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'discount_amount' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.item_type' => 'required|in:service,product,part',
            'items.*.item_name' => 'required|string|max:255',
            'items.*.description' => 'nullable|string',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit' => 'required|string|max:20',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.discount_percentage' => 'nullable|numeric|min:0|max:100',
            'items.*.tax_rate' => 'nullable|numeric|min:0|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Crear la factura
        $invoice = Invoice::create([
            'invoice_number' => Invoice::generateInvoiceNumber(),
            'repair_equipment_id' => $request->repair_equipment_id,
            'ticket_id' => $request->ticket_id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'customer_address' => $request->customer_address,
            'customer_tax_id' => $request->customer_tax_id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'status' => 'draft',
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
            'tax_rate' => $request->tax_rate,
            'discount_amount' => $request->discount_amount ?? 0,
            'created_by' => Auth::id()
        ]);

        // Crear los items de la factura
        foreach ($request->items as $itemData) {
            $item = InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'item_type' => $itemData['item_type'],
                'item_name' => $itemData['item_name'],
                'description' => $itemData['description'] ?? null,
                'quantity' => $itemData['quantity'],
                'unit' => $itemData['unit'],
                'unit_price' => $itemData['unit_price'],
                'discount_percentage' => $itemData['discount_percentage'] ?? 0,
                'tax_rate' => $itemData['tax_rate'] ?? $request->tax_rate
            ]);

            $item->calculateTotal();
        }

        // Calcular totales de la factura
        $invoice->calculateTotals();

        return response()->json([
            'message' => 'Factura creada exitosamente',
            'invoice' => $invoice->load(['items', 'repairEquipment', 'ticket', 'createdBy'])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::with(['items', 'repairEquipment.brand', 'repairEquipment.type', 'repairEquipment.model', 'ticket', 'createdBy', 'updatedBy'])
            ->findOrFail($id);

        return response()->json($invoice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'customer_address' => 'nullable|string',
            'customer_tax_id' => 'nullable|string|max:50',
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date|after:invoice_date',
            'status' => 'required|in:draft,sent,paid,overdue,cancelled',
            'payment_method' => 'nullable|in:cash,card,transfer,check,credit',
            'notes' => 'nullable|string',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'discount_amount' => 'nullable|numeric|min:0',
            'paid_date' => 'nullable|date',
            'payment_reference' => 'nullable|string',
            'payment_notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $invoice->update([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'customer_address' => $request->customer_address,
            'customer_tax_id' => $request->customer_tax_id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
            'tax_rate' => $request->tax_rate,
            'discount_amount' => $request->discount_amount ?? 0,
            'paid_date' => $request->paid_date,
            'payment_reference' => $request->payment_reference,
            'payment_notes' => $request->payment_notes,
            'updated_by' => Auth::id()
        ]);

        // Si se actualizaron los items
        if ($request->has('items')) {
            // Eliminar items existentes
            $invoice->items()->delete();

            // Crear nuevos items
            foreach ($request->items as $itemData) {
                $item = InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'item_type' => $itemData['item_type'],
                    'item_name' => $itemData['item_name'],
                    'description' => $itemData['description'] ?? null,
                    'quantity' => $itemData['quantity'],
                    'unit' => $itemData['unit'],
                    'unit_price' => $itemData['unit_price'],
                    'discount_percentage' => $itemData['discount_percentage'] ?? 0,
                    'tax_rate' => $itemData['tax_rate'] ?? $request->tax_rate
                ]);

                $item->calculateTotal();
            }

            // Recalcular totales
            $invoice->calculateTotals();
        }

        return response()->json([
            'message' => 'Factura actualizada exitosamente',
            'invoice' => $invoice->load(['items', 'repairEquipment', 'ticket', 'createdBy'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return response()->json(['message' => 'Factura eliminada exitosamente']);
    }

    /**
     * Marcar factura como pagada
     */
    public function markAsPaid(Request $request, string $id)
    {
        $invoice = Invoice::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'payment_method' => 'required|in:cash,card,transfer,check,credit',
            'payment_reference' => 'nullable|string',
            'payment_notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $invoice->update([
            'status' => 'paid',
            'payment_method' => $request->payment_method,
            'paid_date' => now(),
            'payment_reference' => $request->payment_reference,
            'payment_notes' => $request->payment_notes,
            'updated_by' => Auth::id()
        ]);

        return response()->json([
            'message' => 'Factura marcada como pagada',
            'invoice' => $invoice
        ]);
    }

    /**
     * Obtener facturas por estado
     */
    public function getByStatus(string $status)
    {
        $invoices = Invoice::with(['repairEquipment', 'ticket', 'createdBy'])
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($invoices);
    }

    /**
     * Obtener facturas vencidas
     */
    public function getOverdue()
    {
        $invoices = Invoice::overdue()
            ->with(['repairEquipment', 'ticket', 'createdBy'])
            ->orderBy('due_date', 'asc')
            ->get();

        return response()->json($invoices);
    }
}