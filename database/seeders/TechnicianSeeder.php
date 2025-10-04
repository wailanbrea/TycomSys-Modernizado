<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class TechnicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tecnicoRole = Role::where('name', 'tecnico')->first();

        if (!$tecnicoRole) {
            $this->command->error('Rol "tecnico" no encontrado. Ejecuta primero RolePermissionSeeder.');
            return;
        }

        $technicians = [
            [
                'name' => 'Carlos Mendoza',
                'email' => 'carlos.mendoza@ticomsys.com',
                'password' => Hash::make('tecnico123'),
                'specialty' => 'Laptops y Desktops'
            ],
            [
                'name' => 'Ana Rodríguez',
                'email' => 'ana.rodriguez@ticomsys.com',
                'password' => Hash::make('tecnico123'),
                'specialty' => 'Smartphones y Tablets'
            ],
            [
                'name' => 'Miguel Torres',
                'email' => 'miguel.torres@ticomsys.com',
                'password' => Hash::make('tecnico123'),
                'specialty' => 'Gaming y Hardware'
            ],
            [
                'name' => 'Laura Sánchez',
                'email' => 'laura.sanchez@ticomsys.com',
                'password' => Hash::make('tecnico123'),
                'specialty' => 'Mac y Apple'
            ],
            [
                'name' => 'Roberto Jiménez',
                'email' => 'roberto.jimenez@ticomsys.com',
                'password' => Hash::make('tecnico123'),
                'specialty' => 'Redes y Servidores'
            ],
            [
                'name' => 'Patricia López',
                'email' => 'patricia.lopez@ticomsys.com',
                'password' => Hash::make('tecnico123'),
                'specialty' => 'Monitores y Periféricos'
            ]
        ];

        foreach ($technicians as $techData) {
            // Verificar si el usuario ya existe
            $existingUser = User::where('email', $techData['email'])->first();
            
            if (!$existingUser) {
                $user = User::create([
                    'name' => $techData['name'],
                    'email' => $techData['email'],
                    'password' => $techData['password'],
                ]);

                // Asignar rol de técnico
                $user->assignRole($tecnicoRole);

                $this->command->info("Técnico creado: {$user->name} ({$user->email}) - Especialidad: {$techData['specialty']}");
            } else {
                $this->command->info("Técnico ya existe: {$existingUser->name} ({$existingUser->email})");
            }
        }

        $this->command->info('Técnicos creados exitosamente!');
        $this->command->info('Credenciales para todos los técnicos: email / tecnico123');
    }
}