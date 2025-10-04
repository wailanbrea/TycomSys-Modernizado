<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RepairEquipment;
use App\Models\EquipmentStatus;
use App\Models\User;
use App\Models\Ticket;
use App\Models\EquipmentBrand;
use App\Models\EquipmentType;
use App\Models\EquipmentModel;

class RepairEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios técnicos
        $tecnico1 = User::where('email', 'tecnico@ticomsys.com')->first();
        $admin = User::where('email', 'admin@ticomsys.com')->first();

        // Obtener marcas, tipos y modelos
        $dell = EquipmentBrand::where('name', 'dell')->first();
        $hp = EquipmentBrand::where('name', 'hp')->first();
        $lenovo = EquipmentBrand::where('name', 'lenovo')->first();
        $asus = EquipmentBrand::where('name', 'asus')->first();
        $apple = EquipmentBrand::where('name', 'apple')->first();
        $acer = EquipmentBrand::where('name', 'acer')->first();
        $msi = EquipmentBrand::where('name', 'msi')->first();
        $intel = EquipmentBrand::where('name', 'intel')->first();

        $laptop = EquipmentType::where('name', 'laptop')->first();
        $desktop = EquipmentType::where('name', 'desktop')->first();

        $dellInspiron = EquipmentModel::where('name', 'Inspiron 15 3000')->first();
        $hpPavilion = EquipmentModel::where('name', 'Pavilion Desktop TP01')->first();
        $lenovoThinkPad = EquipmentModel::where('name', 'ThinkPad E15')->first();
        $asusVivoBook = EquipmentModel::where('name', 'VivoBook S15')->first();
        $appleMacBook = EquipmentModel::where('name', 'MacBook Air M1')->first();
        $acerAspire = EquipmentModel::where('name', 'Aspire TC-895')->first();
        $msiGaming = EquipmentModel::where('name', 'Gaming GF63')->first();
        $intelNuc = EquipmentModel::where('name', 'NUC8i5BEH')->first();

        // Datos de equipos de reparación con marcas reales
        $equipments = [
            [
                'customer_name' => 'María González',
                'customer_phone' => '+52 55 1234 5678',
                'customer_email' => 'maria.gonzalez@email.com',
                'equipment_type' => 'Laptop',
                'brand' => 'Dell',
                'model' => 'Inspiron 15 3000',
                'serial_number' => 'DL123456789',
                'problem_description' => 'La laptop no enciende, se queda en pantalla negra. El LED de encendido parpadea pero no arranca el sistema.',
                'accessories' => 'Cargador original, mouse inalámbrico',
                'notes' => 'Cliente menciona que cayó de la mesa hace 2 días',
                'estimated_cost' => 2500.00,
                'estimated_delivery' => now()->addDays(5),
                'assigned_technician_id' => $tecnico1->id,
                'status' => 'in_review',
                'brand_id' => $dell->id,
                'type_id' => $laptop->id,
                'model_id' => $dellInspiron->id,
            ],
            [
                'customer_name' => 'Carlos Rodríguez',
                'customer_phone' => '+52 55 9876 5432',
                'customer_email' => 'carlos.rodriguez@empresa.com',
                'equipment_type' => 'Desktop',
                'brand' => 'HP',
                'model' => 'Pavilion Desktop TP01',
                'serial_number' => 'HP987654321',
                'problem_description' => 'La computadora se reinicia constantemente. A veces funciona por 10 minutos, luego se apaga solo.',
                'accessories' => 'Monitor Samsung 24", teclado y mouse',
                'notes' => 'Equipo de oficina, uso intensivo',
                'estimated_cost' => 1800.00,
                'estimated_delivery' => now()->addDays(3),
                'assigned_technician_id' => $tecnico1->id,
                'status' => 'in_repair',
                'brand_id' => $hp->id,
                'type_id' => $desktop->id,
                'model_id' => $hpPavilion->id,
            ],
            [
                'customer_name' => 'Ana Martínez',
                'customer_phone' => '+52 55 5555 1234',
                'customer_email' => 'ana.martinez@gmail.com',
                'equipment_type' => 'Laptop',
                'brand' => 'Lenovo',
                'model' => 'ThinkPad E15',
                'serial_number' => 'LV456789123',
                'problem_description' => 'La pantalla tiene líneas verticales y parpadea. A veces se ve normal, otras veces completamente distorsionada.',
                'accessories' => 'Cargador, mochila',
                'notes' => 'Equipo para trabajo remoto',
                'estimated_cost' => 3200.00,
                'estimated_delivery' => now()->addDays(7),
                'assigned_technician_id' => $tecnico1->id,
                'status' => 'waiting_parts',
                'brand_id' => $lenovo->id,
                'type_id' => $laptop->id,
                'model_id' => $lenovoThinkPad->id,
            ],
            [
                'customer_name' => 'Roberto Silva',
                'customer_phone' => '+52 55 7777 8888',
                'customer_email' => 'roberto.silva@hotmail.com',
                'equipment_type' => 'Laptop',
                'brand' => 'ASUS',
                'model' => 'VivoBook S15',
                'serial_number' => 'AS789123456',
                'problem_description' => 'El teclado no responde en algunas teclas (A, S, D, F, G). Las demás funcionan normalmente.',
                'accessories' => 'Cargador original',
                'notes' => 'Cliente estudia programación, necesita el equipo urgente',
                'estimated_cost' => 1200.00,
                'estimated_delivery' => now()->addDays(2),
                'assigned_technician_id' => $tecnico1->id,
                'status' => 'ready',
                'brand_id' => $asus->id,
                'type_id' => $laptop->id,
                'model_id' => $asusVivoBook->id,
            ],
            [
                'customer_name' => 'Laura Fernández',
                'customer_phone' => '+52 55 3333 4444',
                'customer_email' => 'laura.fernandez@universidad.edu.mx',
                'equipment_type' => 'Laptop',
                'brand' => 'Apple',
                'model' => 'MacBook Air M1',
                'serial_number' => 'AP123456789',
                'problem_description' => 'La batería se agota muy rápido, dura máximo 2 horas. El sistema indica que la batería necesita servicio.',
                'accessories' => 'Cargador MagSafe, funda protectora',
                'notes' => 'Equipo para tesis universitaria',
                'estimated_cost' => 4500.00,
                'estimated_delivery' => now()->addDays(10),
                'assigned_technician_id' => $tecnico1->id,
                'status' => 'delivered',
                'brand_id' => $apple->id,
                'type_id' => $laptop->id,
                'model_id' => $appleMacBook->id,
            ],
            [
                'customer_name' => 'Miguel Torres',
                'customer_phone' => '+52 55 6666 9999',
                'customer_email' => 'miguel.torres@negocio.com',
                'equipment_type' => 'Desktop',
                'brand' => 'Acer',
                'model' => 'Aspire TC-895',
                'serial_number' => 'AC456789123',
                'problem_description' => 'La computadora hace mucho ruido, especialmente al iniciar. Parece que el ventilador está fallando.',
                'accessories' => 'Monitor LG 22", teclado mecánico, mouse gaming',
                'notes' => 'Equipo para gaming, uso nocturno',
                'estimated_cost' => 800.00,
                'estimated_delivery' => now()->addDays(4),
                'assigned_technician_id' => $tecnico1->id,
                'status' => 'received',
                'brand_id' => $acer->id,
                'type_id' => $desktop->id,
                'model_id' => $acerAspire->id,
            ],
            [
                'customer_name' => 'Patricia López',
                'customer_phone' => '+52 55 1111 2222',
                'customer_email' => 'patricia.lopez@empresa.com',
                'equipment_type' => 'Laptop',
                'brand' => 'MSI',
                'model' => 'Gaming GF63',
                'serial_number' => 'MS789456123',
                'problem_description' => 'La laptop se sobrecalienta mucho al jugar. Se apaga automáticamente después de 30 minutos de gaming.',
                'accessories' => 'Cargador, mouse gaming, base refrigerante',
                'notes' => 'Equipo para gaming profesional',
                'estimated_cost' => 2800.00,
                'estimated_delivery' => now()->addDays(6),
                'assigned_technician_id' => $tecnico1->id,
                'status' => 'in_repair',
                'brand_id' => $msi->id,
                'type_id' => $laptop->id,
                'model_id' => $msiGaming->id,
            ],
            [
                'customer_name' => 'José Ramírez',
                'customer_phone' => '+52 55 4444 5555',
                'customer_email' => 'jose.ramirez@email.com',
                'equipment_type' => 'Desktop',
                'brand' => 'Intel NUC',
                'model' => 'NUC8i5BEH',
                'serial_number' => 'IN123789456',
                'problem_description' => 'La computadora no reconoce el disco duro. Aparece error "No bootable device found".',
                'accessories' => 'Monitor Dell 27", teclado inalámbrico',
                'notes' => 'Equipo compacto para oficina',
                'estimated_cost' => 1500.00,
                'estimated_delivery' => now()->addDays(3),
                'assigned_technician_id' => $tecnico1->id,
                'status' => 'cancelled',
                'brand_id' => $intel->id,
                'type_id' => $desktop->id,
                'model_id' => $intelNuc->id,
            ],
        ];

        foreach ($equipments as $equipmentData) {
            // Crear el equipo de reparación
            $equipment = RepairEquipment::create([
                'ticket_number' => RepairEquipment::generateTicketNumber(),
                'customer_name' => $equipmentData['customer_name'],
                'customer_phone' => $equipmentData['customer_phone'],
                'customer_email' => $equipmentData['customer_email'],
                'equipment_type' => $equipmentData['equipment_type'],
                'brand' => $equipmentData['brand'],
                'model' => $equipmentData['model'],
                'serial_number' => $equipmentData['serial_number'],
                'problem_description' => $equipmentData['problem_description'],
                'accessories' => $equipmentData['accessories'],
                'notes' => $equipmentData['notes'],
                'estimated_cost' => $equipmentData['estimated_cost'],
                'estimated_delivery' => $equipmentData['estimated_delivery'],
                'assigned_technician_id' => $equipmentData['assigned_technician_id'],
                'created_by' => $admin->id,
                'status' => $equipmentData['status'],
                'received_at' => now()->subDays(rand(1, 10)),
                'brand_id' => $equipmentData['brand_id'],
                'type_id' => $equipmentData['type_id'],
                'model_id' => $equipmentData['model_id'],
            ]);

            // Crear ticket automáticamente
            $this->createTicket($equipment, $admin);

            // Crear historial de estados
            $this->createStatusHistory($equipment, $equipmentData['status']);
        }

        $this->command->info('Equipos de reparación y tickets creados exitosamente con datos realistas.');
    }

    private function createTicket($equipment, $admin)
    {
        $priorities = ['low', 'medium', 'high', 'urgent'];
        $priority = $priorities[array_rand($priorities)];

        // Determinar prioridad basada en el problema
        if (str_contains(strtolower($equipment->problem_description), 'urgente') || 
            str_contains(strtolower($equipment->notes), 'urgente')) {
            $priority = 'urgent';
        } elseif (str_contains(strtolower($equipment->problem_description), 'gaming') || 
                  str_contains(strtolower($equipment->problem_description), 'trabajo')) {
            $priority = 'high';
        }

        Ticket::create([
            'ticket_number' => Ticket::generateTicketNumber(),
            'repair_equipment_id' => $equipment->id,
            'title' => "Reparación de {$equipment->brand} {$equipment->model} - {$equipment->customer_name}",
            'description' => $equipment->problem_description,
            'priority' => $priority,
            'status' => $this->mapEquipmentStatusToTicketStatus($equipment->status),
            'assigned_technician_id' => $equipment->assigned_technician_id,
            'created_by' => $admin->id,
            'due_date' => $equipment->estimated_delivery,
        ]);
    }

    private function mapEquipmentStatusToTicketStatus($equipmentStatus)
    {
        return match($equipmentStatus) {
            'received' => 'open',
            'in_review' => 'in_progress',
            'in_repair' => 'in_progress',
            'waiting_parts' => 'waiting_parts',
            'ready' => 'resolved',
            'delivered' => 'closed',
            'cancelled' => 'cancelled',
            default => 'open'
        };
    }

    private function createStatusHistory($equipment, $currentStatus)
    {
        $admin = User::where('email', 'admin@ticomsys.com')->first();
        $tecnico = $equipment->assignedTechnician;

        // Estado inicial: recibido
        EquipmentStatus::create([
            'repair_equipment_id' => $equipment->id,
            'status' => 'received',
            'description' => 'Equipo recibido en el sistema',
            'updated_by' => $admin->id,
            'status_date' => $equipment->received_at,
        ]);

        // Estados adicionales según el estado actual
        switch ($currentStatus) {
            case 'in_review':
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'in_review',
                    'description' => 'Equipo en revisión técnica inicial',
                    'notes' => 'Diagnóstico en proceso',
                    'updated_by' => $tecnico->id,
                    'status_date' => $equipment->received_at->addHours(2),
                ]);
                break;

            case 'in_repair':
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'in_review',
                    'description' => 'Equipo en revisión técnica inicial',
                    'updated_by' => $tecnico->id,
                    'status_date' => $equipment->received_at->addHours(2),
                ]);
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'in_repair',
                    'description' => 'Reparación en proceso',
                    'notes' => 'Componentes identificados, reparación iniciada',
                    'updated_by' => $tecnico->id,
                    'status_date' => $equipment->received_at->addDays(1),
                ]);
                break;

            case 'waiting_parts':
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'in_review',
                    'description' => 'Equipo en revisión técnica inicial',
                    'updated_by' => $tecnico->id,
                    'status_date' => $equipment->received_at->addHours(2),
                ]);
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'waiting_parts',
                    'description' => 'Esperando repuestos',
                    'notes' => 'Pantalla dañada, repuesto pedido al proveedor',
                    'updated_by' => $tecnico->id,
                    'status_date' => $equipment->received_at->addDays(2),
                ]);
                break;

            case 'ready':
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'in_review',
                    'description' => 'Equipo en revisión técnica inicial',
                    'updated_by' => $tecnico->id,
                    'status_date' => $equipment->received_at->addHours(2),
                ]);
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'in_repair',
                    'description' => 'Reparación en proceso',
                    'updated_by' => $tecnico->id,
                    'status_date' => $equipment->received_at->addDays(1),
                ]);
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'ready',
                    'description' => 'Equipo reparado y listo para entrega',
                    'notes' => 'Teclado reemplazado, pruebas completadas',
                    'updated_by' => $tecnico->id,
                    'status_date' => $equipment->received_at->addDays(2),
                ]);
                break;

            case 'delivered':
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'in_review',
                    'description' => 'Equipo en revisión técnica inicial',
                    'updated_by' => $tecnico->id,
                    'status_date' => $equipment->received_at->addHours(2),
                ]);
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'in_repair',
                    'description' => 'Reparación en proceso',
                    'updated_by' => $tecnico->id,
                    'status_date' => $equipment->received_at->addDays(1),
                ]);
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'ready',
                    'description' => 'Equipo reparado y listo para entrega',
                    'updated_by' => $tecnico->id,
                    'status_date' => $equipment->received_at->addDays(3),
                ]);
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'delivered',
                    'description' => 'Equipo entregado al cliente',
                    'notes' => 'Cliente satisfecho con la reparación',
                    'updated_by' => $admin->id,
                    'status_date' => $equipment->received_at->addDays(5),
                ]);
                break;

            case 'cancelled':
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'in_review',
                    'description' => 'Equipo en revisión técnica inicial',
                    'updated_by' => $tecnico->id,
                    'status_date' => $equipment->received_at->addHours(2),
                ]);
                EquipmentStatus::create([
                    'repair_equipment_id' => $equipment->id,
                    'status' => 'cancelled',
                    'description' => 'Reparación cancelada por el cliente',
                    'notes' => 'Cliente decidió comprar equipo nuevo',
                    'updated_by' => $admin->id,
                    'status_date' => $equipment->received_at->addDays(1),
                ]);
                break;
        }
    }
}