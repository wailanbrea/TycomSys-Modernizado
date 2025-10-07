<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RepairEquipment;
use App\Models\EquipmentStatus;

class ShowRepairData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repair:show-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Muestra los datos de equipos de reparación creados';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== DATOS DE EQUIPOS DE REPARACIÓN ===');
        $this->newLine();

        $equipments = RepairEquipment::with(['assignedTechnician', 'statusHistory'])->get();

        foreach ($equipments as $equipment) {
            $this->line("📋 <fg=cyan>Ticket:</> {$equipment->ticket_number}");
            $this->line("   <fg=yellow>Cliente:</> {$equipment->customer_name}");
            $this->line("   <fg=yellow>Teléfono:</> {$equipment->customer_phone}");
            $this->line("   <fg=yellow>Equipo:</> {$equipment->brand} {$equipment->model}");
            $this->line("   <fg=yellow>Problema:</> " . substr($equipment->problem_description, 0, 50) . "...");
            $this->line("   <fg=yellow>Estado:</> <fg=green>{$equipment->getStatusText()}</>");
            $this->line("   <fg=yellow>Técnico:</> {$equipment->assignedTechnician->name}");
            $this->line("   <fg=yellow>Costo estimado:</> $" . number_format($equipment->estimated_cost, 2));
            $this->line("   <fg=yellow>Estados en historial:</> {$equipment->statusHistory->count()}");
            $this->newLine();
        }

        $this->info("📊 <fg=green>Resumen:</>");
        $this->line("   Total equipos: " . RepairEquipment::count());
        $this->line("   Total estados: " . EquipmentStatus::count());
        
        $statusCounts = RepairEquipment::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get();
            
        $this->newLine();
        $this->info("📈 <fg=green>Estados por cantidad:</>");
        foreach ($statusCounts as $status) {
            $this->line("   {$status->status}: {$status->count}");
        }
    }
}







