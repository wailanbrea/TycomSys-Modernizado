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
        $laptop = EquipmentType::firstOrCreate([
            'name' => 'laptop'
        ], [
            'display_name' => 'Laptop',
            'description' => 'Computadora portátil'
        ]);

        $desktop = EquipmentType::firstOrCreate([
            'name' => 'desktop'
        ], [
            'display_name' => 'Desktop',
            'description' => 'Computadora de escritorio'
        ]);

        $tablet = EquipmentType::firstOrCreate([
            'name' => 'tablet'
        ], [
            'display_name' => 'Tablet',
            'description' => 'Tablet o dispositivo táctil'
        ]);

        $smartphone = EquipmentType::firstOrCreate([
            'name' => 'smartphone'
        ], [
            'display_name' => 'Smartphone',
            'description' => 'Teléfono inteligente'
        ]);

        $monitor = EquipmentType::firstOrCreate([
            'name' => 'monitor'
        ], [
            'display_name' => 'Monitor',
            'description' => 'Monitor o pantalla'
        ]);

        // Crear marcas
        $dell = EquipmentBrand::firstOrCreate([
            'name' => 'dell'
        ], [
            'display_name' => 'Dell',
            'description' => 'Dell Technologies'
        ]);

        $hp = EquipmentBrand::firstOrCreate([
            'name' => 'hp'
        ], [
            'display_name' => 'HP',
            'description' => 'Hewlett Packard'
        ]);

        $lenovo = EquipmentBrand::firstOrCreate([
            'name' => 'lenovo'
        ], [
            'display_name' => 'Lenovo',
            'description' => 'Lenovo Group Limited'
        ]);

        $asus = EquipmentBrand::firstOrCreate([
            'name' => 'asus'
        ], [
            'display_name' => 'ASUS',
            'description' => 'ASUSTeK Computer Inc.'
        ]);

        $apple = EquipmentBrand::firstOrCreate([
            'name' => 'apple'
        ], [
            'display_name' => 'Apple',
            'description' => 'Apple Inc.'
        ]);

        $acer = EquipmentBrand::firstOrCreate([
            'name' => 'acer'
        ], [
            'display_name' => 'Acer',
            'description' => 'Acer Inc.'
        ]);

        $msi = EquipmentBrand::firstOrCreate([
            'name' => 'msi'
        ], [
            'display_name' => 'MSI',
            'description' => 'Micro-Star International'
        ]);

        $intel = EquipmentBrand::firstOrCreate([
            'name' => 'intel'
        ], [
            'display_name' => 'Intel',
            'description' => 'Intel Corporation'
        ]);

        $samsung = EquipmentBrand::firstOrCreate([
            'name' => 'samsung'
        ], [
            'display_name' => 'Samsung',
            'description' => 'Samsung Electronics'
        ]);

        $canon = EquipmentBrand::firstOrCreate([
            'name' => 'canon'
        ], [
            'display_name' => 'Canon',
            'description' => 'Canon Inc.'
        ]);

        // Crear modelos
        $dellInspiron = EquipmentModel::firstOrCreate([
            'name' => 'Inspiron 15 3000'
        ], [
            'brand_id' => $dell->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop Dell Inspiron 15 3000'
        ]);

        $dellXPS = EquipmentModel::firstOrCreate([
            'name' => 'XPS 13'
        ], [
            'brand_id' => $dell->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop Dell XPS 13'
        ]);

        $hpPavilion = EquipmentModel::firstOrCreate([
            'name' => 'Pavilion Desktop TP01'
        ], [
            'brand_id' => $hp->id,
            'type_id' => $desktop->id,
            'description' => 'Desktop HP Pavilion TP01'
        ]);

        $hpEliteBook = EquipmentModel::firstOrCreate([
            'name' => 'EliteBook 840'
        ], [
            'brand_id' => $hp->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop HP EliteBook 840'
        ]);

        $lenovoThinkPad = EquipmentModel::firstOrCreate([
            'name' => 'ThinkPad E15'
        ], [
            'brand_id' => $lenovo->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop Lenovo ThinkPad E15'
        ]);

        $lenovoIdeaPad = EquipmentModel::firstOrCreate([
            'name' => 'IdeaPad 3'
        ], [
            'brand_id' => $lenovo->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop Lenovo IdeaPad 3'
        ]);

        $asusZenbook = EquipmentModel::firstOrCreate([
            'name' => 'ZenBook 14'
        ], [
            'brand_id' => $asus->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop ASUS ZenBook 14'
        ]);

        $asusROG = EquipmentModel::firstOrCreate([
            'name' => 'ROG Strix G15'
        ], [
            'brand_id' => $asus->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop Gaming ASUS ROG Strix G15'
        ]);

        $appleMacBook = EquipmentModel::firstOrCreate([
            'name' => 'MacBook Air M2'
        ], [
            'brand_id' => $apple->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop Apple MacBook Air M2'
        ]);

        $appleMacBookPro = EquipmentModel::firstOrCreate([
            'name' => 'MacBook Pro 14"'
        ], [
            'brand_id' => $apple->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop Apple MacBook Pro 14"'
        ]);

        $acerAspire = EquipmentModel::firstOrCreate([
            'name' => 'Aspire 5'
        ], [
            'brand_id' => $acer->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop Acer Aspire 5'
        ]);

        $acerNitro = EquipmentModel::firstOrCreate([
            'name' => 'Nitro 5'
        ], [
            'brand_id' => $acer->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop Gaming Acer Nitro 5'
        ]);

        $msiGF63 = EquipmentModel::firstOrCreate([
            'name' => 'GF63 Thin'
        ], [
            'brand_id' => $msi->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop Gaming MSI GF63 Thin'
        ]);

        $msiCreator = EquipmentModel::firstOrCreate([
            'name' => 'Creator 15'
        ], [
            'brand_id' => $msi->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop MSI Creator 15'
        ]);

        $intelNUC = EquipmentModel::firstOrCreate([
            'name' => 'NUC 11'
        ], [
            'brand_id' => $intel->id,
            'type_id' => $desktop->id,
            'description' => 'Mini PC Intel NUC 11'
        ]);

        $samsungGalaxy = EquipmentModel::firstOrCreate([
            'name' => 'Galaxy Tab S8'
        ], [
            'brand_id' => $samsung->id,
            'type_id' => $tablet->id,
            'description' => 'Tablet Samsung Galaxy Tab S8'
        ]);

        $samsungMonitor = EquipmentModel::firstOrCreate([
            'name' => 'Monitor 24" 4K'
        ], [
            'brand_id' => $samsung->id,
            'type_id' => $monitor->id,
            'description' => 'Monitor Samsung 24" 4K'
        ]);

        $canonPixma = EquipmentModel::firstOrCreate([
            'name' => 'PIXMA G3110'
        ], [
            'brand_id' => $canon->id,
            'type_id' => $monitor->id, // Usando monitor como tipo para impresoras
            'description' => 'Impresora Canon PIXMA G3110'
        ]);

        $canonLaser = EquipmentModel::firstOrCreate([
            'name' => 'Laser 3000'
        ], [
            'brand_id' => $canon->id,
            'type_id' => $monitor->id, // Usando monitor como tipo para impresoras
            'description' => 'Impresora Laser Canon 3000'
        ]);

        // Modelos adicionales para más variedad
        $dellOptiPlex = EquipmentModel::firstOrCreate([
            'name' => 'OptiPlex 7090'
        ], [
            'brand_id' => $dell->id,
            'type_id' => $desktop->id,
            'description' => 'Desktop Dell OptiPlex 7090'
        ]);

        $hpProBook = EquipmentModel::firstOrCreate([
            'name' => 'ProBook 450'
        ], [
            'brand_id' => $hp->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop HP ProBook 450'
        ]);

        $lenovoYoga = EquipmentModel::firstOrCreate([
            'name' => 'Yoga 7i'
        ], [
            'brand_id' => $lenovo->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop Convertible Lenovo Yoga 7i'
        ]);

        $asusVivoBook = EquipmentModel::firstOrCreate([
            'name' => 'VivoBook S15'
        ], [
            'brand_id' => $asus->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop ASUS VivoBook S15'
        ]);

        $appleIMac = EquipmentModel::firstOrCreate([
            'name' => 'iMac 24"'
        ], [
            'brand_id' => $apple->id,
            'type_id' => $desktop->id,
            'description' => 'Desktop Apple iMac 24"'
        ]);

        $acerSwift = EquipmentModel::firstOrCreate([
            'name' => 'Swift 3'
        ], [
            'brand_id' => $acer->id,
            'type_id' => $laptop->id,
            'description' => 'Laptop Acer Swift 3'
        ]);

        echo "Datos de equipos creados exitosamente:\n";
        echo "- 5 tipos de equipos\n";
        echo "- 10 marcas\n";
        echo "- " . EquipmentModel::count() . " modelos\n";
    }
}