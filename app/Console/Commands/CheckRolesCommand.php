<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Console\Command;

class CheckRolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verificar el sistema de roles y permisos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== SISTEMA DE ROLES Y PERMISOS ===');
        $this->newLine();

        // Mostrar roles
        $this->info('ROLES:');
        $roles = Role::with('permissions')->get();
        foreach ($roles as $role) {
            $this->line("• {$role->display_name} ({$role->name})");
            $this->line("  Descripción: {$role->description}");
            $this->line("  Permisos: " . $role->permissions->pluck('display_name')->join(', '));
            $this->newLine();
        }

        // Mostrar usuarios
        $this->info('USUARIOS:');
        $users = User::with('roles')->get();
        foreach ($users as $user) {
            $this->line("• {$user->name} ({$user->email})");
            $this->line("  Roles: " . $user->roles->pluck('display_name')->join(', '));
            $this->newLine();
        }

        // Mostrar permisos
        $this->info('PERMISOS:');
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $this->line("• {$permission->display_name} ({$permission->name})");
        }

        $this->newLine();
        $this->info('=== CREDENCIALES DE ACCESO ===');
        $this->line('Admin: admin@ticomsys.com / admin123');
        $this->line('Técnico: tecnico@ticomsys.com / tecnico123');
    }
}
