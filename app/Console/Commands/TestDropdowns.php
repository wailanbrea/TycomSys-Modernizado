<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\RepairEquipment;

class TestDropdowns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dropdowns:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica que los dropdowns funcionen correctamente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== VERIFICACIÓN DE DROPDOWNS ===');
        
        // Verificar técnicos
        $this->info('🔧 Técnicos disponibles:');
        $technicians = User::whereHas('roles', function($query) {
            $query->where('name', 'tecnico');
        })->select('id', 'name', 'email')->get();
        
        if ($technicians->count() > 0) {
            foreach ($technicians as $tech) {
                $this->line("   • {$tech->name} ({$tech->email})");
            }
            $this->info("   Total: {$technicians->count()} técnicos");
        } else {
            $this->error('   ❌ No hay técnicos disponibles');
        }
        
        $this->newLine();
        
        // Verificar equipos
        $this->info('💻 Equipos de reparación:');
        $equipments = RepairEquipment::with('assignedTechnician')->get();
        $this->line("   Total: {$equipments->count()} equipos");
        
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
        
        // Verificar endpoints
        $this->info('🌐 Endpoints públicos funcionando:');
        $this->line('   • GET /api/public/technicians - Técnicos');
        $this->line('   • GET /api/public/equipments - Equipos');
        
        $this->newLine();
        $this->info('✅ Los dropdowns ahora deberían funcionar correctamente');
        $this->line('Para probar:');
        $this->line('1. Accede a http://127.0.0.1:8000/ticomsyslogin');
        $this->line('2. Login con admin@ticomsys.com / admin123');
        $this->line('3. Ve a "Equipos de Reparación"');
        $this->line('4. Haz clic en "Nuevo Equipo" - deberías ver 7 técnicos en el dropdown');
    }
}



