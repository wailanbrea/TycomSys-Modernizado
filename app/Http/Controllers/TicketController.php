<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\RepairEquipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
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
        $tickets = Ticket::with([
            'repairEquipment.assignedTechnician',
            'assignedTechnician',
            'createdBy'
        ])->orderBy('created_at', 'desc')->paginate(15);

        return response()->json($tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technicians = User::whereHas('roles', function($query) {
            $query->where('name', 'tecnico');
        })->get();

        $equipments = RepairEquipment::whereNotIn('status', ['delivered', 'cancelled'])
            ->with('assignedTechnician')
            ->get();

        return response()->json([
            'technicians' => $technicians,
            'equipments' => $equipments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'repair_equipment_id' => 'required|exists:repair_equipment,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'assigned_technician_id' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date|after:today'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ticket = Ticket::create([
            'ticket_number' => Ticket::generateTicketNumber(),
            'repair_equipment_id' => $request->repair_equipment_id,
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'assigned_technician_id' => $request->assigned_technician_id,
            'created_by' => Auth::id(),
            'due_date' => $request->due_date,
            'status' => 'open'
        ]);

        return response()->json([
            'message' => 'Ticket creado exitosamente',
            'ticket' => $ticket->load(['repairEquipment', 'assignedTechnician', 'createdBy'])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::with([
            'repairEquipment.assignedTechnician',
            'assignedTechnician',
            'createdBy',
            'comments'
        ])->findOrFail($id);

        return response()->json($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:open,in_progress,waiting_customer,waiting_parts,resolved,closed,cancelled',
            'assigned_technician_id' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
            'resolution_notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $oldStatus = $ticket->status;
        $ticket->update($request->all());

        // Si se marca como resuelto, actualizar fecha de resolución
        if ($request->status === 'resolved' && $oldStatus !== 'resolved') {
            $ticket->update(['resolved_at' => now()]);
        }

        return response()->json([
            'message' => 'Ticket actualizado exitosamente',
            'ticket' => $ticket->load(['repairEquipment', 'assignedTechnician', 'createdBy'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return response()->json(['message' => 'Ticket eliminado exitosamente']);
    }

    /**
     * Update ticket status
     */
    public function updateStatus(Request $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:open,in_progress,waiting_customer,waiting_parts,resolved,closed,cancelled',
            'resolution_notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $oldStatus = $ticket->status;
        $ticket->update([
            'status' => $request->status,
            'resolution_notes' => $request->resolution_notes
        ]);

        // Si se marca como resuelto, actualizar fecha de resolución
        if ($request->status === 'resolved' && $oldStatus !== 'resolved') {
            $ticket->update(['resolved_at' => now()]);
        }

        return response()->json([
            'message' => 'Estado del ticket actualizado exitosamente',
            'ticket' => $ticket->load(['repairEquipment', 'assignedTechnician', 'createdBy'])
        ]);
    }

    /**
     * Get tickets by status
     */
    public function getByStatus(string $status)
    {
        $tickets = Ticket::with([
            'repairEquipment.assignedTechnician',
            'assignedTechnician',
            'createdBy'
        ])->where('status', $status)->orderBy('created_at', 'desc')->get();

        return response()->json($tickets);
    }

    /**
     * Get tickets assigned to technician
     */
    public function getAssignedToTechnician(string $technicianId)
    {
        $tickets = Ticket::with([
            'repairEquipment.assignedTechnician',
            'assignedTechnician',
            'createdBy'
        ])->where('assigned_technician_id', $technicianId)
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json($tickets);
    }
}