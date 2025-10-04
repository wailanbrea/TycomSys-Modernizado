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
        Schema::create('repair_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique(); // Número de ticket único
            $table->string('customer_name'); // Nombre del cliente
            $table->string('customer_phone'); // Teléfono del cliente
            $table->string('customer_email')->nullable(); // Email del cliente
            $table->string('equipment_type'); // Tipo de equipo (laptop, desktop, etc.)
            $table->string('brand'); // Marca del equipo
            $table->string('model'); // Modelo del equipo
            $table->string('serial_number')->nullable(); // Número de serie
            $table->text('problem_description'); // Descripción del problema
            $table->text('accessories')->nullable(); // Accesorios incluidos
            $table->text('notes')->nullable(); // Notas adicionales
            $table->decimal('estimated_cost', 10, 2)->nullable(); // Costo estimado
            $table->decimal('final_cost', 10, 2)->nullable(); // Costo final
            $table->enum('status', ['received', 'in_review', 'in_repair', 'waiting_parts', 'ready', 'delivered', 'cancelled'])->default('received');
            $table->foreignId('assigned_technician_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('received_at')->useCurrent();
            $table->timestamp('estimated_delivery')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_equipment');
    }
};
