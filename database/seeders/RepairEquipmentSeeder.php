<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RepairEquipment;
use App\Models\EquipmentBrand;
use App\Models\EquipmentType;
use App\Models\EquipmentModel;
use App\Models\User;
use App\Models\Ticket;

class RepairEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener datos de equipos existentes (usando nombres en minúsculas)
        $dell = EquipmentBrand::where('name', 'dell')->first();
        $hp = EquipmentBrand::where('name', 'hp')->first();
        $lenovo = EquipmentBrand::where('name', 'lenovo')->first();
        $asus = EquipmentBrand::where('name', 'asus')->first();
        $canon = EquipmentBrand::where('name', 'canon')->first();

        $laptop = EquipmentType::where('name', 'laptop')->first();
        $desktop = EquipmentType::where('name', 'desktop')->first();
        $monitor = EquipmentType::where('name', 'monitor')->first(); // Usar monitor en lugar de impresora

        $dellInspiron = EquipmentModel::where('name', 'Inspiron 15 3000')->first();
        $hpPavilion = EquipmentModel::where('name', 'Pavilion Desktop TP01')->first();
        $lenovoThinkPad = EquipmentModel::where('name', 'ThinkPad E15')->first();
        $asusZenbook = EquipmentModel::where('name', 'ZenBook 14')->first();
        $canonPixma = EquipmentModel::where('name', 'PIXMA G3110')->first();

        // Obtener técnicos
        $tecnico1 = User::where('email', 'carlos.mendoza@ticomsys.com')->first();
        $tecnico2 = User::where('email', 'ana.rodriguez@ticomsys.com')->first();
        $admin = User::where('email', 'admin@ticomsys.com')->first();

        // Verificar que todos los datos necesarios existen
        if (!$dell || !$hp || !$lenovo || !$asus || !$canon) {
            $this->command->error('No se encontraron las marcas necesarias. Ejecuta primero EquipmentDataSeeder.');
            return;
        }

        if (!$laptop || !$desktop || !$monitor) {
            $this->command->error('No se encontraron los tipos de equipos necesarios. Ejecuta primero EquipmentDataSeeder.');
            return;
        }

        if (!$tecnico1 || !$tecnico2 || !$admin) {
            $this->command->error('No se encontraron los técnicos necesarios. Ejecuta primero TechnicianSeeder.');
            return;
        }

        $equipments = [
            [
                'customer_name' => 'María González',
                'customer_phone' => '+52 55 1234 5678',
                'customer_email' => 'maria.gonzalez@email.com',
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
                'serial_number' => 'LV456789123',
                'problem_description' => 'La pantalla tiene líneas verticales y parpadea. A veces se ve normal, otras veces completamente distorsionada.',
                'accessories' => 'Cargador, mochila',
                'notes' => 'Equipo para trabajo remoto',
                'estimated_cost' => 3200.00,
                'estimated_delivery' => now()->addDays(7),
                'assigned_technician_id' => $tecnico2->id,
                'status' => 'waiting_parts',
                'brand_id' => $lenovo->id,
                'type_id' => $laptop->id,
                'model_id' => $lenovoThinkPad->id,
            ],
            [
                'customer_name' => 'Roberto Silva',
                'customer_phone' => '+52 55 4444 5678',
                'customer_email' => 'roberto.silva@empresa.com',
                'serial_number' => 'AS789123456',
                'problem_description' => 'La laptop se calienta mucho y el ventilador hace ruido excesivo. A veces se apaga por sobrecalentamiento.',
                'accessories' => 'Cargador, mouse inalámbrico, base refrigerante',
                'notes' => 'Uso intensivo para gaming',
                'estimated_cost' => 2800.00,
                'estimated_delivery' => now()->addDays(4),
                'assigned_technician_id' => $tecnico2->id,
                'status' => 'in_repair',
                'brand_id' => $asus->id,
                'type_id' => $laptop->id,
                'model_id' => $asusZenbook->id,
            ],
            [
                'customer_name' => 'Laura Hernández',
                'customer_phone' => '+52 55 3333 9876',
                'customer_email' => 'laura.hernandez@empresa.com',
                'serial_number' => 'CN123789456',
                'problem_description' => 'La impresora no imprime correctamente. Las páginas salen con líneas horizontales y manchas de tinta.',
                'accessories' => 'Cables USB, cartuchos de repuesto',
                'notes' => 'Impresora de oficina, alto volumen',
                'estimated_cost' => 1200.00,
                'estimated_delivery' => now()->addDays(2),
                'assigned_technician_id' => $tecnico1->id,
                'status' => 'ready',
                'brand_id' => $canon->id,
                'type_id' => $monitor->id, // Usar monitor como tipo para impresoras
                'model_id' => $canonPixma->id,
            ],
            [
                'customer_name' => 'Miguel Torres',
                'customer_phone' => '+52 55 2222 3456',
                'customer_email' => 'miguel.torres@gmail.com',
                'serial_number' => 'DL789456123',
                'problem_description' => 'La laptop funciona pero la batería se agota muy rápido. Solo dura 30 minutos desconectada.',
                'accessories' => 'Cargador, mouse, funda',
                'notes' => 'Laptop personal, uso diario',
                'estimated_cost' => 1500.00,
                'estimated_delivery' => now()->addDays(6),
                'assigned_technician_id' => $tecnico2->id,
                'status' => 'delivered',
                'brand_id' => $dell->id,
                'type_id' => $laptop->id,
                'model_id' => $dellInspiron->id,
            ],
            [
                'customer_name' => 'Patricia López',
                'customer_phone' => '+52 55 1111 7890',
                'customer_email' => 'patricia.lopez@empresa.com',
                'serial_number' => 'HP456123789',
                'problem_description' => 'El desktop no arranca. Se enciende el LED de encendido pero no hay señal en el monitor.',
                'accessories' => 'Monitor, teclado, mouse, parlantes',
                'notes' => 'Equipo de trabajo, urgente',
                'estimated_cost' => 2200.00,
                'estimated_delivery' => now()->addDays(3),
                'assigned_technician_id' => $tecnico1->id,
                'status' => 'received',
                'brand_id' => $hp->id,
                'type_id' => $desktop->id,
                'model_id' => $hpPavilion->id,
            ],
            [
                'customer_name' => 'Fernando García',
                'customer_phone' => '+52 55 9999 1111',
                'customer_email' => 'fernando.garcia@empresa.com',
                'serial_number' => 'LV321654987',
                'problem_description' => 'La laptop se cuelga frecuentemente y muestra pantalla azul. Parece ser problema de memoria RAM.',
                'accessories' => 'Cargador, mouse, memoria RAM adicional',
                'notes' => 'Equipo corporativo, prioridad alta',
                'estimated_cost' => 1900.00,
                'estimated_delivery' => now()->addDays(5),
                'assigned_technician_id' => $tecnico2->id,
                'status' => 'in_review',
                'brand_id' => $lenovo->id,
                'type_id' => $laptop->id,
                'model_id' => $lenovoThinkPad->id,
            ],
        ];

        foreach ($equipments as $equipmentData) {
            // Crear el equipo de reparación
            $equipment = RepairEquipment::create([
                'ticket_number' => RepairEquipment::generateTicketNumber(),
                'customer_name' => $equipmentData['customer_name'],
                'customer_phone' => $equipmentData['customer_phone'],
                'customer_email' => $equipmentData['customer_email'],
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
            $this->createStatusHistory($equipment);
        }

        echo "Equipos de reparación creados exitosamente!\n";
        echo "Se crearon " . count($equipments) . " equipos con tickets asociados.\n";
    }

    /**
     * Crear ticket para el equipo de reparación
     */
    private function createTicket($equipment, $admin)
    {
        // Mapear el estado del equipo al estado del ticket
        $statusMap = [
            'received' => 'open',
            'in_review' => 'in_progress',
            'in_repair' => 'in_progress',
            'waiting_parts' => 'waiting_parts',
            'ready' => 'resolved',
            'delivered' => 'closed'
        ];

        $ticket = Ticket::create([
            'ticket_number' => $equipment->ticket_number,
            'repair_equipment_id' => $equipment->id,
            'title' => 'Reparación de ' . $equipment->customer_name,
            'description' => $equipment->problem_description,
            'priority' => $this->getRandomPriority(),
            'status' => $statusMap[$equipment->status] ?? 'open',
            'assigned_technician_id' => $equipment->assigned_technician_id,
            'created_by' => $admin->id,
            'due_date' => $equipment->estimated_delivery,
            'resolved_at' => $equipment->status === 'delivered' ? now() : null,
            'resolution_notes' => $equipment->status === 'delivered' ? 'Equipo entregado al cliente' : null,
        ]);

        return $ticket;
    }

    /**
     * Crear historial de estados del equipo
     */
    private function createStatusHistory($equipment)
    {
        $statuses = ['received', 'in_review', 'in_repair', 'waiting_parts', 'ready', 'delivered'];
        $currentStatusIndex = array_search($equipment->status, $statuses);
        
        // Crear historial hasta el estado actual
        for ($i = 0; $i <= $currentStatusIndex; $i++) {
            $status = $statuses[$i];
            $statusDate = $equipment->received_at->copy()->addHours($i * 2);
            
            // Insertar directamente en la tabla
            \DB::table('equipment_statuses')->insert([
                'repair_equipment_id' => $equipment->id,
                'status' => $status,
                'description' => $this->getStatusDescription($status),
                'notes' => $this->getStatusNote($status),
                'updated_by' => $equipment->assigned_technician_id,
                'status_date' => $statusDate,
                'created_at' => $statusDate,
                'updated_at' => $statusDate,
            ]);
        }
    }

    /**
     * Obtener prioridad aleatoria
     */
    private function getRandomPriority()
    {
        $priorities = ['low', 'medium', 'high', 'urgent'];
        return $priorities[array_rand($priorities)];
    }

    /**
     * Obtener descripción según el estado
     */
    private function getStatusDescription($status)
    {
        $descriptions = [
            'received' => 'Equipo recibido y registrado en el sistema',
            'in_review' => 'Equipo en revisión inicial',
            'in_repair' => 'Reparación en progreso',
            'waiting_parts' => 'Esperando repuestos',
            'ready' => 'Equipo reparado y listo para entrega',
            'delivered' => 'Equipo entregado al cliente',
        ];

        return $descriptions[$status] ?? 'Estado actualizado';
    }

    /**
     * Obtener nota según el estado
     */
    private function getStatusNote($status)
    {
        $notes = [
            'received' => 'Equipo recibido y registrado en el sistema',
            'in_review' => 'Equipo en revisión inicial',
            'in_repair' => 'Reparación en progreso',
            'waiting_parts' => 'Esperando repuestos',
            'ready' => 'Equipo reparado y listo para entrega',
            'delivered' => 'Equipo entregado al cliente',
        ];

        return $notes[$status] ?? 'Estado actualizado';
    }
}