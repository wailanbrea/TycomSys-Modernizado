<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RepairEquipment;
use App\Models\EquipmentBrand;
use App\Models\EquipmentType;
use App\Models\EquipmentModel;

class DebugRelations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug:relations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debug de las relaciones de equipos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== DEBUG DE RELACIONES ===');
        
        // Verificar un equipo específico
        $equipment = RepairEquipment::first();
        if (!$equipment) {
            $this->error('No hay equipos en la base de datos');
            return;
        }
        
        $this->line("Equipo: {$equipment->ticket_number}");
        $this->line("brand_id: {$equipment->brand_id}");
        $this->line("type_id: {$equipment->type_id}");
        $this->line("model_id: {$equipment->model_id}");
        
        $this->newLine();
        
        // Verificar si las marcas existen
        $brand = EquipmentBrand::find($equipment->brand_id);
        $this->line("Marca encontrada: " . ($brand ? "SÍ - {$brand->name}" : "NO"));
        
        $type = EquipmentType::find($equipment->type_id);
        $this->line("Tipo encontrado: " . ($type ? "SÍ - {$type->name}" : "NO"));
        
        $model = EquipmentModel::find($equipment->model_id);
        $this->line("Modelo encontrado: " . ($model ? "SÍ - {$model->name}" : "NO"));
        
        $this->newLine();
        
        // Intentar cargar las relaciones manualmente
        $this->line("Intentando cargar relaciones...");
        
        try {
            $equipmentWithRelations = RepairEquipment::with(['brand', 'type', 'model'])->find($equipment->id);
            
            $this->line("brand relation: " . gettype($equipmentWithRelations->brand));
            $this->line("type relation: " . gettype($equipmentWithRelations->type));
            $this->line("model relation: " . gettype($equipmentWithRelations->model));
            
            if (is_object($equipmentWithRelations->brand)) {
                $this->line("Marca cargada: {$equipmentWithRelations->brand->name}");
            } else {
                $this->line("Marca no es objeto: " . $equipmentWithRelations->brand);
            }
            
            if (is_object($equipmentWithRelations->type)) {
                $this->line("Tipo cargado: {$equipmentWithRelations->type->name}");
            } else {
                $this->line("Tipo no es objeto: " . $equipmentWithRelations->type);
            }
            
            if (is_object($equipmentWithRelations->model)) {
                $this->line("Modelo cargado: {$equipmentWithRelations->model->name}");
            } else {
                $this->line("Modelo no es objeto: " . $equipmentWithRelations->model);
            }
            
        } catch (\Exception $e) {
            $this->error("Error al cargar relaciones: " . $e->getMessage());
        }
        
        $this->newLine();
        
        // Verificar estructura de las tablas
        $this->line("Verificando estructura de tablas...");
        
        $brandTable = \Illuminate\Support\Facades\Schema::getColumnListing('equipment_brands');
        $this->line("equipment_brands columns: " . implode(', ', $brandTable));
        
        $typeTable = \Illuminate\Support\Facades\Schema::getColumnListing('equipment_types');
        $this->line("equipment_types columns: " . implode(', ', $typeTable));
        
        $modelTable = \Illuminate\Support\Facades\Schema::getColumnListing('equipment_models');
        $this->line("equipment_models columns: " . implode(', ', $modelTable));
        
        $equipmentTable = \Illuminate\Support\Facades\Schema::getColumnListing('repair_equipment');
        $this->line("repair_equipment columns: " . implode(', ', $equipmentTable));
    }
}


