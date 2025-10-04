<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RepairEquipment;
use Illuminate\Http\Request;

class CustomerQueryController extends Controller
{
    /**
     * Show customer query form
     */
    public function index()
    {
        return view('customer.query');
    }

    /**
     * Get equipment status by ticket number
     */
    public function getStatus(Request $request)
    {
        $request->validate([
            'ticket_number' => 'required|string'
        ]);

        $equipment = RepairEquipment::with([
            'assignedTechnician', 
            'statusHistory.updatedBy'
        ])->where('ticket_number', $request->ticket_number)->first();

        if (!$equipment) {
            return response()->json(['message' => 'Equipo no encontrado'], 404);
        }

        return response()->json($equipment);
    }

    /**
     * Show equipment status page
     */
    public function showStatus($ticketNumber)
    {
        $equipment = RepairEquipment::with([
            'assignedTechnician', 
            'statusHistory.updatedBy'
        ])->where('ticket_number', $ticketNumber)->first();

        if (!$equipment) {
            return view('customer.not-found', ['ticketNumber' => $ticketNumber]);
        }

        return view('customer.status', compact('equipment'));
    }

    /**
     * API pública para polling del estado por ticket
     */
    public function apiStatus($ticketNumber)
    {
        $equipment = RepairEquipment::with(['brand', 'model', 'type'])
            ->where('ticket_number', $ticketNumber)
            ->first();

        if (!$equipment) {
            return response()->json(['found' => false], 404);
        }

        return response()->json([
            'found' => true,
            'ticket_number' => $equipment->ticket_number,
            'status' => $equipment->status,
            'status_updated_at' => optional($equipment->updated_at)->toDateTimeString(),
            'customer_name' => $equipment->customer_name,
            'equipment' => [
                'brand' => optional($equipment->brand)->name,
                'model' => optional($equipment->model)->name,
                'type' => optional($equipment->type)->name,
                'serial_number' => $equipment->serial_number,
            ],
        ]);
    }
}
