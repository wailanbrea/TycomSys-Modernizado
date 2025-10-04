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
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Clave única de configuración
            $table->text('value')->nullable(); // Valor de la configuración
            $table->string('type')->default('string'); // Tipo de dato (string, integer, boolean, json, text)
            $table->string('group')->default('general'); // Grupo de configuración
            $table->string('label'); // Etiqueta para mostrar en la interfaz
            $table->text('description')->nullable(); // Descripción de la configuración
            $table->boolean('is_public')->default(false); // Si es accesible públicamente
            $table->boolean('is_required')->default(false); // Si es obligatorio
            $table->text('validation_rules')->nullable(); // Reglas de validación
            $table->text('options')->nullable(); // Opciones para campos select/radio
            $table->integer('sort_order')->default(0); // Orden de visualización
            $table->timestamps();
            
            // Índices
            $table->index(['group', 'sort_order']);
            $table->index('is_public');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};