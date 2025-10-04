<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RepairEquipment;
use App\Models\Ticket;
use App\Models\Invoice;
use App\Models\User;
use App\Models\EquipmentBrand;
use App\Models\EquipmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Reporte de equipos por estado
     */
    public function equipmentByStatus(Request $request)
    {
        $dateFrom = $request->get('date_from', now()->startOfMonth());
        $dateTo = $request->get('date_to', now()->endOfMonth());

        $equipment = RepairEquipment::whereBetween('created_at', [$dateFrom, $dateTo])
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        $statusLabels = [
            'received' => 'Recibido',
            'in_review' => 'En Revisión',
            'in_repair' => 'En Reparación',
            'waiting_parts' => 'Esperando Repuestos',
            'ready' => 'Listo',
            'delivered' => 'Entregado',
            'cancelled' => 'Cancelado'
        ];

        $data = $equipment->map(function ($item) use ($statusLabels) {
            return [
                'status' => $statusLabels[$item->status] ?? $item->status,
                'count' => $item->count
            ];
        });

        return response()->json([
            'title' => 'Equipos por Estado',
            'period' => "Del {$dateFrom} al {$dateTo}",
            'data' => $data,
            'total' => $equipment->sum('count')
        ]);
    }

    /**
     * Reporte de ingresos por período
     */
    public function revenueByPeriod(Request $request)
    {
        $dateFrom = $request->get('date_from', now()->startOfMonth());
        $dateTo = $request->get('date_to', now()->endOfMonth());

        $invoices = Invoice::whereBetween('invoice_date', [$dateFrom, $dateTo])
            ->select(
                DB::raw('DATE(invoice_date) as date'),
                DB::raw('SUM(total_amount) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $totalRevenue = $invoices->sum('total');
        $averageDaily = $invoices->count() > 0 ? $totalRevenue / $invoices->count() : 0;

        return response()->json([
            'title' => 'Ingresos por Período',
            'period' => "Del {$dateFrom} al {$dateTo}",
            'data' => $invoices,
            'summary' => [
                'total_revenue' => $totalRevenue,
                'average_daily' => $averageDaily,
                'total_invoices' => $invoices->count()
            ]
        ]);
    }

    /**
     * Reporte de productividad de técnicos
     */
    public function technicianProductivity(Request $request)
    {
        $dateFrom = $request->get('date_from', now()->startOfMonth());
        $dateTo = $request->get('date_to', now()->endOfMonth());

        $technicians = User::whereHas('roles', function($query) {
            $query->where('name', 'tecnico');
        })->withCount([
            'repairEquipment as completed_equipment' => function($query) use ($dateFrom, $dateTo) {
                $query->where('status', 'delivered')
                      ->whereBetween('updated_at', [$dateFrom, $dateTo]);
            },
            'tickets as completed_tickets' => function($query) use ($dateFrom, $dateTo) {
                $query->where('status', 'closed')
                      ->whereBetween('updated_at', [$dateFrom, $dateTo]);
            }
        ])->get();

        $data = $technicians->map(function ($technician) {
            return [
                'technician_name' => $technician->name,
                'completed_equipment' => $technician->completed_equipment,
                'completed_tickets' => $technician->completed_tickets,
                'total_work' => $technician->completed_equipment + $technician->completed_tickets
            ];
        })->sortByDesc('total_work');

        return response()->json([
            'title' => 'Productividad de Técnicos',
            'period' => "Del {$dateFrom} al {$dateTo}",
            'data' => $data->values(),
            'summary' => [
                'total_technicians' => $technicians->count(),
                'total_equipment_completed' => $data->sum('completed_equipment'),
                'total_tickets_completed' => $data->sum('completed_tickets')
            ]
        ]);
    }

    /**
     * Reporte de equipos más reparados
     */
    public function mostRepairedEquipment(Request $request)
    {
        $dateFrom = $request->get('date_from', now()->startOfMonth());
        $dateTo = $request->get('date_to', now()->endOfMonth());

        $equipment = RepairEquipment::with(['brand', 'type', 'model'])
            ->whereBetween('created_at', [$dateFrom, $dateTo])
            ->select('brand_id', 'type_id', 'model_id', DB::raw('count(*) as count'))
            ->groupBy('brand_id', 'type_id', 'model_id')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        $data = $equipment->map(function ($item) {
            return [
                'equipment' => $item->brand->name . ' ' . $item->model->name,
                'type' => $item->type->name,
                'count' => $item->count
            ];
        });

        return response()->json([
            'title' => 'Equipos Más Reparados',
            'period' => "Del {$dateFrom} al {$dateTo}",
            'data' => $data,
            'summary' => [
                'total_equipment' => $equipment->sum('count'),
                'unique_models' => $equipment->count()
            ]
        ]);
    }

    /**
     * Reporte de tiempos promedio de reparación
     */
    public function averageRepairTime(Request $request)
    {
        $dateFrom = $request->get('date_from', now()->startOfMonth());
        $dateTo = $request->get('date_to', now()->endOfMonth());

        $equipment = RepairEquipment::where('status', 'delivered')
            ->whereBetween('delivered_at', [$dateFrom, $dateTo])
            ->select(
                DB::raw('AVG(TIMESTAMPDIFF(DAY, created_at, delivered_at)) as avg_days'),
                DB::raw('MIN(TIMESTAMPDIFF(DAY, created_at, delivered_at)) as min_days'),
                DB::raw('MAX(TIMESTAMPDIFF(DAY, created_at, delivered_at)) as max_days'),
                DB::raw('COUNT(*) as total_delivered')
            )
            ->first();

        // Tiempo promedio por estado
        $statusTimes = RepairEquipment::whereBetween('created_at', [$dateFrom, $dateTo])
            ->select('status', DB::raw('AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_hours'))
            ->groupBy('status')
            ->get();

        return response()->json([
            'title' => 'Tiempos Promedio de Reparación',
            'period' => "Del {$dateFrom} al {$dateTo}",
            'data' => [
                'overall' => [
                    'average_days' => round($equipment->avg_days, 1),
                    'min_days' => $equipment->min_days,
                    'max_days' => $equipment->max_days,
                    'total_delivered' => $equipment->total_delivered
                ],
                'by_status' => $statusTimes->map(function ($item) {
                    return [
                        'status' => $item->status,
                        'average_hours' => round($item->avg_hours, 1)
                    ];
                })
            ]
        ]);
    }

    /**
     * Reporte financiero general
     */
    public function financialReport(Request $request)
    {
        $dateFrom = $request->get('date_from', now()->startOfMonth());
        $dateTo = $request->get('date_to', now()->endOfMonth());

        $invoices = Invoice::whereBetween('invoice_date', [$dateFrom, $dateTo]);
        
        $totalInvoiced = $invoices->sum('total_amount');
        $totalPaid = $invoices->where('status', 'paid')->sum('total_amount');
        $totalPending = $invoices->whereIn('status', ['draft', 'sent'])->sum('total_amount');
        $totalOverdue = $invoices->where('status', 'overdue')->sum('total_amount');

        $invoicesByStatus = $invoices->select('status', DB::raw('count(*) as count'), DB::raw('SUM(total_amount) as total'))
            ->groupBy('status')
            ->get();

        return response()->json([
            'title' => 'Reporte Financiero General',
            'period' => "Del {$dateFrom} al {$dateTo}",
            'data' => [
                'summary' => [
                    'total_invoiced' => $totalInvoiced,
                    'total_paid' => $totalPaid,
                    'total_pending' => $totalPending,
                    'total_overdue' => $totalOverdue,
                    'collection_rate' => $totalInvoiced > 0 ? round(($totalPaid / $totalInvoiced) * 100, 2) : 0
                ],
                'by_status' => $invoicesByStatus
            ]
        ]);
    }

    /**
     * Dashboard de estadísticas generales
     */
    public function dashboardStats()
    {
        $today = now();
        $thisMonth = $today->copy()->startOfMonth();
        $lastMonth = $today->copy()->subMonth()->startOfMonth();

        // Estadísticas del mes actual
        $currentMonthStats = [
            'equipment_received' => RepairEquipment::where('created_at', '>=', $thisMonth)->count(),
            'equipment_delivered' => RepairEquipment::where('status', 'delivered')
                ->where('delivered_at', '>=', $thisMonth)->count(),
            'tickets_created' => Ticket::where('created_at', '>=', $thisMonth)->count(),
            'tickets_closed' => Ticket::where('status', 'closed')
                ->where('updated_at', '>=', $thisMonth)->count(),
            'invoices_created' => Invoice::where('created_at', '>=', $thisMonth)->count(),
            'revenue' => Invoice::where('invoice_date', '>=', $thisMonth)->sum('total_amount')
        ];

        // Estadísticas del mes anterior
        $lastMonthStats = [
            'equipment_received' => RepairEquipment::whereBetween('created_at', [$lastMonth, $thisMonth])->count(),
            'equipment_delivered' => RepairEquipment::where('status', 'delivered')
                ->whereBetween('delivered_at', [$lastMonth, $thisMonth])->count(),
            'tickets_created' => Ticket::whereBetween('created_at', [$lastMonth, $thisMonth])->count(),
            'tickets_closed' => Ticket::where('status', 'closed')
                ->whereBetween('updated_at', [$lastMonth, $thisMonth])->count(),
            'invoices_created' => Invoice::whereBetween('created_at', [$lastMonth, $thisMonth])->count(),
            'revenue' => Invoice::whereBetween('invoice_date', [$lastMonth, $thisMonth])->sum('total_amount')
        ];

        // Cálculo de cambios porcentuales
        $changes = [];
        foreach ($currentMonthStats as $key => $current) {
            $last = $lastMonthStats[$key];
            if ($last > 0) {
                $changes[$key] = round((($current - $last) / $last) * 100, 1);
            } else {
                $changes[$key] = $current > 0 ? 100 : 0;
            }
        }

        return response()->json([
            'current_month' => $currentMonthStats,
            'last_month' => $lastMonthStats,
            'changes_percentage' => $changes,
            'period' => $thisMonth->format('F Y')
        ]);
    }

    /**
     * Exportar reporte a PDF (placeholder)
     */
    public function exportToPdf(Request $request)
    {
        $reportType = $request->get('type');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        // Por ahora retornamos los datos en JSON
        // En el futuro se puede implementar generación de PDF con libraries como DomPDF
        $data = $this->getReportData($reportType, $dateFrom, $dateTo);

        return response()->json([
            'message' => 'Exportación a PDF no implementada aún',
            'data' => $data,
            'suggestion' => 'Los datos están disponibles para implementar generación de PDF'
        ]);
    }

    private function getReportData($type, $dateFrom, $dateTo)
    {
        $request = new Request(['date_from' => $dateFrom, 'date_to' => $dateTo]);
        
        switch ($type) {
            case 'equipment_by_status':
                return $this->equipmentByStatus($request);
            case 'revenue_by_period':
                return $this->revenueByPeriod($request);
            case 'technician_productivity':
                return $this->technicianProductivity($request);
            case 'most_repaired_equipment':
                return $this->mostRepairedEquipment($request);
            case 'average_repair_time':
                return $this->averageRepairTime($request);
            case 'financial_report':
                return $this->financialReport($request);
            default:
                return ['error' => 'Tipo de reporte no válido'];
        }
    }
}