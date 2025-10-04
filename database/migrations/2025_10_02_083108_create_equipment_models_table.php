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
        Schema::create('equipment_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('equipment_brands')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('equipment_types')->onDelete('cascade');
            $table->string('name'); // Inspiron 15 3000, Pavilion Desktop TP01, etc.
            $table->string('display_name')->nullable(); // Nombre para mostrar
            $table->text('description')->nullable(); // Descripción del modelo
            $table->boolean('is_active')->default(true); // Si está activo
            $table->timestamps();
            
            // Índice único para evitar duplicados de marca+modelo
            $table->unique(['brand_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_models');
    }
};