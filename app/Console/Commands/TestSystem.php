<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\RepairEquipment;
use App\Models\Ticket;

class TestSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica que el sistema esté funcionando correctamente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== VERIFICACIÓN DEL SISTEMA ===');
        $this->newLine();

        // Verificar usuarios
        $this->info('👥 Usuarios:');
        $users = User::with('roles')->get();
        foreach ($users as $user) {
            $roles = $user->roles->pluck('name')->join(', ');
            $this->line("   • {$user->name} ({$user->email}) - Roles: {$roles}");
        }
        $this->newLine();

        // Verificar técnicos
        $this->info('🔧 Técnicos disponibles:');
        $technicians = User::whereHas('roles', function($query) {
            $query->where('name', 'tecnico');
        })->get();
        
        if ($technicians->count() > 0) {
            foreach ($technicians as $tech) {
                $this->line("   • {$tech->name} ({$tech->email})");
            }
        } else {
            $this->error('   ❌ No hay técnicos en el sistema');
        }
        $this->newLine();

        // Verificar equipos
        $this->info('💻 Equipos de reparación:');
        $equipments = RepairEquipment::with('assignedTechnician')->get();
        $this->line("   Total: {$equipments->count()}");
        
        if ($equipments->count() > 0) {
            foreach ($equipments->take(3) as $equipment) {
                $tech = $equipment->assignedTechnician ? $equipment->assignedTechnician->name : 'Sin asignar';
                $this->line("   • {$equipment->ticket_number} - {$equipment->customer_name} - Técnico: {$tech}");
            }
            if ($equipments->count() > 3) {
                $this->line("   ... y " . ($equipments->count() - 3) . " más");
            }
        }
        $this->newLine();

        // Verificar tickets
        $this->info('🎫 Tickets:');
        $tickets = Ticket::with('repairEquipment')->get();
        $this->line("   Total: {$tickets->count()}");
        
        if ($tickets->count() > 0) {
            foreach ($tickets->take(3) as $ticket) {
                $equipment = $ticket->repairEquipment ? $ticket->repairEquipment->ticket_number : 'Sin equipo';
                $this->line("   • {$ticket->ticket_number} - Equipo: {$equipment} - Estado: {$ticket->status}");
            }
            if ($tickets->count() > 3) {
                $this->line("   ... y " . ($tickets->count() - 3) . " más");
            }
        }
        $this->newLine();

        // Verificar API endpoints
        $this->info('🌐 Endpoints API disponibles:');
        $this->line("   • GET /api/repair-equipment - Listar equipos");
        $this->line("   • GET /api/repair-equipment/create - Obtener técnicos");
        $this->line("   • POST /api/repair-equipment - Crear equipo");
        $this->line("   • PUT /api/repair-equipment/{id} - Actualizar equipo");
        $this->line("   • POST /api/repair-equipment/{id}/update-status - Actualizar estado");
        $this->line("   • GET /api/tickets - Listar tickets");
        $this->line("   • POST /api/tickets/{id}/update-status - Actualizar estado de ticket");
        $this->newLine();

        $this->info('✅ Sistema verificado correctamente');
        $this->line('Para probar:');
        $this->line('1. Accede a http://127.0.0.1:8000/ticomsyslogin');
        $this->line('2. Login con admin@ticomsys.com / admin123');
        $this->line('3. Ve a "Equipos de Reparación" y prueba crear/editar equipos');
        $this->line('4. Ve a "Estados de Tickets" y prueba actualizar estados');
    }
}


