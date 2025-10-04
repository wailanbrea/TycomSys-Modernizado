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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique(); // TIC-2025-0001
            $table->foreignId('repair_equipment_id')->constrained('repair_equipment')->onDelete('cascade');
            $table->string('title'); // Título del ticket
            $table->text('description'); // Descripción del problema
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->enum('status', ['open', 'in_progress', 'waiting_customer', 'waiting_parts', 'resolved', 'closed', 'cancelled'])->default('open');
            $table->foreignId('assigned_technician_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('due_date')->nullable(); // Fecha límite
            $table->timestamp('resolved_at')->nullable(); // Fecha de resolución
            $table->text('resolution_notes')->nullable(); // Notas de resolución
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};