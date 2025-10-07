<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers
     */
    public function index(Request $request)
    {
        $query = Customer::with(['createdBy', 'updatedBy']);

        // Búsqueda
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        // Filtro por tipo
        if ($request->has('customer_type') && $request->customer_type) {
            $query->where('customer_type', $request->customer_type);
        }

        // Filtro por estado
        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        // Ordenamiento
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $customers = $query->paginate(20);

        return response()->json($customers);
    }

    /**
     * Store a newly created customer
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_type' => 'required|in:individual,company',
            'first_name' => 'required_if:customer_type,individual|nullable|string|max:255',
            'last_name' => 'required_if:customer_type,individual|nullable|string|max:255',
            'company_name' => 'required_if:customer_type,company|nullable|string|max:255',
            'tax_id' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'mobile' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'notes' => 'nullable|string',
            'status' => 'boolean',
            'payment_terms' => 'nullable|integer|min:0',
            'credit_limit' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['created_by'] = Auth::id();
        $data['status'] = $request->has('status') ? $request->status : true;

        $customer = Customer::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Cliente creado exitosamente',
            'customer' => $customer->load(['createdBy'])
        ], 201);
    }

    /**
     * Display the specified customer
     */
    public function show($id)
    {
        $customer = Customer::with([
            'createdBy',
            'updatedBy',
            'invoices.items',
            'repairEquipments.assignedTechnician',
            'tickets.assignedTechnician'
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified customer
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'customer_type' => 'required|in:individual,company',
            'first_name' => 'required_if:customer_type,individual|nullable|string|max:255',
            'last_name' => 'required_if:customer_type,individual|nullable|string|max:255',
            'company_name' => 'required_if:customer_type,company|nullable|string|max:255',
            'tax_id' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'mobile' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'notes' => 'nullable|string',
            'status' => 'boolean',
            'payment_terms' => 'nullable|integer|min:0',
            'credit_limit' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['updated_by'] = Auth::id();

        $customer->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Cliente actualizado exitosamente',
            'customer' => $customer->load(['createdBy', 'updatedBy'])
        ]);
    }

    /**
     * Remove the specified customer
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        // Verificar si tiene facturas o reparaciones asociadas
        $hasInvoices = $customer->invoices()->exists();
        $hasRepairs = $customer->repairEquipments()->exists();

        if ($hasInvoices || $hasRepairs) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar el cliente porque tiene facturas o reparaciones asociadas. Considere desactivarlo en su lugar.'
            ], 400);
        }

        $customer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cliente eliminado exitosamente'
        ]);
    }

    /**
     * Get customer history (invoices, repairs, tickets)
     */
    public function history($id)
    {
        $customer = Customer::findOrFail($id);
        $history = $customer->getHistory();

        return response()->json([
            'success' => true,
            'customer' => $customer,
            'history' => $history
        ]);
    }

    /**
     * Get customer statistics
     */
    public function statistics($id)
    {
        $customer = Customer::findOrFail($id);

        $stats = [
            'total_invoiced' => $customer->total_invoiced,
            'total_paid' => $customer->total_paid,
            'total_pending' => $customer->total_pending,
            'total_repairs' => $customer->total_repairs,
            'total_tickets' => $customer->tickets()->count(),
            'recent_invoices' => $customer->invoices()->latest()->take(5)->get(),
            'recent_repairs' => $customer->repairEquipments()->latest()->take(5)->get(),
            'payment_history' => $customer->invoices()
                ->where('status', 'paid')
                ->orderBy('paid_date', 'desc')
                ->take(10)
                ->get(),
        ];

        return response()->json([
            'success' => true,
            'customer' => $customer,
            'statistics' => $stats
        ]);
    }

    /**
     * Toggle customer status (active/inactive)
     */
    public function toggleStatus($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->status = !$customer->status;
        $customer->updated_by = Auth::id();
        $customer->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado del cliente actualizado',
            'customer' => $customer
        ]);
    }

    /**
     * Get all active customers for dropdowns
     */
    public function getActiveCustomers()
    {
        $customers = Customer::active()
            ->orderBy('company_name')
            ->orderBy('first_name')
            ->get(['id', 'customer_code', 'customer_type', 'first_name', 'last_name', 'company_name', 'email', 'phone']);

        $formattedCustomers = $customers->map(function ($customer) {
            return [
                'id' => $customer->id,
                'customer_code' => $customer->customer_code,
                'display_name' => $customer->display_name,
                'customer_type' => $customer->customer_type,
                'email' => $customer->email,
                'phone' => $customer->phone,
            ];
        });

        return response()->json([
            'success' => true,
            'customers' => $formattedCustomers
        ]);
    }

    /**
     * Search customers (for autocomplete)
     */
    public function search(Request $request)
    {
        $search = $request->get('q', '');
        
        $customers = Customer::active()
            ->search($search)
            ->limit(10)
            ->get(['id', 'customer_code', 'customer_type', 'first_name', 'last_name', 'company_name', 'email', 'phone']);

        $formattedCustomers = $customers->map(function ($customer) {
            return [
                'id' => $customer->id,
                'customer_code' => $customer->customer_code,
                'display_name' => $customer->display_name,
                'customer_type' => $customer->customer_type,
                'email' => $customer->email,
                'phone' => $customer->phone,
            ];
        });

        return response()->json([
            'success' => true,
            'customers' => $formattedCustomers
        ]);
    }
}

