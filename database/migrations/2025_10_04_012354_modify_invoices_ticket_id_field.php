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
        Schema::table('invoices', function (Blueprint $table) {
            // Eliminar la clave foránea existente
            $table->dropForeign(['ticket_id']);
            
            // Cambiar el campo de unsignedBigInteger a string
            $table->string('ticket_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Cambiar de vuelta a unsignedBigInteger
            $table->unsignedBigInteger('ticket_id')->nullable()->change();
            
            // Restaurar la clave foránea
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('set null');
        });
    }
};