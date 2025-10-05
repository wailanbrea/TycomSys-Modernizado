<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SystemSetting;
use App\Http\Controllers\SystemConfigController;
use Illuminate\Http\Request;

class TestSystemConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:system-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Probar el sistema de configuración';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 PROBANDO SISTEMA DE CONFIGURACIÓN');
        $this->line('=====================================');
        
        // 1. Verificar datos básicos
        $this->testBasicData();
        
        // 2. Probar funcionalidades del modelo
        $this->testModelFeatures();
        
        // 3. Probar controlador
        $this->testController();
        
        // 4. Mostrar configuraciones por grupo
        $this->showConfigurationsByGroup();
        
        // 5. Mostrar rutas API
        $this->showApiRoutes();
    }

    private function testBasicData()
    {
        $this->info('📊 VERIFICANDO DATOS BÁSICOS');
        $this->line('----------------------------');
        
        $totalSettings = SystemSetting::count();
        $publicSettings = SystemSetting::public()->count();
        $requiredSettings = SystemSetting::where('is_required', true)->count();
        $groups = SystemSetting::distinct()->pluck('group')->count();
        
        $this->line("   ✅ Total de configuraciones: {$totalSettings}");
        $this->line("   ✅ Configuraciones públicas: {$publicSettings}");
        $this->line("   ✅ Configuraciones requeridas: {$requiredSettings}");
        $this->line("   ✅ Grupos de configuración: {$groups}");
        
        $this->newLine();
    }

    private function testModelFeatures()
    {
        $this->info('🔧 PROBANDO FUNCIONALIDADES DEL MODELO');
        $this->line('-------------------------------------');
        
        // Probar obtener configuración individual
        $companyName = SystemSetting::get('company_name');
        $this->line("   ✅ Obtener configuración individual: {$companyName}");
        
        // Probar obtener grupo de configuraciones
        $companySettings = SystemSetting::getGroup('company');
        $this->line("   ✅ Configuraciones de empresa: " . $companySettings->count() . " items");
        
        // Probar configuraciones públicas
        $publicSettings = SystemSetting::getPublic();
        $this->line("   ✅ Configuraciones públicas: " . $publicSettings->count() . " items");
        
        // Probar establecer configuración
        SystemSetting::set('test_setting', 'test_value', 'string');
        $testValue = SystemSetting::get('test_setting');
        $this->line("   ✅ Establecer configuración: {$testValue}");
        
        // Limpiar configuración de prueba
        SystemSetting::where('key', 'test_setting')->delete();
        
        // Probar scopes
        $companyCount = SystemSetting::group('company')->count();
        $publicCount = SystemSetting::public()->count();
        $orderedCount = SystemSetting::ordered()->count();
        
        $this->line("   ✅ Scope group('company'): {$companyCount} items");
        $this->line("   ✅ Scope public(): {$publicCount} items");
        $this->line("   ✅ Scope ordered(): {$orderedCount} items");
        
        $this->newLine();
    }

    private function testController()
    {
        $this->info('🎮 PROBANDO CONTROLADOR');
        $this->line('----------------------');
        
        $controller = new SystemConfigController();
        
        try {
            // Probar obtener configuraciones públicas
            $publicResponse = $controller->getPublic(new Request());
            $publicSettings = json_decode($publicResponse->getContent(), true);
            
            $this->line("   ✅ Configuraciones públicas obtenidas: " . count($publicSettings) . " items");
            
            // Probar obtener configuraciones de empresa
            $companyResponse = $controller->getCompanySettings(new Request());
            $companySettings = json_decode($companyResponse->getContent(), true);
            
            $this->line("   ✅ Configuraciones de empresa: " . count($companySettings) . " items");
            
            // Probar obtener configuraciones de facturación
            $invoiceResponse = $controller->getInvoiceSettings(new Request());
            $invoiceSettings = json_decode($invoiceResponse->getContent(), true);
            
            $this->line("   ✅ Configuraciones de facturación: " . count($invoiceSettings) . " items");
            
            // Probar obtener configuraciones de email
            $emailResponse = $controller->getEmailSettings(new Request());
            $emailSettings = json_decode($emailResponse->getContent(), true);
            
            $this->line("   ✅ Configuraciones de email: " . count($emailSettings) . " items");
            
        } catch (\Exception $e) {
            $this->line("   ❌ Error en controlador: " . $e->getMessage());
        }
        
        $this->newLine();
    }

    private function showConfigurationsByGroup()
    {
        $this->info('📋 CONFIGURACIONES POR GRUPO');
        $this->line('-----------------------------');
        
        $groups = SystemSetting::select('group')
            ->distinct()
            ->orderBy('group')
            ->pluck('group');
        
        foreach ($groups as $group) {
            $settings = SystemSetting::group($group)->ordered()->get();
            
            $this->line("   📂 {$group} (" . $settings->count() . " configuraciones):");
            
            foreach ($settings as $setting) {
                $required = $setting->is_required ? ' (Requerida)' : '';
                $public = $setting->is_public ? ' (Pública)' : '';
                $this->line("      • {$setting->label}: {$setting->value}{$required}{$public}");
            }
            
            $this->line('');
        }
    }

    private function showApiRoutes()
    {
        $this->info('🔗 RUTAS API DE CONFIGURACIÓN');
        $this->line('-----------------------------');
        
        $routes = [
            'GET /api/system-config' => 'Obtener todas las configuraciones',
            'GET /api/system-config/group/{group}' => 'Obtener configuraciones de un grupo',
            'GET /api/system-config/public' => 'Obtener configuraciones públicas',
            'GET /api/system-config/{key}' => 'Obtener configuración específica',
            'POST /api/system-config' => 'Crear nueva configuración',
            'PUT /api/system-config/{key}' => 'Actualizar configuración',
            'POST /api/system-config/update-multiple' => 'Actualizar múltiples configuraciones',
            'DELETE /api/system-config/{key}' => 'Eliminar configuración',
            'POST /api/system-config/clear-cache' => 'Limpiar cache',
            'GET /api/system-config/export' => 'Exportar configuraciones',
            'POST /api/system-config/import' => 'Importar configuraciones',
            'GET /api/system-config/company' => 'Obtener configuraciones de empresa',
            'POST /api/system-config/company' => 'Actualizar configuraciones de empresa',
            'GET /api/system-config/invoice' => 'Obtener configuraciones de facturación',
            'POST /api/system-config/invoice' => 'Actualizar configuraciones de facturación',
            'GET /api/system-config/email' => 'Obtener configuraciones de email',
            'POST /api/system-config/email' => 'Actualizar configuraciones de email',
        ];
        
        foreach ($routes as $route => $description) {
            $this->line("   ✅ {$route} - {$description}");
        }
        
        $this->newLine();
    }
}



