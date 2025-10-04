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
            // Agregar columnas para las foreign keys
            $table->foreignId('brand_id')->nullable()->after('equipment_type')->constrained('equipment_brands')->onDelete('set null');
            $table->foreignId('type_id')->nullable()->after('brand_id')->constrained('equipment_types')->onDelete('set null');
            $table->foreignId('model_id')->nullable()->after('type_id')->constrained('equipment_models')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('repair_equipment', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['model_id']);
            $table->dropColumn(['brand_id', 'type_id', 'model_id']);
        });
    }
};