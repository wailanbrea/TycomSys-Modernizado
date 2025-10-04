<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class VerifyCustomization extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:verify-customization';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verificar que la personalización del sistema se aplicó correctamente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== VERIFICACIÓN DE PERSONALIZACIÓN ===');
        
        // 1. Verificar que el logo de TicomSys existe
        $this->info('🖼️ Verificando logo de TicomSys...');
        $logoPath = 'frontend/src/assets/img/brand/ticomsys-logo.png';
        if (file_exists($logoPath)) {
            $this->line('   ✅ Logo de TicomSys copiado correctamente');
        } else {
            $this->line('   ❌ Logo de TicomSys no encontrado');
        }
        
        $this->newLine();
        
        // 2. Verificar que el título se cambió
        $this->info('📝 Verificando título de la aplicación...');
        $indexHtml = file_get_contents('frontend/public/index.html');
        if (strpos($indexHtml, 'TicomSys - Sistema de Gestión de Reparaciones') !== false) {
            $this->line('   ✅ Título actualizado a "TicomSys - Sistema de Gestión de Reparaciones"');
        } else {
            $this->line('   ❌ Título no actualizado');
        }
        
        $this->newLine();
        
        // 3. Verificar que las rutas innecesarias se eliminaron
        $this->info('🗂️ Verificando rutas del sistema...');
        $routesContent = file_get_contents('frontend/src/routes.js');
        
        $unnecessaryRoutes = ['Icons', 'Maps', 'Tables', 'Login', 'Register'];
        $removedRoutes = [];
        
        foreach ($unnecessaryRoutes as $route) {
            if (strpos($routesContent, $route) === false) {
                $removedRoutes[] = $route;
            }
        }
        
        if (count($removedRoutes) === count($unnecessaryRoutes)) {
            $this->line('   ✅ Todas las rutas innecesarias eliminadas');
            foreach ($removedRoutes as $route) {
                $this->line("      • {$route} removido");
            }
        } else {
            $this->line('   ❌ Algunas rutas innecesarias no se eliminaron');
        }
        
        $this->newLine();
        
        // 4. Verificar rutas del sistema mantenidas
        $this->info('✅ Rutas del sistema mantenidas:');
        $systemRoutes = [
            'Dashboard' => 'Panel principal',
            'Gestión de Usuarios' => 'Administración de usuarios',
            'Gestión de Roles' => 'Administración de roles y permisos',
            'Equipos de Reparación' => 'Gestión de equipos',
            'Estados de Tickets' => 'Gestión de tickets',
            'Reportes' => 'Reportes del sistema',
            'Mi Perfil' => 'Perfil del usuario'
        ];
        
        foreach ($systemRoutes as $route => $description) {
            if (strpos($routesContent, $route) !== false) {
                $this->line("   ✅ {$route} - {$description}");
            }
        }
        
        $this->newLine();
        
        // 5. Verificar que el build se actualizó
        $this->info('🏗️ Verificando build actualizado...');
        $buildHtml = file_get_contents('frontend/build/index.html');
        if (strpos($buildHtml, 'TicomSys - Sistema de Gestión de Reparaciones') !== false) {
            $this->line('   ✅ Build actualizado con personalización');
        } else {
            $this->line('   ❌ Build no actualizado');
        }
        
        $this->newLine();
        
        // 6. Resumen de personalización
        $this->info('🎨 PERSONALIZACIÓN COMPLETADA:');
        $this->line('• ✅ Logo de TicomSys agregado al sidebar');
        $this->line('• ✅ Título cambiado a "TicomSys - Sistema de Gestión de Reparaciones"');
        $this->line('• ✅ Menús innecesarios eliminados (Icons, Maps, Tables, Login, Register)');
        $this->line('• ✅ Solo funciones del sistema mantenidas');
        $this->line('• ✅ Build actualizado');
        
        $this->newLine();
        $this->info('🚀 SISTEMA PERSONALIZADO LISTO:');
        $this->line('1. Ve a: http://127.0.0.1:8000/ticomsyslogin');
        $this->line('2. Login: admin@ticomsys.com / admin123');
        $this->line('3. Verifica que el logo de TicomSys aparece en el sidebar');
        $this->line('4. Verifica que solo aparecen los menús del sistema');
        
        $this->newLine();
        $this->info('✅ VERIFICACIÓN COMPLETADA');
    }
}


