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
        Schema::create('equipment_brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Dell, HP, Lenovo, etc.
            $table->string('display_name')->nullable(); // Nombre para mostrar
            $table->text('description')->nullable(); // Descripción de la marca
            $table->boolean('is_active')->default(true); // Si está activa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_brands');
    }
};