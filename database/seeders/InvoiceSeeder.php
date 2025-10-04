<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\RepairEquipment;
use App\Models\Ticket;
use App\Models\User;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener equipos de reparación existentes
        $equipments = RepairEquipment::with(['brand', 'type', 'model'])->take(5)->get();
        $admin = User::where('email', 'admin@ticomsys.com')->first();

        if (!$admin) {
            $this->command->error('Admin user not found. Please run RolePermissionSeeder first.');
            return;
        }

        foreach ($equipments as $equipment) {
            // Crear factura
            $invoice = Invoice::create([
                'invoice_number' => Invoice::generateInvoiceNumber(),
                'repair_equipment_id' => $equipment->id,
                'ticket_id' => null, // Se puede asociar con un ticket si existe
                'customer_name' => $equipment->customer_name,
                'customer_phone' => $equipment->customer_phone,
                'customer_email' => $equipment->customer_email,
                'customer_address' => 'Dirección del cliente',
                'customer_tax_id' => 'RFC' . rand(100000000, 999999999),
                'invoice_date' => now()->subDays(rand(1, 30)),
                'due_date' => now()->addDays(rand(7, 30)),
                'status' => $this->getRandomStatus(),
                'payment_method' => $this->getRandomPaymentMethod(),
                'notes' => 'Factura generada automáticamente para pruebas',
                'tax_rate' => 16.00,
                'discount_amount' => rand(0, 100),
                'total_amount' => 0, // Se calculará después
                'created_by' => $admin->id
            ]);

            // Crear items de la factura
            $items = $this->getInvoiceItems($equipment);
            $subtotal = 0;

            foreach ($items as $itemData) {
                $item = InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'item_type' => $itemData['item_type'],
                    'item_name' => $itemData['item_name'],
                    'description' => $itemData['description'],
                    'quantity' => $itemData['quantity'],
                    'unit' => $itemData['unit'],
                    'unit_price' => $itemData['unit_price'],
                    'discount_percentage' => $itemData['discount_percentage'],
                    'tax_rate' => 16.00,
                    'discount_amount' => 0,
                    'tax_amount' => 0,
                    'total_amount' => 0
                ]);

                // Calcular total del item
                $itemSubtotal = $item->quantity * $item->unit_price;
                $discountAmount = $itemSubtotal * ($item->discount_percentage / 100);
                $taxableAmount = $itemSubtotal - $discountAmount;
                $taxAmount = $taxableAmount * ($item->tax_rate / 100);
                $totalAmount = $taxableAmount + $taxAmount;

                $item->update([
                    'discount_amount' => $discountAmount,
                    'tax_amount' => $taxAmount,
                    'total_amount' => $totalAmount
                ]);

                $subtotal += $totalAmount;
            }

            // Calcular totales de la factura
            $discountAmount = $invoice->discount_amount;
            $taxableAmount = $subtotal - $discountAmount;
            $taxAmount = $taxableAmount * ($invoice->tax_rate / 100);
            $totalAmount = $taxableAmount + $taxAmount;

            $invoice->update([
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'total_amount' => $totalAmount
            ]);

            // Si la factura está pagada, agregar fecha de pago
            if ($invoice->status === 'paid') {
                $invoice->update([
                    'paid_date' => $invoice->invoice_date->addDays(rand(1, 7)),
                    'payment_reference' => 'REF-' . rand(100000, 999999)
                ]);
            }
        }

        $this->command->info('Facturas de prueba creadas exitosamente.');
    }

    private function getRandomStatus(): string
    {
        $statuses = ['draft', 'sent', 'paid', 'overdue'];
        return $statuses[array_rand($statuses)];
    }

    private function getRandomPaymentMethod(): string
    {
        $methods = ['cash', 'card', 'transfer', 'check', 'credit'];
        return $methods[array_rand($methods)];
    }

    private function getInvoiceItems($equipment): array
    {
        $items = [];

        // Item de diagnóstico
        $items[] = [
            'item_type' => 'service',
            'item_name' => 'Diagnóstico de Equipo',
            'description' => 'Diagnóstico completo del equipo ' . $equipment->brand->name . ' ' . $equipment->model->name,
            'quantity' => 1,
            'unit' => 'hrs',
            'unit_price' => 150.00,
            'discount_percentage' => 0
        ];

        // Item de reparación
        $items[] = [
            'item_type' => 'service',
            'item_name' => 'Reparación de Hardware',
            'description' => 'Reparación de componentes internos',
            'quantity' => rand(1, 3),
            'unit' => 'hrs',
            'unit_price' => 200.00,
            'discount_percentage' => rand(0, 10)
        ];

        // Posible repuesto
        if (rand(0, 1)) {
            $parts = [
                ['name' => 'Tarjeta Madre', 'price' => 800.00],
                ['name' => 'Memoria RAM', 'price' => 300.00],
                ['name' => 'Disco Duro', 'price' => 500.00],
                ['name' => 'Fuente de Poder', 'price' => 400.00],
                ['name' => 'Pantalla LCD', 'price' => 1200.00],
                ['name' => 'Teclado', 'price' => 150.00],
                ['name' => 'Batería', 'price' => 250.00]
            ];

            $part = $parts[array_rand($parts)];
            $items[] = [
                'item_type' => 'part',
                'item_name' => $part['name'],
                'description' => 'Repuesto original para ' . $equipment->brand->name,
                'quantity' => 1,
                'unit' => 'pcs',
                'unit_price' => $part['price'],
                'discount_percentage' => rand(0, 5)
            ];
        }

        return $items;
    }
}