<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            SystemSettingsSeeder::class,
            EquipmentDataSeeder::class,
            TechnicianSeeder::class,
            CustomerSeeder::class,
            RepairEquipmentSeeder::class,
            InvoiceSeeder::class,
            InventorySeeder::class,
        ]);
    }
}
