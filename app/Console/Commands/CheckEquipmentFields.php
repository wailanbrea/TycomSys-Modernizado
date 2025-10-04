<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RepairEquipment;
use App\Models\EquipmentBrand;
use App\Models\EquipmentType;
use App\Models\EquipmentModel;

class CheckEquipmentFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'equipment:check-fields';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica los campos de equipos y sus relaciones';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== VERIFICACIÓN DE CAMPOS DE EQUIPOS ===');
        
        // Verificar un equipo de ejemplo
        $equipment = RepairEquipment::with(['brand', 'type', 'model', 'assignedTechnician'])->first();
        
        if ($equipment) {
            $this->info('Equipo de ejemplo:');
            $this->line("ID: {$equipment->id}");
            $this->line("Ticket: {$equipment->ticket_number}");
            $this->line("Cliente: {$equipment->customer_name}");
            $this->line("Teléfono: {$equipment->customer_phone}");
            $this->line("Email: {$equipment->customer_email}");
            $this->line("Número de serie: {$equipment->serial_number}");
            $this->line("Descripción: {$equipment->problem_description}");
            $this->line("Accesorios: {$equipment->accessories}");
            $this->line("Notas: {$equipment->notes}");
            $this->line("Costo estimado: {$equipment->estimated_cost}");
            $this->line("Costo final: {$equipment->final_cost}");
            $this->line("Estado: {$equipment->status}");
            $this->line("Fecha estimada: {$equipment->estimated_delivery}");
            $this->line("Fecha de entrega: {$equipment->delivered_at}");
            
            $this->newLine();
            $this->info('Relaciones:');
            $this->line("Marca ID: {$equipment->brand_id}");
            $this->line("Marca: " . (is_object($equipment->brand) ? $equipment->brand->name : 'Sin marca'));
            $this->line("Tipo ID: {$equipment->type_id}");
            $this->line("Tipo: " . (is_object($equipment->type) ? $equipment->type->name : 'Sin tipo'));
            $this->line("Modelo ID: {$equipment->model_id}");
            $this->line("Modelo: " . (is_object($equipment->model) ? $equipment->model->name : 'Sin modelo'));
            $this->line("Técnico ID: {$equipment->assigned_technician_id}");
            $this->line("Técnico: " . ($equipment->assignedTechnician ? $equipment->assignedTechnician->name : 'Sin asignar'));
        } else {
            $this->error('No hay equipos en la base de datos');
        }
        
        $this->newLine();
        
        // Verificar marcas disponibles
        $this->info('Marcas disponibles:');
        $brands = EquipmentBrand::all();
        foreach ($brands as $brand) {
            $this->line("• {$brand->id} - {$brand->name}");
        }
        
        $this->newLine();
        
        // Verificar tipos disponibles
        $this->info('Tipos disponibles:');
        $types = EquipmentType::all();
        foreach ($types as $type) {
            $this->line("• {$type->id} - {$type->name}");
        }
        
        $this->newLine();
        
        // Verificar modelos disponibles
        $this->info('Modelos disponibles:');
        $models = EquipmentModel::with(['brand', 'type'])->get();
        foreach ($models as $model) {
            $brandName = $model->brand ? $model->brand->name : 'Sin marca';
            $typeName = $model->type ? $model->type->name : 'Sin tipo';
            $this->line("• {$model->id} - {$model->name} ({$brandName} - {$typeName})");
        }
    }
}
