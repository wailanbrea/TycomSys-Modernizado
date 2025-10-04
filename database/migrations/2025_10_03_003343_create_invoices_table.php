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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique(); // Número de factura único
            $table->unsignedBigInteger('repair_equipment_id'); // Relación con equipo de reparación
            $table->unsignedBigInteger('ticket_id')->nullable(); // Relación con ticket (opcional)
            
            // Información del cliente
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('customer_tax_id')->nullable(); // RFC o NIT
            
            // Información de la factura
            $table->date('invoice_date');
            $table->date('due_date')->nullable(); // Fecha de vencimiento
            $table->enum('status', ['draft', 'sent', 'paid', 'overdue', 'cancelled'])->default('draft');
            $table->enum('payment_method', ['cash', 'card', 'transfer', 'check', 'credit'])->nullable();
            $table->text('notes')->nullable();
            
            // Totales
            $table->decimal('subtotal', 10, 2)->default(0); // Subtotal sin impuestos
            $table->decimal('tax_rate', 5, 2)->default(0); // Porcentaje de impuesto (ej: 16.00)
            $table->decimal('tax_amount', 10, 2)->default(0); // Monto de impuestos
            $table->decimal('discount_amount', 10, 2)->default(0); // Descuento aplicado
            $table->decimal('total_amount', 10, 2)->default(0); // Total final
            
            // Información de pago
            $table->date('paid_date')->nullable();
            $table->text('payment_reference')->nullable(); // Referencia de pago
            $table->text('payment_notes')->nullable();
            
            // Auditoría
            $table->unsignedBigInteger('created_by'); // Usuario que creó la factura
            $table->unsignedBigInteger('updated_by')->nullable(); // Usuario que actualizó
            $table->timestamps();
            
            // Índices y claves foráneas
            $table->foreign('repair_equipment_id')->references('id')->on('repair_equipment')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            
            $table->index(['invoice_number']);
            $table->index(['status']);
            $table->index(['invoice_date']);
            $table->index(['repair_equipment_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};