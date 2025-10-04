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
        Schema::create('equipment_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repair_equipment_id')->constrained('repair_equipment')->onDelete('cascade');
            $table->string('status'); // Estado del equipo
            $table->text('description')->nullable(); // Descripción del estado
            $table->text('notes')->nullable(); // Notas del técnico
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('status_date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_statuses');
    }
};
