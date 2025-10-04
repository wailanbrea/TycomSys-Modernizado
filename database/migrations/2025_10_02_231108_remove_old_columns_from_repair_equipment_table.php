<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('repair_equipment', function (Blueprint $table) {
            // Eliminar columnas antiguas que causan conflicto con las relaciones
            if (Schema::hasColumn('repair_equipment', 'brand')) {
                $table->dropColumn('brand');
            }
            if (Schema::hasColumn('repair_equipment', 'model')) {
                $table->dropColumn('model');
            }
            if (Schema::hasColumn('repair_equipment', 'equipment_type')) {
                $table->dropColumn('equipment_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('repair_equipment', function (Blueprint $table) {
            // Revertir cambios si es necesario
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('equipment_type')->nullable();
        });
    }
};