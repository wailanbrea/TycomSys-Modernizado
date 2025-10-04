<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SystemConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin'); // Solo administradores pueden configurar
    }

    /**
     * Obtener todas las configuraciones agrupadas
     */
    public function index()
    {
        $settings = SystemSetting::ordered()->get()->groupBy('group');
        
        return response()->json($settings);
    }

    /**
     * Obtener configuraciones de un grupo específico
     */
    public function getGroup($group)
    {
        $settings = SystemSetting::getGroup($group);
        
        return response()->json($settings);
    }

    /**
     * Obtener configuraciones públicas
     */
    public function getPublic()
    {
        $settings = SystemSetting::getPublic();
        
        return response()->json($settings);
    }

    /**
     * Obtener una configuración específica
     */
    public function show($key)
    {
        $setting = SystemSetting::where('key', $key)->first();
        
        if (!$setting) {
            return response()->json(['message' => 'Configuración no encontrada'], 404);
        }
        
        return response()->json($setting);
    }

    /**
     * Crear una nueva configuración
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:system_settings',
            'value' => 'nullable',
            'type' => 'required|in:string,integer,float,boolean,json,text,array',
            'group' => 'required|string|max:100',
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'is_required' => 'boolean',
            'validation_rules' => 'nullable|string',
            'options' => 'nullable|string',
            'sort_order' => 'integer|min:0',
        ]);

        $setting = SystemSetting::create($request->all());
        
        // Limpiar cache
        SystemSetting::clearCache();

        return response()->json([
            'message' => 'Configuración creada exitosamente',
            'setting' => $setting
        ], 201);
    }

    /**
     * Actualizar una configuración
     */
    public function update(Request $request, $key)
    {
        $setting = SystemSetting::where('key', $key)->first();
        
        if (!$setting) {
            return response()->json(['message' => 'Configuración no encontrada'], 404);
        }

        $request->validate([
            'value' => 'nullable',
            'type' => 'in:string,integer,float,boolean,json,text,array',
            'group' => 'string|max:100',
            'label' => 'string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'is_required' => 'boolean',
            'validation_rules' => 'nullable|string',
            'options' => 'nullable|string',
            'sort_order' => 'integer|min:0',
        ]);

        $setting->update($request->all());
        
        // Limpiar cache
        SystemSetting::clearCache();

        return response()->json([
            'message' => 'Configuración actualizada exitosamente',
            'setting' => $setting
        ]);
    }

    /**
     * Actualizar múltiples configuraciones
     */
    public function updateMultiple(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'nullable',
        ]);

        $updated = [];
        
        foreach ($request->settings as $settingData) {
            $setting = SystemSetting::where('key', $settingData['key'])->first();
            
            if ($setting) {
                $setting->update(['value' => $settingData['value']]);
                $updated[] = $setting->key;
            }
        }
        
        // Limpiar cache
        SystemSetting::clearCache();

        return response()->json([
            'message' => 'Configuraciones actualizadas exitosamente',
            'updated' => $updated
        ]);
    }

    /**
     * Eliminar una configuración
     */
    public function destroy($key)
    {
        $setting = SystemSetting::where('key', $key)->first();
        
        if (!$setting) {
            return response()->json(['message' => 'Configuración no encontrada'], 404);
        }

        if ($setting->is_required) {
            return response()->json([
                'message' => 'No se puede eliminar una configuración requerida'
            ], 422);
        }

        $setting->delete();
        
        // Limpiar cache
        SystemSetting::clearCache();

        return response()->json([
            'message' => 'Configuración eliminada exitosamente'
        ]);
    }

    /**
     * Obtener configuraciones de la empresa
     */
    public function getCompanySettings()
    {
        $settings = SystemSetting::getGroup('company');
        
        return response()->json($settings);
    }

    /**
     * Actualizar configuraciones de la empresa
     */
    public function updateCompanySettings(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_address' => 'nullable|string',
            'company_phone' => 'nullable|string|max:20',
            'company_email' => 'nullable|email|max:255',
            'company_website' => 'nullable|url|max:255',
            'company_tax_id' => 'nullable|string|max:50',
            'company_logo' => 'nullable|string|max:255',
        ]);

        $settings = [
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_phone' => $request->company_phone,
            'company_email' => $request->company_email,
            'company_website' => $request->company_website,
            'company_tax_id' => $request->company_tax_id,
            'company_logo' => $request->company_logo,
        ];

        foreach ($settings as $key => $value) {
            SystemSetting::set($key, $value, 'string');
        }

        return response()->json([
            'message' => 'Configuraciones de empresa actualizadas exitosamente'
        ]);
    }

    /**
     * Obtener configuraciones de facturación
     */
    public function getInvoiceSettings()
    {
        $settings = SystemSetting::getGroup('invoice');
        
        return response()->json($settings);
    }

    /**
     * Actualizar configuraciones de facturación
     */
    public function updateInvoiceSettings(Request $request)
    {
        $request->validate([
            'invoice_prefix' => 'required|string|max:10',
            'invoice_number_format' => 'required|string|max:50',
            'default_tax_rate' => 'required|numeric|min:0|max:100',
            'currency' => 'required|string|max:3',
            'currency_symbol' => 'required|string|max:5',
            'payment_terms' => 'nullable|string|max:255',
            'invoice_footer' => 'nullable|string',
        ]);

        $settings = [
            'invoice_prefix' => $request->invoice_prefix,
            'invoice_number_format' => $request->invoice_number_format,
            'default_tax_rate' => $request->default_tax_rate,
            'currency' => $request->currency,
            'currency_symbol' => $request->currency_symbol,
            'payment_terms' => $request->payment_terms,
            'invoice_footer' => $request->invoice_footer,
        ];

        foreach ($settings as $key => $value) {
            SystemSetting::set($key, $value, is_numeric($value) ? 'float' : 'string');
        }

        return response()->json([
            'message' => 'Configuraciones de facturación actualizadas exitosamente'
        ]);
    }

    /**
     * Obtener configuraciones de email
     */
    public function getEmailSettings()
    {
        $settings = SystemSetting::getGroup('email');
        
        return response()->json($settings);
    }

    /**
     * Actualizar configuraciones de email
     */
    public function updateEmailSettings(Request $request)
    {
        $request->validate([
            'mail_driver' => 'required|string|max:50',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|integer|min:1|max:65535',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|max:20',
            'mail_from_address' => 'required|email|max:255',
            'mail_from_name' => 'required|string|max:255',
        ]);

        $settings = [
            'mail_driver' => $request->mail_driver,
            'mail_host' => $request->mail_host,
            'mail_port' => $request->mail_port,
            'mail_username' => $request->mail_username,
            'mail_password' => $request->mail_password,
            'mail_encryption' => $request->mail_encryption,
            'mail_from_address' => $request->mail_from_address,
            'mail_from_name' => $request->mail_from_name,
        ];

        foreach ($settings as $key => $value) {
            SystemSetting::set($key, $value, is_numeric($value) ? 'integer' : 'string');
        }

        return response()->json([
            'message' => 'Configuraciones de email actualizadas exitosamente'
        ]);
    }

    /**
     * Limpiar cache de configuraciones
     */
    public function clearCache()
    {
        SystemSetting::clearCache();
        
        return response()->json([
            'message' => 'Cache de configuraciones limpiado exitosamente'
        ]);
    }

    /**
     * Exportar configuraciones
     */
    public function export()
    {
        $settings = SystemSetting::all()->map(function ($setting) {
            return [
                'key' => $setting->key,
                'value' => $setting->value,
                'type' => $setting->type,
                'group' => $setting->group,
                'label' => $setting->label,
                'description' => $setting->description,
                'is_public' => $setting->is_public,
                'is_required' => $setting->is_required,
            ];
        });

        return response()->json($settings);
    }

    /**
     * Importar configuraciones
     */
    public function import(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'nullable',
            'settings.*.type' => 'required|string',
            'settings.*.group' => 'required|string',
            'settings.*.label' => 'required|string',
        ]);

        $imported = 0;
        
        foreach ($request->settings as $settingData) {
            $setting = SystemSetting::updateOrCreate(
                ['key' => $settingData['key']],
                $settingData
            );
            $imported++;
        }
        
        // Limpiar cache
        SystemSetting::clearCache();

        return response()->json([
            'message' => "Se importaron {$imported} configuraciones exitosamente"
        ]);
    }
}