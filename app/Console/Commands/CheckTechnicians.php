<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckTechnicians extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'technicians:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica los técnicos disponibles en el sistema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== TÉCNICOS DISPONIBLES ===');
        
        $technicians = User::whereHas('roles', function($query) {
            $query->where('name', 'tecnico');
        })->select('id', 'name', 'email')->get();

        if ($technicians->count() > 0) {
            foreach ($technicians as $tech) {
                $this->line("ID: {$tech->id} - {$tech->name} ({$tech->email})");
            }
            $this->newLine();
            $this->info("Total técnicos: {$technicians->count()}");
        } else {
            $this->error('No hay técnicos en el sistema');
        }
    }
}


