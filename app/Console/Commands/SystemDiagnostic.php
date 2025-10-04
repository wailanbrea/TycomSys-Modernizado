<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RepairEquipment;
use App\Models\EquipmentBrand;
use App\Models\EquipmentType;
use App\Models\EquipmentModel;
use App\Models\Ticket;

class SystemDiagnostic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:diagnostic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diagnóstico completo del sistema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== DIAGNÓSTICO COMPLETO DEL SISTEMA ===');
        $this->newLine();

        // 1. Verificar tablas
        $this->info('📋 VERIFICACIÓN DE TABLAS:');
        $tables = [
            'users' => 'Usuarios',
            'roles' => 'Roles',
            'permissions' => 'Permisos',
            'role_user' => 'Relación Usuario-Rol',
            'permission_role' => 'Relación Rol-Permiso',
            'repair_equipment' => 'Equipos de Reparación',
            'equipment_statuses' => 'Estados de Equipos',
            'equipment_brands' => 'Marcas de Equipos',
            'equipment_types' => 'Tipos de Equipos',
            'equipment_models' => 'Modelos de Equipos',
            'tickets' => 'Tickets'
        ];

        foreach ($tables as $table => $description) {
            $exists = Schema::hasTable($table);
            $status = $exists ? '✅' : '❌';
            $this->line("   {$status} {$description} ({$table})");
        }

        $this->newLine();

        // 2. Verificar datos
        $this->info('📊 VERIFICACIÓN DE DATOS:');
        
        // Usuarios
        $userCount = User::count();
        $this->line("   👥 Usuarios: {$userCount}");
        
        // Roles
        $roleCount = Role::count();
        $this->line("   🎭 Roles: {$roleCount}");
        
        // Permisos
        $permissionCount = Permission::count();
        $this->line("   🔐 Permisos: {$permissionCount}");
        
        // Marcas
        $brandCount = EquipmentBrand::count();
        $this->line("   🏷️ Marcas: {$brandCount}");
        
        // Tipos
        $typeCount = EquipmentType::count();
        $this->line("   📱 Tipos: {$typeCount}");
        
        // Modelos
        $modelCount = EquipmentModel::count();
        $this->line("   💻 Modelos: {$modelCount}");
        
        // Equipos
        $equipmentCount = RepairEquipment::count();
        $this->line("   🔧 Equipos: {$equipmentCount}");
        
        // Tickets
        $ticketCount = Ticket::count();
        $this->line("   🎫 Tickets: {$ticketCount}");

        $this->newLine();

        // 3. Verificar relaciones
        $this->info('🔗 VERIFICACIÓN DE RELACIONES:');
        
        // Verificar un equipo de ejemplo
        $equipment = RepairEquipment::with(['brand', 'type', 'model', 'assignedTechnician'])->first();
        if ($equipment) {
            $this->line("   📋 Equipo de ejemplo: {$equipment->ticket_number}");
            $this->line("   🏷️ Marca ID: {$equipment->brand_id} - " . (is_object($equipment->brand) ? $equipment->brand->name : 'SIN MARCA'));
            $this->line("   📱 Tipo ID: {$equipment->type_id} - " . (is_object($equipment->type) ? $equipment->type->name : 'SIN TIPO'));
            $this->line("   💻 Modelo ID: {$equipment->model_id} - " . (is_object($equipment->model) ? $equipment->model->name : 'SIN MODELO'));
            $this->line("   👨‍🔧 Técnico: " . ($equipment->assignedTechnician ? $equipment->assignedTechnician->name : 'SIN ASIGNAR'));
        } else {
            $this->error('   ❌ No hay equipos en la base de datos');
        }

        $this->newLine();

        // 4. Verificar endpoints
        $this->info('🌐 VERIFICACIÓN DE ENDPOINTS:');
        $endpoints = [
            '/api/public/technicians' => 'Técnicos',
            '/api/public/brands' => 'Marcas',
            '/api/public/types' => 'Tipos',
            '/api/public/models' => 'Modelos',
            '/api/public/equipments' => 'Equipos'
        ];

        foreach ($endpoints as $endpoint => $description) {
            $this->line("   🔗 {$description}: {$endpoint}");
        }

        $this->newLine();

        // 5. Verificar problemas específicos
        $this->info('🔍 VERIFICACIÓN DE PROBLEMAS:');
        
        // Verificar equipos sin marca/tipo/modelo
        $equipmentsWithoutBrand = RepairEquipment::whereNull('brand_id')->count();
        $equipmentsWithoutType = RepairEquipment::whereNull('type_id')->count();
        $equipmentsWithoutModel = RepairEquipment::whereNull('model_id')->count();
        
        if ($equipmentsWithoutBrand > 0) {
            $this->error("   ❌ {$equipmentsWithoutBrand} equipos sin marca");
        } else {
            $this->line("   ✅ Todos los equipos tienen marca");
        }
        
        if ($equipmentsWithoutType > 0) {
            $this->error("   ❌ {$equipmentsWithoutType} equipos sin tipo");
        } else {
            $this->line("   ✅ Todos los equipos tienen tipo");
        }
        
        if ($equipmentsWithoutModel > 0) {
            $this->error("   ❌ {$equipmentsWithoutModel} equipos sin modelo");
        } else {
            $this->line("   ✅ Todos los equipos tienen modelo");
        }

        $this->newLine();

        // 6. Recomendaciones
        $this->info('💡 RECOMENDACIONES:');
        if ($equipmentsWithoutBrand > 0 || $equipmentsWithoutType > 0 || $equipmentsWithoutModel > 0) {
            $this->line("   🔄 Ejecutar: php artisan db:seed --class=RepairEquipmentSeeder");
            $this->line("   🔄 Esto actualizará los equipos existentes con las nuevas relaciones");
        }
        
        $this->line("   🌐 Probar endpoints en: http://127.0.0.1:8000/api/public/...");
        $this->line("   🖥️ Probar interfaz en: http://127.0.0.1:8000/ticomsyslogin");

        $this->newLine();
        $this->info('✅ Diagnóstico completado');
    }
}
