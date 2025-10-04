<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemSetting;

class SystemSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar configuraciones existentes
        SystemSetting::query()->delete();

        $settings = [
            // Configuraciones de la empresa
            [
                'key' => 'company_name',
                'value' => 'TicomSys - Servicios de Reparación',
                'type' => 'string',
                'group' => 'company',
                'label' => 'Nombre de la Empresa',
                'description' => 'Nombre oficial de la empresa',
                'is_public' => true,
                'is_required' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'company_address',
                'value' => 'Av. Principal 123, Ciudad, Estado, CP 12345',
                'type' => 'text',
                'group' => 'company',
                'label' => 'Dirección de la Empresa',
                'description' => 'Dirección completa de la empresa',
                'is_public' => true,
                'is_required' => false,
                'sort_order' => 2,
            ],
            [
                'key' => 'company_phone',
                'value' => '+52 55 1234 5678',
                'type' => 'string',
                'group' => 'company',
                'label' => 'Teléfono de la Empresa',
                'description' => 'Número de teléfono principal',
                'is_public' => true,
                'is_required' => false,
                'sort_order' => 3,
            ],
            [
                'key' => 'company_email',
                'value' => 'contacto@ticomsys.com',
                'type' => 'string',
                'group' => 'company',
                'label' => 'Email de la Empresa',
                'description' => 'Correo electrónico de contacto',
                'is_public' => true,
                'is_required' => false,
                'sort_order' => 4,
            ],
            [
                'key' => 'company_website',
                'value' => 'https://www.ticomsys.com',
                'type' => 'string',
                'group' => 'company',
                'label' => 'Sitio Web',
                'description' => 'URL del sitio web de la empresa',
                'is_public' => true,
                'is_required' => false,
                'sort_order' => 5,
            ],
            [
                'key' => 'company_tax_id',
                'value' => 'RFC123456789',
                'type' => 'string',
                'group' => 'company',
                'label' => 'RFC/NIT',
                'description' => 'Identificación fiscal de la empresa',
                'is_public' => false,
                'is_required' => false,
                'sort_order' => 6,
            ],
            [
                'key' => 'company_logo',
                'value' => '/images/logoticomsys.png',
                'type' => 'string',
                'group' => 'company',
                'label' => 'Logo de la Empresa',
                'description' => 'Ruta del logo de la empresa',
                'is_public' => true,
                'is_required' => false,
                'sort_order' => 7,
            ],

            // Configuraciones de facturación
            [
                'key' => 'invoice_prefix',
                'value' => 'FAC',
                'type' => 'string',
                'group' => 'invoice',
                'label' => 'Prefijo de Facturas',
                'description' => 'Prefijo para el número de facturas',
                'is_public' => false,
                'is_required' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'invoice_number_format',
                'value' => 'FAC-{YEAR}{MONTH}-{NUMBER}',
                'type' => 'string',
                'group' => 'invoice',
                'label' => 'Formato de Número de Factura',
                'description' => 'Formato para generar números de factura',
                'is_public' => false,
                'is_required' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'default_tax_rate',
                'value' => '16.00',
                'type' => 'float',
                'group' => 'invoice',
                'label' => 'Tasa de Impuesto por Defecto',
                'description' => 'Tasa de IVA por defecto (porcentaje)',
                'is_public' => false,
                'is_required' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'currency',
                'value' => 'MXN',
                'type' => 'string',
                'group' => 'invoice',
                'label' => 'Moneda',
                'description' => 'Código de moneda (ISO 4217)',
                'is_public' => true,
                'is_required' => true,
                'sort_order' => 4,
            ],
            [
                'key' => 'currency_symbol',
                'value' => '$',
                'type' => 'string',
                'group' => 'invoice',
                'label' => 'Símbolo de Moneda',
                'description' => 'Símbolo de la moneda',
                'is_public' => true,
                'is_required' => true,
                'sort_order' => 5,
            ],
            [
                'key' => 'payment_terms',
                'value' => 'Pago a 30 días',
                'type' => 'string',
                'group' => 'invoice',
                'label' => 'Términos de Pago',
                'description' => 'Términos de pago por defecto',
                'is_public' => false,
                'is_required' => false,
                'sort_order' => 6,
            ],
            [
                'key' => 'invoice_footer',
                'value' => 'Gracias por su preferencia. Para cualquier aclaración, contacte a nuestro departamento de atención al cliente.',
                'type' => 'text',
                'group' => 'invoice',
                'label' => 'Pie de Página de Facturas',
                'description' => 'Texto que aparece en el pie de página de las facturas',
                'is_public' => false,
                'is_required' => false,
                'sort_order' => 7,
            ],

            // Configuraciones del sistema
            [
                'key' => 'app_name',
                'value' => 'TicomSys',
                'type' => 'string',
                'group' => 'system',
                'label' => 'Nombre de la Aplicación',
                'description' => 'Nombre que aparece en la aplicación',
                'is_public' => true,
                'is_required' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'app_timezone',
                'value' => 'America/Mexico_City',
                'type' => 'string',
                'group' => 'system',
                'label' => 'Zona Horaria',
                'description' => 'Zona horaria del sistema',
                'is_public' => false,
                'is_required' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'app_locale',
                'value' => 'es',
                'type' => 'string',
                'group' => 'system',
                'label' => 'Idioma',
                'description' => 'Idioma del sistema',
                'is_public' => true,
                'is_required' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'items_per_page',
                'value' => '15',
                'type' => 'integer',
                'group' => 'system',
                'label' => 'Items por Página',
                'description' => 'Número de items por página en las listas',
                'is_public' => false,
                'is_required' => true,
                'sort_order' => 4,
            ],
            [
                'key' => 'enable_notifications',
                'value' => 'true',
                'type' => 'boolean',
                'group' => 'system',
                'label' => 'Habilitar Notificaciones',
                'description' => 'Habilitar sistema de notificaciones',
                'is_public' => false,
                'is_required' => true,
                'sort_order' => 5,
            ],
            [
                'key' => 'low_stock_threshold',
                'value' => '5',
                'type' => 'integer',
                'group' => 'system',
                'label' => 'Umbral de Stock Bajo',
                'description' => 'Número mínimo de items para alerta de stock bajo',
                'is_public' => false,
                'is_required' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($settings as $setting) {
            SystemSetting::create($setting);
        }

        $this->command->info('Configuraciones del sistema creadas exitosamente: ' . count($settings) . ' configuraciones.');
    }
}