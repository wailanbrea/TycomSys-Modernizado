<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EquipmentBrand;
use App\Models\EquipmentType;
use App\Models\EquipmentModel;

class EquipmentDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear tipos de equipos
        $laptop = EquipmentType::create([
            'name' => 'laptop',
            'display_name' => 'Laptop',
            'description' => 'Computadora portátil'
        ]);

        $desktop = EquipmentType::create([
            'name' => 'desktop',
            'display_name' => 'Desktop',
            'description' => 'Computadora de escritorio'
        ]);

        $tablet = EquipmentType::create([
            'name' => 'tablet',
            'display_name' => 'Tablet',
            'description' => 'Tablet o dispositivo táctil'
        ]);

        $smartphone = EquipmentType::create([
            'name' => 'smartphone',
            'display_name' => 'Smartphone',
            'description' => 'Teléfono inteligente'
        ]);

        $monitor = EquipmentType::create([
            'name' => 'monitor',
            'display_name' => 'Monitor',
            'description' => 'Monitor o pantalla'
        ]);

        // Crear marcas
        $dell = EquipmentBrand::create([
            'name' => 'dell',
            'display_name' => 'Dell',
            'description' => 'Dell Technologies'
        ]);

        $hp = EquipmentBrand::create([
            'name' => 'hp',
            'display_name' => 'HP',
            'description' => 'Hewlett Packard'
        ]);

        $lenovo = EquipmentBrand::create([
            'name' => 'lenovo',
            'display_name' => 'Lenovo',
            'description' => 'Lenovo Group Limited'
        ]);

        $asus = EquipmentBrand::create([
            'name' => 'asus',
            'display_name' => 'ASUS',
            'description' => 'ASUSTeK Computer Inc.'
        ]);

        $apple = EquipmentBrand::create([
            'name' => 'apple',
            'display_name' => 'Apple',
            'description' => 'Apple Inc.'
        ]);

        $acer = EquipmentBrand::create([
            'name' => 'acer',
            'display_name' => 'Acer',
            'description' => 'Acer Inc.'
        ]);

        $msi = EquipmentBrand::create([
            'name' => 'msi',
            'display_name' => 'MSI',
            'description' => 'Micro-Star International'
        ]);

        $intel = EquipmentBrand::create([
            'name' => 'intel',
            'display_name' => 'Intel',
            'description' => 'Intel Corporation'
        ]);

        $samsung = EquipmentBrand::create([
            'name' => 'samsung',
            'display_name' => 'Samsung',
            'description' => 'Samsung Electronics'
        ]);

        $lg = EquipmentBrand::create([
            'name' => 'lg',
            'display_name' => 'LG',
            'description' => 'LG Electronics'
        ]);

        // Crear modelos para Dell
        EquipmentModel::create([
            'brand_id' => $dell->id,
            'type_id' => $laptop->id,
            'name' => 'Inspiron 15 3000',
            'display_name' => 'Inspiron 15 3000',
            'description' => 'Laptop Dell Inspiron 15 3000'
        ]);

        EquipmentModel::create([
            'brand_id' => $dell->id,
            'type_id' => $laptop->id,
            'name' => 'XPS 13',
            'display_name' => 'XPS 13',
            'description' => 'Laptop Dell XPS 13'
        ]);

        EquipmentModel::create([
            'brand_id' => $dell->id,
            'type_id' => $desktop->id,
            'name' => 'OptiPlex 7090',
            'display_name' => 'OptiPlex 7090',
            'description' => 'Desktop Dell OptiPlex 7090'
        ]);

        // Crear modelos para HP
        EquipmentModel::create([
            'brand_id' => $hp->id,
            'type_id' => $desktop->id,
            'name' => 'Pavilion Desktop TP01',
            'display_name' => 'Pavilion Desktop TP01',
            'description' => 'Desktop HP Pavilion TP01'
        ]);

        EquipmentModel::create([
            'brand_id' => $hp->id,
            'type_id' => $laptop->id,
            'name' => 'Pavilion 15',
            'display_name' => 'Pavilion 15',
            'description' => 'Laptop HP Pavilion 15'
        ]);

        EquipmentModel::create([
            'brand_id' => $hp->id,
            'type_id' => $laptop->id,
            'name' => 'EliteBook 840',
            'display_name' => 'EliteBook 840',
            'description' => 'Laptop HP EliteBook 840'
        ]);

        // Crear modelos para Lenovo
        EquipmentModel::create([
            'brand_id' => $lenovo->id,
            'type_id' => $laptop->id,
            'name' => 'ThinkPad E15',
            'display_name' => 'ThinkPad E15',
            'description' => 'Laptop Lenovo ThinkPad E15'
        ]);

        EquipmentModel::create([
            'brand_id' => $lenovo->id,
            'type_id' => $laptop->id,
            'name' => 'IdeaPad 3',
            'display_name' => 'IdeaPad 3',
            'description' => 'Laptop Lenovo IdeaPad 3'
        ]);

        EquipmentModel::create([
            'brand_id' => $lenovo->id,
            'type_id' => $desktop->id,
            'name' => 'ThinkCentre M720',
            'display_name' => 'ThinkCentre M720',
            'description' => 'Desktop Lenovo ThinkCentre M720'
        ]);

        // Crear modelos para ASUS
        EquipmentModel::create([
            'brand_id' => $asus->id,
            'type_id' => $laptop->id,
            'name' => 'VivoBook S15',
            'display_name' => 'VivoBook S15',
            'description' => 'Laptop ASUS VivoBook S15'
        ]);

        EquipmentModel::create([
            'brand_id' => $asus->id,
            'type_id' => $laptop->id,
            'name' => 'ZenBook 14',
            'display_name' => 'ZenBook 14',
            'description' => 'Laptop ASUS ZenBook 14'
        ]);

        EquipmentModel::create([
            'brand_id' => $asus->id,
            'type_id' => $desktop->id,
            'name' => 'ROG Strix G15',
            'display_name' => 'ROG Strix G15',
            'description' => 'Desktop ASUS ROG Strix G15'
        ]);

        // Crear modelos para Apple
        EquipmentModel::create([
            'brand_id' => $apple->id,
            'type_id' => $laptop->id,
            'name' => 'MacBook Air M1',
            'display_name' => 'MacBook Air M1',
            'description' => 'Laptop Apple MacBook Air M1'
        ]);

        EquipmentModel::create([
            'brand_id' => $apple->id,
            'type_id' => $laptop->id,
            'name' => 'MacBook Pro 13',
            'display_name' => 'MacBook Pro 13',
            'description' => 'Laptop Apple MacBook Pro 13'
        ]);

        EquipmentModel::create([
            'brand_id' => $apple->id,
            'type_id' => $desktop->id,
            'name' => 'iMac 24',
            'display_name' => 'iMac 24',
            'description' => 'Desktop Apple iMac 24'
        ]);

        // Crear modelos para Acer
        EquipmentModel::create([
            'brand_id' => $acer->id,
            'type_id' => $desktop->id,
            'name' => 'Aspire TC-895',
            'display_name' => 'Aspire TC-895',
            'description' => 'Desktop Acer Aspire TC-895'
        ]);

        EquipmentModel::create([
            'brand_id' => $acer->id,
            'type_id' => $laptop->id,
            'name' => 'Aspire 5',
            'display_name' => 'Aspire 5',
            'description' => 'Laptop Acer Aspire 5'
        ]);

        EquipmentModel::create([
            'brand_id' => $acer->id,
            'type_id' => $laptop->id,
            'name' => 'Nitro 5',
            'display_name' => 'Nitro 5',
            'description' => 'Laptop Acer Nitro 5'
        ]);

        // Crear modelos para MSI
        EquipmentModel::create([
            'brand_id' => $msi->id,
            'type_id' => $laptop->id,
            'name' => 'Gaming GF63',
            'display_name' => 'Gaming GF63',
            'description' => 'Laptop MSI Gaming GF63'
        ]);

        EquipmentModel::create([
            'brand_id' => $msi->id,
            'type_id' => $laptop->id,
            'name' => 'Stealth 15M',
            'display_name' => 'Stealth 15M',
            'description' => 'Laptop MSI Stealth 15M'
        ]);

        EquipmentModel::create([
            'brand_id' => $msi->id,
            'type_id' => $desktop->id,
            'name' => 'Trident 3',
            'display_name' => 'Trident 3',
            'description' => 'Desktop MSI Trident 3'
        ]);

        // Crear modelos para Intel NUC
        EquipmentModel::create([
            'brand_id' => $intel->id,
            'type_id' => $desktop->id,
            'name' => 'NUC8i5BEH',
            'display_name' => 'NUC8i5BEH',
            'description' => 'Desktop Intel NUC8i5BEH'
        ]);

        EquipmentModel::create([
            'brand_id' => $intel->id,
            'type_id' => $desktop->id,
            'name' => 'NUC11PAHi5',
            'display_name' => 'NUC11PAHi5',
            'description' => 'Desktop Intel NUC11PAHi5'
        ]);

        // Crear modelos para Samsung
        EquipmentModel::create([
            'brand_id' => $samsung->id,
            'type_id' => $monitor->id,
            'name' => '24" F24T450FQU',
            'display_name' => '24" F24T450FQU',
            'description' => 'Monitor Samsung 24 pulgadas'
        ]);

        EquipmentModel::create([
            'brand_id' => $samsung->id,
            'type_id' => $monitor->id,
            'name' => '27" F27T450FQU',
            'display_name' => '27" F27T450FQU',
            'description' => 'Monitor Samsung 27 pulgadas'
        ]);

        EquipmentModel::create([
            'brand_id' => $samsung->id,
            'type_id' => $smartphone->id,
            'name' => 'Galaxy S21',
            'display_name' => 'Galaxy S21',
            'description' => 'Smartphone Samsung Galaxy S21'
        ]);

        // Crear modelos para LG
        EquipmentModel::create([
            'brand_id' => $lg->id,
            'type_id' => $monitor->id,
            'name' => '22" 22MK430H',
            'display_name' => '22" 22MK430H',
            'description' => 'Monitor LG 22 pulgadas'
        ]);

        EquipmentModel::create([
            'brand_id' => $lg->id,
            'type_id' => $monitor->id,
            'name' => '27" 27UL500-W',
            'display_name' => '27" 27UL500-W',
            'description' => 'Monitor LG 27 pulgadas 4K'
        ]);

        $this->command->info('Datos de equipos creados exitosamente:');
        $this->command->info('- ' . EquipmentType::count() . ' tipos de equipos');
        $this->command->info('- ' . EquipmentBrand::count() . ' marcas');
        $this->command->info('- ' . EquipmentModel::count() . ' modelos');
    }
}