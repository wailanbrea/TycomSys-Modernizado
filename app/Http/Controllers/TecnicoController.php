<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:tecnico');
    }

    public function dashboard()
    {
        return view('tecnico.dashboard');
    }

    public function equipment()
    {
        return view('tecnico.equipment');
    }

    public function tickets()
    {
        return view('tecnico.tickets');
    }

    public function reports()
    {
        return view('tecnico.reports');
    }

    // API Methods
    public function getEquipment()
    {
        // Datos de ejemplo para equipos
        $equipment = [
            [
                'id' => 1,
                'name' => 'Servidor Principal',
                'ip' => '192.168.1.100',
                'status' => 'active',
                'type' => 'server'
            ],
            [
                'id' => 2,
                'name' => 'Router Principal',
                'ip' => '192.168.1.1',
                'status' => 'maintenance',
                'type' => 'router'
            ]
        ];
        return response()->json($equipment);
    }

    public function getTickets()
    {
        // Datos de ejemplo para tickets
        $tickets = [
            [
                'id' => 1234,
                'title' => 'Error en servidor de correo',
                'priority' => 'critical',
                'status' => 'open',
                'reporter' => 'admin@empresa.com',
                'created_at' => '2025-01-10 10:00:00'
            ],
            [
                'id' => 1235,
                'title' => 'Actualización de software requerida',
                'priority' => 'medium',
                'status' => 'assigned',
                'reporter' => 'user@empresa.com',
                'created_at' => '2025-01-10 08:00:00'
            ]
        ];
        return response()->json($tickets);
    }

    public function getReports()
    {
        // Datos de ejemplo para reportes
        $reports = [
            [
                'id' => 1,
                'name' => 'Reporte de Tickets',
                'type' => 'tickets',
                'period' => 'last_month'
            ],
            [
                'id' => 2,
                'name' => 'Estado de Equipos',
                'type' => 'equipment',
                'period' => 'realtime'
            ]
        ];
        return response()->json($reports);
    }
}
