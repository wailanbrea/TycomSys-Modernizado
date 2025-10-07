<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica el estado de autenticación';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== VERIFICACIÓN DE AUTENTICACIÓN ===');
        
        // Verificar configuración de sesión
        $this->info('Configuración de sesión:');
        $this->line('Driver: ' . config('session.driver'));
        $this->line('Lifetime: ' . config('session.lifetime'));
        $this->line('Domain: ' . config('session.domain'));
        $this->line('Secure: ' . (config('session.secure') ? 'true' : 'false'));
        $this->line('SameSite: ' . config('session.same_site'));
        
        $this->newLine();
        
        // Verificar middleware
        $this->info('Middleware registrados:');
        $middleware = app('router')->getMiddleware();
        foreach ($middleware as $name => $class) {
            $this->line("• {$name}: {$class}");
        }
        
        $this->newLine();
        
        // Verificar usuarios
        $this->info('Usuarios disponibles:');
        $users = User::with('roles')->get();
        foreach ($users as $user) {
            $roles = $user->roles->pluck('name')->join(', ');
            $this->line("• {$user->name} ({$user->email}) - Roles: {$roles}");
        }
        
        $this->newLine();
        $this->info('Para probar autenticación:');
        $this->line('1. Accede a http://127.0.0.1:8000/ticomsyslogin');
        $this->line('2. Login con admin@ticomsys.com / admin123');
        $this->line('3. Verifica que las cookies de sesión se establezcan');
    }
}






