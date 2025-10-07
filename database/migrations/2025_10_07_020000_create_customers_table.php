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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code')->unique(); // Código único del cliente (CLI-2025-0001)
            $table->enum('customer_type', ['individual', 'company'])->default('individual'); // Tipo de cliente
            
            // Información personal (para individuos)
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            
            // Información de empresa
            $table->string('company_name')->nullable();
            $table->string('tax_id')->nullable(); // RNC/Cédula
            
            // Contacto
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            
            // Dirección
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('República Dominicana');
            
            // Información comercial
            $table->string('website')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('status')->default(true); // Activo/Inactivo
            $table->integer('payment_terms')->default(0); // Días de crédito (0 = al contado)
            $table->decimal('credit_limit', 10, 2)->default(0); // Límite de crédito
            
            // Auditoría
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            // Índices
            $table->index(['customer_code']);
            $table->index(['email']);
            $table->index(['phone']);
            $table->index(['tax_id']);
            $table->index(['status']);
            $table->index(['customer_type']);
            
            // Claves foráneas
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

