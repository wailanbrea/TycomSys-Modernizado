<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ticket;
use App\Models\RepairEquipment;

class ShowTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:show';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Muestra los tickets creados en el sistema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== TICKETS DEL SISTEMA ===');
        $this->newLine();

        $tickets = Ticket::with(['repairEquipment', 'assignedTechnician', 'createdBy'])->get();

        foreach ($tickets as $ticket) {
            $this->line("🎫 <fg=cyan>Ticket:</> {$ticket->ticket_number}");
            $this->line("   <fg=yellow>Equipo:</> {$ticket->repairEquipment->brand} {$ticket->repairEquipment->model}");
            $this->line("   <fg=yellow>Cliente:</> {$ticket->repairEquipment->customer_name}");
            $this->line("   <fg=yellow>Título:</> {$ticket->title}");
            $this->line("   <fg=yellow>Prioridad:</> <fg=green>{$ticket->getPriorityText()}</>");
            $this->line("   <fg=yellow>Estado:</> <fg=green>{$ticket->getStatusText()}</>");
            $this->line("   <fg=yellow>Técnico:</> {$ticket->assignedTechnician->name}");
            $this->line("   <fg=yellow>Creado por:</> {$ticket->createdBy->name}");
            $this->line("   <fg=yellow>Fecha límite:</> " . ($ticket->due_date ? $ticket->due_date->format('d/m/Y') : 'No definida'));
            $this->newLine();
        }

        $this->info("📊 <fg=green>Resumen:</>");
        $this->line("   Total tickets: " . Ticket::count());
        
        $statusCounts = Ticket::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get();
            
        $this->newLine();
        $this->info("📈 <fg=green>Estados por cantidad:</>");
        foreach ($statusCounts as $status) {
            $this->line("   {$status->status}: {$status->count}");
        }

        $priorityCounts = Ticket::selectRaw('priority, count(*) as count')
            ->groupBy('priority')
            ->get();
            
        $this->newLine();
        $this->info("⚡ <fg=green>Prioridades por cantidad:</>");
        foreach ($priorityCounts as $priority) {
            $this->line("   {$priority->priority}: {$priority->count}");
        }
    }
}







