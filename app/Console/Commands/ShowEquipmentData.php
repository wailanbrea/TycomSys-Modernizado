<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EquipmentBrand;
use App\Models\EquipmentType;
use App\Models\EquipmentModel;

class ShowEquipmentData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'equipment:show-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Muestra las marcas, tipos y modelos de equipos disponibles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== DATOS DE EQUIPOS DISPONIBLES ===');
        $this->newLine();

        // Mostrar tipos de equipos
        $this->info('📱 <fg=cyan>TIPOS DE EQUIPOS:</>');
        $types = EquipmentType::with('models')->get();
        foreach ($types as $type) {
            $this->line("   • {$type->display_name} ({$type->name}) - {$type->models->count()} modelos");
        }
        $this->newLine();

        // Mostrar marcas
        $this->info('🏷️ <fg=cyan>MARCAS DISPONIBLES:</>');
        $brands = EquipmentBrand::with('models')->get();
        foreach ($brands as $brand) {
            $this->line("   • {$brand->display_name} ({$brand->name}) - {$brand->models->count()} modelos");
        }
        $this->newLine();

        // Mostrar modelos por marca
        $this->info('💻 <fg=cyan>MODELOS POR MARCA:</>');
        foreach ($brands as $brand) {
            $this->line("   <fg=yellow>{$brand->display_name}:</>");
            $models = $brand->models()->with('type')->get();
            foreach ($models as $model) {
                $this->line("     - {$model->display_name} ({$model->type->display_name})");
            }
            $this->newLine();
        }

        $this->info("📊 <fg=green>Resumen:</>");
        $this->line("   Total tipos: " . EquipmentType::count());
        $this->line("   Total marcas: " . EquipmentBrand::count());
        $this->line("   Total modelos: " . EquipmentModel::count());
    }
}







