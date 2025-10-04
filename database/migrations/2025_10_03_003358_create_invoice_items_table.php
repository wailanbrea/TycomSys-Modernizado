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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id'); // Relación con factura
            
            // Información del item
            $table->string('item_type')->default('service'); // 'service', 'product', 'part'
            $table->string('item_code')->nullable(); // Código del producto/servicio
            $table->string('item_name'); // Nombre del servicio/producto
            $table->text('description')->nullable(); // Descripción detallada
            
            // Cantidad y precios
            $table->decimal('quantity', 8, 2)->default(1); // Cantidad
            $table->string('unit')->default('pcs'); // Unidad (pcs, hrs, kg, etc.)
            $table->decimal('unit_price', 10, 2); // Precio unitario
            $table->decimal('discount_percentage', 5, 2)->default(0); // Porcentaje de descuento
            $table->decimal('discount_amount', 10, 2)->default(0); // Monto de descuento
            $table->decimal('tax_rate', 5, 2)->default(0); // Porcentaje de impuesto
            $table->decimal('tax_amount', 10, 2)->default(0); // Monto de impuesto
            $table->decimal('total_amount', 10, 2); // Total del item
            
            // Auditoría
            $table->timestamps();
            
            // Índices y claves foráneas
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            
            $table->index(['invoice_id']);
            $table->index(['item_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};