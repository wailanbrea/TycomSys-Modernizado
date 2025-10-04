<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InventoryItem;
use App\Models\InventoryMovement;
use App\Models\User;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener un usuario para asignar como creador de movimientos
        $adminUser = User::where('email', 'admin@ticomsys.com')->first();
        if (!$adminUser) {
            $this->command->error('No se encontró el usuario admin@ticomsys.com. Ejecuta RolePermissionSeeder primero.');
            return;
        }

        // Limpiar datos existentes
        InventoryMovement::query()->delete();
        InventoryItem::query()->delete();

        $inventoryItems = [
            [
                'name' => 'Disco Duro SSD 500GB',
                'description' => 'Disco duro sólido de 500GB para laptops',
                'category' => 'part',
                'brand' => 'Samsung',
                'model' => '870 EVO',
                'compatible_equipment' => 'Laptops Dell, HP, Lenovo',
                'current_stock' => 15,
                'minimum_stock' => 5,
                'maximum_stock' => 50,
                'unit' => 'pcs',
                'cost_price' => 800.00,
                'selling_price' => 1200.00,
                'supplier_name' => 'Distribuidora de Componentes S.A.',
                'supplier_contact' => 'Juan Pérez',
                'supplier_phone' => '555-0101',
                'supplier_email' => 'ventas@distribuidora.com',
                'location_aisle' => 'A',
                'location_shelf' => '1',
                'location_position' => 'A1-01',
                'notes' => 'Repuesto más vendido para laptops',
            ],
            [
                'name' => 'Memoria RAM 8GB DDR4',
                'description' => 'Memoria RAM DDR4 de 8GB para laptops',
                'category' => 'part',
                'brand' => 'Kingston',
                'model' => 'FURY Impact',
                'compatible_equipment' => 'Laptops Dell, HP, Lenovo, Asus',
                'current_stock' => 25,
                'minimum_stock' => 10,
                'maximum_stock' => 100,
                'unit' => 'pcs',
                'cost_price' => 600.00,
                'selling_price' => 900.00,
                'supplier_name' => 'Memorias del Norte',
                'supplier_contact' => 'María González',
                'supplier_phone' => '555-0102',
                'supplier_email' => 'pedidos@memorias.com',
                'location_aisle' => 'A',
                'location_shelf' => '2',
                'location_position' => 'A2-01',
                'notes' => 'Compatible con la mayoría de laptops modernas',
            ],
            [
                'name' => 'Batería para Laptop Dell',
                'description' => 'Batería de 6 celdas para laptops Dell Inspiron',
                'category' => 'part',
                'brand' => 'Dell',
                'model' => 'Inspiron 15 3000',
                'compatible_equipment' => 'Dell Inspiron 15 3000, 5000',
                'current_stock' => 8,
                'minimum_stock' => 3,
                'maximum_stock' => 20,
                'unit' => 'pcs',
                'cost_price' => 750.00,
                'selling_price' => 1100.00,
                'supplier_name' => 'Repuestos Dell Oficial',
                'supplier_contact' => 'Carlos Ruiz',
                'supplier_phone' => '555-0103',
                'supplier_email' => 'repuestos@dell.com',
                'location_aisle' => 'B',
                'location_shelf' => '1',
                'location_position' => 'B1-01',
                'notes' => 'Batería original Dell',
            ],
            [
                'name' => 'Pantalla LCD 15.6"',
                'description' => 'Pantalla LCD de 15.6 pulgadas para laptops',
                'category' => 'part',
                'brand' => 'LG',
                'model' => 'LP156WF6',
                'compatible_equipment' => 'Laptops HP, Dell, Lenovo 15.6"',
                'current_stock' => 5,
                'minimum_stock' => 2,
                'maximum_stock' => 15,
                'unit' => 'pcs',
                'cost_price' => 1200.00,
                'selling_price' => 1800.00,
                'supplier_name' => 'Pantallas Premium',
                'supplier_contact' => 'Ana López',
                'supplier_phone' => '555-0104',
                'supplier_email' => 'ventas@pantallas.com',
                'location_aisle' => 'B',
                'location_shelf' => '2',
                'location_position' => 'B2-01',
                'notes' => 'Pantalla de alta calidad',
            ],
            [
                'name' => 'Teclado Español para Laptop',
                'description' => 'Teclado en español para laptops',
                'category' => 'part',
                'brand' => 'Generic',
                'model' => 'USB-ES',
                'compatible_equipment' => 'Laptops con puerto USB',
                'current_stock' => 12,
                'minimum_stock' => 5,
                'maximum_stock' => 30,
                'unit' => 'pcs',
                'cost_price' => 350.00,
                'selling_price' => 500.00,
                'supplier_name' => 'Accesorios Computación',
                'supplier_contact' => 'Roberto Silva',
                'supplier_phone' => '555-0105',
                'supplier_email' => 'pedidos@accesorios.com',
                'location_aisle' => 'C',
                'location_shelf' => '1',
                'location_position' => 'C1-01',
                'notes' => 'Teclado con distribución española',
            ],
            [
                'name' => 'Procesador Intel i5',
                'description' => 'Procesador Intel Core i5 de 10ma generación',
                'category' => 'component',
                'brand' => 'Intel',
                'model' => 'i5-10400F',
                'compatible_equipment' => 'PCs de escritorio con socket LGA1200',
                'current_stock' => 6,
                'minimum_stock' => 2,
                'maximum_stock' => 15,
                'unit' => 'pcs',
                'cost_price' => 2500.00,
                'selling_price' => 3500.00,
                'supplier_name' => 'Intel Distribuidor Oficial',
                'supplier_contact' => 'Luis Martínez',
                'supplier_phone' => '555-0106',
                'supplier_email' => 'ventas@intel.com',
                'location_aisle' => 'D',
                'location_shelf' => '1',
                'location_position' => 'D1-01',
                'notes' => 'Procesador de alto rendimiento',
            ],
            [
                'name' => 'Destornillador Set',
                'description' => 'Set de destornilladores para electrónicos',
                'category' => 'tool',
                'brand' => 'iFixit',
                'model' => 'Pro Tech Toolkit',
                'compatible_equipment' => 'Reparación de laptops y PCs',
                'current_stock' => 3,
                'minimum_stock' => 1,
                'maximum_stock' => 5,
                'unit' => 'sets',
                'cost_price' => 1200.00,
                'selling_price' => 1800.00,
                'supplier_name' => 'Herramientas Profesionales',
                'supplier_contact' => 'Miguel Torres',
                'supplier_phone' => '555-0108',
                'supplier_email' => 'ventas@herramientas.com',
                'location_aisle' => 'E',
                'location_shelf' => '1',
                'location_position' => 'E1-01',
                'notes' => 'Set profesional de herramientas',
            ],
            [
                'name' => 'Pasta Térmica',
                'description' => 'Pasta térmica para procesadores',
                'category' => 'consumable',
                'brand' => 'Arctic',
                'model' => 'MX-4',
                'compatible_equipment' => 'Procesadores Intel y AMD',
                'current_stock' => 20,
                'minimum_stock' => 10,
                'maximum_stock' => 50,
                'unit' => 'tubes',
                'cost_price' => 150.00,
                'selling_price' => 250.00,
                'supplier_name' => 'Consumibles Técnicos',
                'supplier_contact' => 'Fernando Castro',
                'supplier_phone' => '555-0110',
                'supplier_email' => 'pedidos@consumibles.com',
                'location_aisle' => 'F',
                'location_shelf' => '1',
                'location_position' => 'F1-01',
                'notes' => 'Pasta térmica de alta calidad',
            ],
        ];

        foreach ($inventoryItems as $itemData) {
            $item = InventoryItem::create($itemData);

            // Crear movimiento inicial de entrada
            if ($item->current_stock > 0) {
                InventoryMovement::create([
                    'inventory_item_id' => $item->id,
                    'movement_type' => 'in',
                    'quantity' => $item->current_stock,
                    'stock_before' => 0,
                    'stock_after' => $item->current_stock,
                    'reference_type' => 'initial_stock',
                    'reference_id' => $item->id,
                    'reason' => 'Stock inicial del sistema',
                    'performed_by' => $adminUser->id,
                    'movement_date' => now()->subDays(rand(1, 30)),
                    'unit_cost' => $item->cost_price,
                    'total_cost' => $item->cost_price * $item->current_stock,
                ]);
            }

            // Simular algunos movimientos de salida para algunos items
            if (rand(0, 1) && $item->current_stock > 2) {
                $outQuantity = rand(1, min(3, $item->current_stock - 1));
                $item->updateStock(
                    $outQuantity,
                    'out',
                    'Uso en reparación',
                    'repair_equipment',
                    rand(1, 8), // ID de equipo de reparación aleatorio
                    $adminUser->id
                );
            }
        }

        $this->command->info('Inventario de prueba creado exitosamente con ' . count($inventoryItems) . ' items.');
    }
}