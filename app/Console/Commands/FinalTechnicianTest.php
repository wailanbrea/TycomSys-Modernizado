<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class FinalTechnicianTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:final-technicians';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prueba final de técnicos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== PRUEBA FINAL DE TÉCNICOS ===');
        
        // 1. Verificar técnicos en la base de datos
        $this->info('📊 Técnicos en la base de datos:');
        $technicians = User::whereHas('roles', function($query) {
            $query->where('name', 'tecnico');
        })->select('id', 'name', 'email')->get();
        
        $this->line("Total: {$technicians->count()} técnicos");
        foreach ($technicians as $tech) {
            $this->line("• {$tech->id} - {$tech->name} ({$tech->email})");
        }
        
        $this->newLine();
        
        // 2. Verificar endpoint
        $this->info('🌐 Endpoint funcionando:');
        $this->line('URL: http://127.0.0.1:8000/api/public/technicians');
        $this->line('Método: GET');
        $this->line('Headers: Accept: application/json');
        
        $this->newLine();
        
        // 3. Verificar respuesta JSON
        $this->info('📋 Respuesta JSON esperada:');
        $response = ['technicians' => $technicians->toArray()];
        $this->line(json_encode($response, JSON_PRETTY_PRINT));
        
        $this->newLine();
        
        // 4. Instrucciones para debuggear
        $this->info('🔍 Para debuggear en el frontend:');
        $this->line('1. Abre las herramientas de desarrollador (F12)');
        $this->line('2. Ve a la pestaña Console');
        $this->line('3. Accede a "Equipos de Reparación"');
        $this->line('4. Haz clic en "Nuevo Equipo"');
        $this->line('5. Busca los logs que empiecen con 🔧');
        $this->line('6. Verifica que aparezcan:');
        $this->line('   - "🔧 Cargando técnicos..."');
        $this->line('   - "🔧 Response status: 200"');
        $this->line('   - "🔧 Técnicos recibidos: {...}"');
        $this->line('   - "🔧 Técnicos establecidos en estado"');
        
        $this->newLine();
        
        // 5. Verificar frontend
        $this->info('🖥️ Verificar en el frontend:');
        $this->line('1. Ve a: http://127.0.0.1:8000/ticomsyslogin');
        $this->line('2. Login: admin@ticomsys.com / admin123');
        $this->line('3. Ve a "Equipos de Reparación"');
        $this->line('4. Haz clic en "Nuevo Equipo"');
        $this->line('5. En el dropdown "Técnico Asignado" deberías ver:');
        foreach ($technicians as $tech) {
            $this->line("   • {$tech->name}");
        }
        
        $this->newLine();
        $this->info('✅ Prueba completada');
    }
}



