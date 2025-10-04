<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos
        $permissions = [
            'manage_users' => 'Gestionar usuarios',
            'manage_roles' => 'Gestionar roles y permisos',
            'manage_equipment' => 'Gestionar equipos de reparación',
            'manage_tickets' => 'Gestionar tickets',
            'view_tickets' => 'Ver tickets',
            'manage_invoices' => 'Gestionar facturas',
            'view_invoices' => 'Ver facturas',
            'view_reports' => 'Ver reportes'
        ];

        foreach ($permissions as $name => $description) {
            Permission::firstOrCreate([
                'name' => $name
            ], [
                'description' => $description
            ]);
        }

        // Crear roles
        $adminRole = Role::firstOrCreate([
            'name' => 'admin'
        ], [
            'display_name' => 'Administrador',
            'description' => 'Acceso completo al sistema'
        ]);

        $tecnicoRole = Role::firstOrCreate([
            'name' => 'tecnico'
        ], [
            'display_name' => 'Técnico',
            'description' => 'Acceso a equipos, tickets y facturas'
        ]);

        // Asignar permisos a roles
        $adminRole->permissions()->sync(Permission::all()->pluck('id'));
        
        $tecnicoRole->permissions()->sync([
            Permission::where('name', 'manage_equipment')->first()->id,
            Permission::where('name', 'manage_tickets')->first()->id,
            Permission::where('name', 'view_tickets')->first()->id,
            Permission::where('name', 'manage_invoices')->first()->id,
            Permission::where('name', 'view_invoices')->first()->id,
            Permission::where('name', 'view_reports')->first()->id,
        ]);

        // Crear usuarios
        $admin = User::firstOrCreate([
            'email' => 'admin@ticomsys.com'
        ], [
            'name' => 'Administrador',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now()
        ]);

        $tecnico = User::firstOrCreate([
            'email' => 'tecnico@ticomsys.com'
        ], [
            'name' => 'Técnico Principal',
            'password' => Hash::make('tecnico123'),
            'email_verified_at' => now()
        ]);

        // Asignar roles a usuarios
        $admin->roles()->sync([$adminRole->id]);
        $tecnico->roles()->sync([$tecnicoRole->id]);

        $this->command->info('Roles, permisos y usuarios creados exitosamente.');
    }
}