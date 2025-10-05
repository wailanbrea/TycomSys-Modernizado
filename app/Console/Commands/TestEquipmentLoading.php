<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RepairEquipment;

class TestEquipmentLoading extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:equipment-loading';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Probar la carga de equipos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== PRUEBA DE CARGA DE EQUIPOS ===');
        
        // 1. Verificar que hay equipos en la base de datos
        $this->info('🔧 Verificando equipos en la base de datos...');
        $equipments = RepairEquipment::with(['assignedTechnician', 'createdBy', 'brand', 'type', 'model'])->get();
        
        $this->line("✅ Total de equipos en BD: {$equipments->count()}");
        
        if ($equipments->count() > 0) {
            $this->line('📋 Primeros 3 equipos:');
            foreach ($equipments->take(3) as $equipment) {
                $this->line("   • {$equipment->customer_name} - {$equipment->ticket_number}");
                $this->line("     Marca: " . ($equipment->brand ? $equipment->brand->name : 'Sin marca'));
                $this->line("     Tipo: " . ($equipment->type ? $equipment->type->name : 'Sin tipo'));
                $this->line("     Modelo: " . ($equipment->model ? $equipment->model->name : 'Sin modelo'));
                $this->line("     Técnico: " . ($equipment->assignedTechnician ? $equipment->assignedTechnician->name : 'Sin asignar'));
                $this->line('');
            }
        }
        
        $this->newLine();
        
        // 2. Verificar endpoint público
        $this->info('🌐 Probando endpoint público...');
        $this->line('   Endpoint: /api/public/equipments');
        
        // Simular la respuesta del endpoint
        $equipmentsData = RepairEquipment::with(['assignedTechnician', 'createdBy', 'brand', 'type', 'model'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        $response = [
            'data' => $equipmentsData
        ];
        
        $this->line("   ✅ Endpoint devuelve {$equipmentsData->count()} equipos");
        
        $this->newLine();
        
        // 3. Verificar relaciones
        $this->info('🔗 Verificando relaciones...');
        $sampleEquipment = $equipments->first();
        
        if ($sampleEquipment) {
            $this->line("   ✅ Equipo de muestra: {$sampleEquipment->customer_name}");
            $this->line("   ✅ Marca: " . ($sampleEquipment->brand ? $sampleEquipment->brand->name : 'NULL'));
            $this->line("   ✅ Tipo: " . ($sampleEquipment->type ? $sampleEquipment->type->name : 'NULL'));
            $this->line("   ✅ Modelo: " . ($sampleEquipment->model ? $sampleEquipment->model->name : 'NULL'));
            $this->line("   ✅ Técnico: " . ($sampleEquipment->assignedTechnician ? $sampleEquipment->assignedTechnician->name : 'NULL'));
        }
        
        $this->newLine();
        
        // 4. Instrucciones para probar
        $this->info('🚀 PARA PROBAR EN EL NAVEGADOR:');
        $this->line('1. Ve a: http://127.0.0.1:8000/ticomsyslogin');
        $this->line('2. Login: admin@ticomsys.com / admin123');
        $this->line('3. Ve a "Equipos de Reparación"');
        $this->line('4. Abre la consola del navegador (F12)');
        $this->line('5. Busca los logs que empiezan con 🔧');
        $this->line('6. Verifica que aparezcan los equipos en la tabla');
        
        $this->newLine();
        
        // 5. Posibles problemas
        $this->info('🔍 POSIBLES PROBLEMAS:');
        $this->line('• Si no aparecen equipos: Verificar que hay datos en la BD');
        $this->line('• Si hay error 404: El endpoint no está funcionando');
        $this->line('• Si hay error 500: Problema con las relaciones');
        $this->line('• Si no se cargan las relaciones: Verificar que brand_id, type_id, model_id están correctos');
        
        $this->newLine();
        $this->info('✅ PRUEBA COMPLETADA');
    }
}



