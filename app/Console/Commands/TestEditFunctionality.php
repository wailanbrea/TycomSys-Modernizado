<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RepairEquipment;
use App\Models\EquipmentBrand;
use App\Models\EquipmentType;
use App\Models\EquipmentModel;

class TestEditFunctionality extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:edit-functionality';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Probar la funcionalidad de edición de equipos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== PRUEBA DE FUNCIONALIDAD DE EDICIÓN ===');
        
        // 1. Verificar que hay equipos para editar
        $this->info('🔧 Verificando equipos disponibles...');
        $equipment = RepairEquipment::with(['brand', 'type', 'model'])->first();
        
        if (!$equipment) {
            $this->error('❌ No hay equipos en la base de datos');
            return;
        }
        
        $this->line("✅ Equipo de prueba: {$equipment->customer_name} - {$equipment->ticket_number}");
        $this->line("   Marca actual: " . ($equipment->brand ? $equipment->brand->name : 'Sin marca'));
        $this->line("   Tipo actual: " . ($equipment->type ? $equipment->type->name : 'Sin tipo'));
        $this->line("   Modelo actual: " . ($equipment->model ? $equipment->model->name : 'Sin modelo'));
        
        $this->newLine();
        
        // 2. Verificar que existen marcas, tipos y modelos
        $this->info('🏷️ Verificando datos de referencia...');
        $brands = EquipmentBrand::count();
        $types = EquipmentType::count();
        $models = EquipmentModel::count();
        
        $this->line("   ✅ Marcas disponibles: {$brands}");
        $this->line("   ✅ Tipos disponibles: {$types}");
        $this->line("   ✅ Modelos disponibles: {$models}");
        
        if ($brands === 0 || $types === 0 || $models === 0) {
            $this->error('❌ Faltan datos de referencia (marcas, tipos o modelos)');
            return;
        }
        
        $this->newLine();
        
        // 3. Verificar estructura de datos para edición
        $this->info('📋 Estructura de datos para edición:');
        $this->line('   Campos requeridos:');
        $this->line('   • customer_name (string)');
        $this->line('   • customer_phone (string)');
        $this->line('   • brand_id (exists:equipment_brands,id)');
        $this->line('   • type_id (exists:equipment_types,id)');
        $this->line('   • model_id (exists:equipment_models,id)');
        $this->line('   • problem_description (string)');
        $this->line('   • status (in:received,in_review,in_repair,waiting_parts,ready,delivered,cancelled)');
        
        $this->newLine();
        
        // 4. Verificar que el controlador está actualizado
        $this->info('🔧 Verificando controlador...');
        $controllerPath = 'app/Http/Controllers/RepairEquipmentController.php';
        $controllerContent = file_get_contents($controllerPath);
        
        if (strpos($controllerContent, 'brand_id') !== false && 
            strpos($controllerContent, 'type_id') !== false && 
            strpos($controllerContent, 'model_id') !== false) {
            $this->line('   ✅ Controlador actualizado con nuevos campos');
        } else {
            $this->error('   ❌ Controlador no actualizado');
        }
        
        $this->newLine();
        
        // 5. Instrucciones para probar
        $this->info('🚀 PARA PROBAR LA EDICIÓN:');
        $this->line('1. Ve a: http://127.0.0.1:8000/ticomsyslogin');
        $this->line('2. Login: admin@ticomsys.com / admin123');
        $this->line('3. Ve a "Equipos de Reparación"');
        $this->line('4. Haz clic en "Editar" en cualquier equipo');
        $this->line('5. Abre la consola del navegador (F12)');
        $this->line('6. Haz cambios en el formulario y envía');
        $this->line('7. Busca los logs que empiezan con 🔧');
        
        $this->newLine();
        
        // 6. Posibles problemas
        $this->info('🔍 POSIBLES PROBLEMAS:');
        $this->line('• Error 422: Validación fallida - verificar campos requeridos');
        $this->line('• Error 500: Problema en el servidor - verificar logs de Laravel');
        $this->line('• Error 401: No autenticado - verificar sesión');
        $this->line('• Error 404: Endpoint no encontrado - verificar rutas');
        
        $this->newLine();
        
        // 7. Datos de prueba
        $this->info('📊 DATOS DE PRUEBA DISPONIBLES:');
        $sampleBrand = EquipmentBrand::first();
        $sampleType = EquipmentType::first();
        $sampleModel = EquipmentModel::first();
        
        if ($sampleBrand && $sampleType && $sampleModel) {
            $this->line("   Marca de prueba: {$sampleBrand->name} (ID: {$sampleBrand->id})");
            $this->line("   Tipo de prueba: {$sampleType->name} (ID: {$sampleType->id})");
            $this->line("   Modelo de prueba: {$sampleModel->name} (ID: {$sampleModel->id})");
        }
        
        $this->newLine();
        $this->info('✅ PRUEBA COMPLETADA');
    }
}


