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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_item_id')->constrained('inventory_items')->onDelete('cascade');
            $table->enum('movement_type', ['in', 'out', 'adjustment', 'transfer', 'return']); // Tipo de movimiento
            $table->integer('quantity'); // Cantidad (positiva para entrada, negativa para salida)
            $table->integer('stock_before'); // Stock antes del movimiento
            $table->integer('stock_after'); // Stock después del movimiento
            
            // Referencias
            $table->string('reference_type')->nullable(); // Tipo de referencia (repair_equipment, purchase, etc.)
            $table->unsignedBigInteger('reference_id')->nullable(); // ID de la referencia
            $table->string('reference_number')->nullable(); // Número de referencia
            
            // Información del movimiento
            $table->text('reason')->nullable(); // Razón del movimiento
            $table->text('notes')->nullable(); // Notas adicionales
            $table->foreignId('performed_by')->constrained('users')->onDelete('cascade'); // Usuario que realizó el movimiento
            
            // Información de costo (para movimientos de entrada)
            $table->decimal('unit_cost', 10, 2)->nullable(); // Costo unitario
            $table->decimal('total_cost', 10, 2)->nullable(); // Costo total
            
            // Fechas
            $table->timestamp('movement_date'); // Fecha del movimiento
            $table->timestamps();
            
            // Índices
            $table->index(['inventory_item_id', 'movement_date']);
            $table->index(['movement_type', 'movement_date']);
            $table->index(['reference_type', 'reference_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};