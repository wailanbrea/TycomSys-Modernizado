<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class CheckTableColumns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:table-columns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica las columnas de las tablas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== VERIFICACIÓN DE COLUMNAS DE TABLAS ===');
        
        $tables = [
            'equipment_brands',
            'equipment_types', 
            'equipment_models',
            'repair_equipment'
        ];
        
        foreach ($tables as $table) {
            $this->line("📋 {$table}:");
            $columns = Schema::getColumnListing($table);
            foreach ($columns as $column) {
                $this->line("   • {$column}");
            }
            $this->newLine();
        }
    }
}


