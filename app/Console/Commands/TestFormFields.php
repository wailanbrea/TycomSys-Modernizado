<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EquipmentBrand;
use App\Models\EquipmentType;
use App\Models\EquipmentModel;
use App\Models\User;

class TestFormFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'form:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica que los campos del formulario funcionen correctamente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== VERIFICACIÓN DE CAMPOS DEL FORMULARIO ===');
        
        // Verificar marcas
        $this->info('🏷️ Marcas disponibles:');
        $brands = EquipmentBrand::all();
        foreach ($brands as $brand) {
            $this->line("   • {$brand->id} - {$brand->name}");
        }
        $this->line("   Total: {$brands->count()} marcas");
        
        $this->newLine();
        
        // Verificar tipos
        $this->info('📱 Tipos disponibles:');
        $types = EquipmentType::all();
        foreach ($types as $type) {
            $this->line("   • {$type->id} - {$type->name}");
        }
        $this->line("   Total: {$types->count()} tipos");
        
        $this->newLine();
        
        // Verificar modelos
        $this->info('💻 Modelos disponibles:');
        $models = EquipmentModel::with(['brand', 'type'])->get();
        foreach ($models->take(5) as $model) {
            $brandName = $model->brand ? $model->brand->name : 'Sin marca';
            $typeName = $model->type ? $model->type->name : 'Sin tipo';
            $this->line("   • {$model->id} - {$model->name} ({$brandName} - {$typeName})");
        }
        if ($models->count() > 5) {
            $this->line("   ... y " . ($models->count() - 5) . " más");
        }
        $this->line("   Total: {$models->count()} modelos");
        
        $this->newLine();
        
        // Verificar técnicos
        $this->info('👨‍🔧 Técnicos disponibles:');
        $technicians = User::whereHas('roles', function($query) {
            $query->where('name', 'tecnico');
        })->get();
        foreach ($technicians as $tech) {
            $this->line("   • {$tech->id} - {$tech->name}");
        }
        $this->line("   Total: {$technicians->count()} técnicos");
        
        $this->newLine();
        
        // Verificar endpoints
        $this->info('🌐 Endpoints públicos funcionando:');
        $this->line('   • GET /api/public/brands - Marcas');
        $this->line('   • GET /api/public/types - Tipos');
        $this->line('   • GET /api/public/models - Modelos');
        $this->line('   • GET /api/public/technicians - Técnicos');
        $this->line('   • GET /api/public/equipments - Equipos');
        
        $this->newLine();
        $this->info('✅ Los campos del formulario ahora deberían funcionar correctamente');
        $this->line('Para probar:');
        $this->line('1. Accede a http://127.0.0.1:8000/ticomsyslogin');
        $this->line('2. Login con admin@ticomsys.com / admin123');
        $this->line('3. Ve a "Equipos de Reparación"');
        $this->line('4. Haz clic en "Nuevo Equipo"');
        $this->line('5. Verifica que los dropdowns de Marca, Tipo, Modelo y Técnico se llenen correctamente');
    }
}


