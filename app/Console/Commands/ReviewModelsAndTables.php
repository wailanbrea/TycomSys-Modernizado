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
use App\Models\EquipmentStatus;
use App\Models\Ticket;

class ReviewModelsAndTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'review:models-tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa todos los modelos de datos y tablas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== REVISIÓN COMPLETA DE MODELOS Y TABLAS ===');
        $this->newLine();

        // 1. Revisar estructura de tablas
        $this->info('📋 ESTRUCTURA DE TABLAS:');
        $this->reviewTableStructure();

        $this->newLine();

        // 2. Revisar modelos
        $this->info('🏗️ MODELOS DE DATOS:');
        $this->reviewModels();

        $this->newLine();

        // 3. Revisar relaciones
        $this->info('🔗 RELACIONES ENTRE MODELOS:');
        $this->reviewRelationships();

        $this->newLine();

        // 4. Revisar datos
        $this->info('📊 DATOS EN LAS TABLAS:');
        $this->reviewData();

        $this->newLine();

        // 5. Verificar integridad
        $this->info('✅ VERIFICACIÓN DE INTEGRIDAD:');
        $this->verifyIntegrity();

        $this->newLine();
        $this->info('✅ Revisión completada');
    }

    private function reviewTableStructure()
    {
        $tables = [
            'users' => 'Usuarios del sistema',
            'roles' => 'Roles de usuario',
            'permissions' => 'Permisos del sistema',
            'role_user' => 'Relación Usuario-Rol',
            'permission_role' => 'Relación Rol-Permiso',
            'repair_equipment' => 'Equipos de reparación',
            'equipment_statuses' => 'Historial de estados',
            'equipment_brands' => 'Marcas de equipos',
            'equipment_types' => 'Tipos de equipos',
            'equipment_models' => 'Modelos de equipos',
            'tickets' => 'Tickets de soporte'
        ];

        foreach ($tables as $table => $description) {
            $exists = Schema::hasTable($table);
            $status = $exists ? '✅' : '❌';
            $this->line("   {$status} {$description} ({$table})");
            
            if ($exists) {
                $columns = Schema::getColumnListing($table);
                $this->line("      Columnas: " . implode(', ', $columns));
            }
        }
    }

    private function reviewModels()
    {
        $models = [
            'User' => User::class,
            'Role' => Role::class,
            'Permission' => Permission::class,
            'RepairEquipment' => RepairEquipment::class,
            'EquipmentBrand' => EquipmentBrand::class,
            'EquipmentType' => EquipmentType::class,
            'EquipmentModel' => EquipmentModel::class,
            'EquipmentStatus' => EquipmentStatus::class,
            'Ticket' => Ticket::class
        ];

        foreach ($models as $name => $class) {
            $this->line("   📦 {$name}:");
            
            // Verificar fillable
            $instance = new $class;
            $fillable = $instance->getFillable();
            $this->line("      Fillable: " . implode(', ', $fillable));
            
            // Verificar casts
            $casts = $instance->getCasts();
            if (!empty($casts)) {
                $this->line("      Casts: " . implode(', ', array_keys($casts)));
            }
        }
    }

    private function reviewRelationships()
    {
        $this->line("   🔗 User:");
        $this->line("      - roles() -> BelongsToMany");
        $this->line("      - hasRole(), hasPermissionTo()");
        
        $this->line("   🔗 Role:");
        $this->line("      - users() -> BelongsToMany");
        $this->line("      - permissions() -> BelongsToMany");
        
        $this->line("   🔗 Permission:");
        $this->line("      - roles() -> BelongsToMany");
        
        $this->line("   🔗 RepairEquipment:");
        $this->line("      - brand() -> BelongsTo(EquipmentBrand)");
        $this->line("      - type() -> BelongsTo(EquipmentType)");
        $this->line("      - model() -> BelongsTo(EquipmentModel)");
        $this->line("      - assignedTechnician() -> BelongsTo(User)");
        $this->line("      - createdBy() -> BelongsTo(User)");
        $this->line("      - statusHistory() -> HasMany(EquipmentStatus)");
        $this->line("      - tickets() -> HasMany(Ticket)");
        
        $this->line("   🔗 EquipmentBrand:");
        $this->line("      - models() -> HasMany(EquipmentModel)");
        
        $this->line("   🔗 EquipmentType:");
        $this->line("      - models() -> HasMany(EquipmentModel)");
        
        $this->line("   🔗 EquipmentModel:");
        $this->line("      - brand() -> BelongsTo(EquipmentBrand)");
        $this->line("      - type() -> BelongsTo(EquipmentType)");
        
        $this->line("   🔗 EquipmentStatus:");
        $this->line("      - repairEquipment() -> BelongsTo(RepairEquipment)");
        $this->line("      - updatedBy() -> BelongsTo(User)");
        
        $this->line("   🔗 Ticket:");
        $this->line("      - repairEquipment() -> BelongsTo(RepairEquipment)");
        $this->line("      - assignedTo() -> BelongsTo(User)");
        $this->line("      - createdBy() -> BelongsTo(User)");
    }

    private function reviewData()
    {
        $this->line("   👥 Usuarios: " . User::count());
        $this->line("   🎭 Roles: " . Role::count());
        $this->line("   🔐 Permisos: " . Permission::count());
        $this->line("   🏷️ Marcas: " . EquipmentBrand::count());
        $this->line("   📱 Tipos: " . EquipmentType::count());
        $this->line("   💻 Modelos: " . EquipmentModel::count());
        $this->line("   🔧 Equipos: " . RepairEquipment::count());
        $this->line("   📊 Estados: " . EquipmentStatus::count());
        $this->line("   🎫 Tickets: " . Ticket::count());
        
        // Verificar usuarios con roles
        $usersWithRoles = User::whereHas('roles')->count();
        $this->line("   👥 Usuarios con roles: {$usersWithRoles}");
        
        // Verificar equipos con relaciones completas
        $equipmentsWithRelations = RepairEquipment::whereNotNull('brand_id')
            ->whereNotNull('type_id')
            ->whereNotNull('model_id')
            ->count();
        $this->line("   🔧 Equipos con relaciones completas: {$equipmentsWithRelations}");
    }

    private function verifyIntegrity()
    {
        // Verificar equipos sin marca/tipo/modelo
        $equipmentsWithoutBrand = RepairEquipment::whereNull('brand_id')->count();
        $equipmentsWithoutType = RepairEquipment::whereNull('type_id')->count();
        $equipmentsWithoutModel = RepairEquipment::whereNull('model_id')->count();
        
        if ($equipmentsWithoutBrand === 0) {
            $this->line("   ✅ Todos los equipos tienen marca");
        } else {
            $this->error("   ❌ {$equipmentsWithoutBrand} equipos sin marca");
        }
        
        if ($equipmentsWithoutType === 0) {
            $this->line("   ✅ Todos los equipos tienen tipo");
        } else {
            $this->error("   ❌ {$equipmentsWithoutType} equipos sin tipo");
        }
        
        if ($equipmentsWithoutModel === 0) {
            $this->line("   ✅ Todos los equipos tienen modelo");
        } else {
            $this->error("   ❌ {$equipmentsWithoutModel} equipos sin modelo");
        }
        
        // Verificar relaciones funcionando
        $equipment = RepairEquipment::with(['brand', 'type', 'model', 'assignedTechnician'])->first();
        if ($equipment) {
            $brandOk = is_object($equipment->brand) && $equipment->brand->name;
            $typeOk = is_object($equipment->type) && $equipment->type->name;
            $modelOk = is_object($equipment->model) && $equipment->model->name;
            $techOk = is_object($equipment->assignedTechnician) && $equipment->assignedTechnician->name;
            
            if ($brandOk && $typeOk && $modelOk && $techOk) {
                $this->line("   ✅ Relaciones funcionando correctamente");
                $this->line("      Ejemplo: {$equipment->brand->name} {$equipment->model->name} ({$equipment->type->name}) - {$equipment->assignedTechnician->name}");
            } else {
                $this->error("   ❌ Problemas con las relaciones");
            }
        }
        
        // Verificar modelos con marcas y tipos válidos
        $modelsWithInvalidBrand = EquipmentModel::whereNotIn('brand_id', EquipmentBrand::pluck('id'))->count();
        $modelsWithInvalidType = EquipmentModel::whereNotIn('type_id', EquipmentType::pluck('id'))->count();
        
        if ($modelsWithInvalidBrand === 0) {
            $this->line("   ✅ Todos los modelos tienen marcas válidas");
        } else {
            $this->error("   ❌ {$modelsWithInvalidBrand} modelos con marcas inválidas");
        }
        
        if ($modelsWithInvalidType === 0) {
            $this->line("   ✅ Todos los modelos tienen tipos válidos");
        } else {
            $this->error("   ❌ {$modelsWithInvalidType} modelos con tipos inválidos");
        }
    }
}






