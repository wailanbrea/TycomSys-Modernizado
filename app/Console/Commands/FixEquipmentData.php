<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RepairEquipment;
use App\Models\EquipmentBrand;
use App\Models\EquipmentType;
use App\Models\EquipmentModel;

class FixEquipmentData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'equipment:fix-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Arregla los datos de equipos existentes para usar las nuevas relaciones';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== ARREGLANDO DATOS DE EQUIPOS ===');
        
        // Obtener todos los equipos
        $equipments = RepairEquipment::all();
        
        $this->info("Encontrados {$equipments->count()} equipos para actualizar");
        
        foreach ($equipments as $equipment) {
            $this->line("Procesando: {$equipment->ticket_number}");
            
            // Verificar si ya tiene las relaciones correctas
            if ($equipment->brand_id && $equipment->type_id && $equipment->model_id) {
                $this->line("  ✅ Ya tiene relaciones correctas");
                continue;
            }
            
            // Intentar mapear por los campos antiguos si existen
            $brandId = null;
            $typeId = null;
            $modelId = null;
            
            // Mapear marca
            if ($equipment->brand) {
                $brand = EquipmentBrand::where('name', 'like', '%' . strtolower($equipment->brand) . '%')->first();
                if ($brand) {
                    $brandId = $brand->id;
                    $this->line("  🏷️ Marca mapeada: {$equipment->brand} -> {$brand->name}");
                }
            }
            
            // Mapear tipo
            if ($equipment->equipment_type) {
                $type = EquipmentType::where('name', 'like', '%' . strtolower($equipment->equipment_type) . '%')->first();
                if ($type) {
                    $typeId = $type->id;
                    $this->line("  📱 Tipo mapeado: {$equipment->equipment_type} -> {$type->name}");
                }
            }
            
            // Mapear modelo
            if ($equipment->model && $brandId && $typeId) {
                $model = EquipmentModel::where('name', 'like', '%' . $equipment->model . '%')
                    ->where('brand_id', $brandId)
                    ->where('type_id', $typeId)
                    ->first();
                if ($model) {
                    $modelId = $model->id;
                    $this->line("  💻 Modelo mapeado: {$equipment->model} -> {$model->name}");
                }
            }
            
            // Si no se pudo mapear, usar valores por defecto
            if (!$brandId) {
                $brandId = 1; // Dell
                $this->line("  🔧 Usando marca por defecto: Dell");
            }
            
            if (!$typeId) {
                $typeId = 1; // Laptop
                $this->line("  🔧 Usando tipo por defecto: Laptop");
            }
            
            if (!$modelId) {
                $modelId = 1; // Inspiron 15 3000
                $this->line("  🔧 Usando modelo por defecto: Inspiron 15 3000");
            }
            
            // Actualizar el equipo
            $equipment->update([
                'brand_id' => $brandId,
                'type_id' => $typeId,
                'model_id' => $modelId
            ]);
            
            $this->line("  ✅ Equipo actualizado");
        }
        
        $this->newLine();
        $this->info('✅ Datos de equipos arreglados');
        
        // Verificar el resultado
        $this->info('Verificando resultado...');
        $equipment = RepairEquipment::with(['brand', 'type', 'model'])->first();
        if ($equipment) {
            $this->line("Equipo de ejemplo: {$equipment->ticket_number}");
            $this->line("Marca: " . ($equipment->brand ? $equipment->brand->name : 'SIN MARCA'));
            $this->line("Tipo: " . ($equipment->type ? $equipment->type->name : 'SIN TIPO'));
            $this->line("Modelo: " . ($equipment->model ? $equipment->model->name : 'SIN MODELO'));
        }
    }
}






