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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique(); // Código único del producto
            $table->string('name'); // Nombre del repuesto/parte
            $table->text('description')->nullable(); // Descripción detallada
            $table->enum('category', ['part', 'component', 'accessory', 'tool', 'consumable'])->default('part');
            $table->string('brand')->nullable(); // Marca del repuesto
            $table->string('model')->nullable(); // Modelo específico
            $table->string('compatible_equipment')->nullable(); // Equipos compatibles
            
            // Información de stock
            $table->integer('current_stock')->default(0); // Stock actual
            $table->integer('minimum_stock')->default(5); // Stock mínimo
            $table->integer('maximum_stock')->default(100); // Stock máximo
            $table->string('unit')->default('pcs'); // Unidad (pcs, kg, m, etc.)
            
            // Información de precios
            $table->decimal('cost_price', 10, 2)->default(0); // Precio de costo
            $table->decimal('selling_price', 10, 2)->default(0); // Precio de venta
            $table->decimal('markup_percentage', 5, 2)->default(0); // Porcentaje de ganancia
            
            // Información de proveedor
            $table->string('supplier_name')->nullable(); // Nombre del proveedor
            $table->string('supplier_contact')->nullable(); // Contacto del proveedor
            $table->string('supplier_phone')->nullable(); // Teléfono del proveedor
            $table->string('supplier_email')->nullable(); // Email del proveedor
            
            // Ubicación en almacén
            $table->string('location_aisle')->nullable(); // Pasillo
            $table->string('location_shelf')->nullable(); // Estante
            $table->string('location_position')->nullable(); // Posición específica
            
            // Estado y control
            $table->boolean('is_active')->default(true); // Activo/Inactivo
            $table->boolean('low_stock_alert')->default(false); // Alerta de stock bajo
            $table->date('last_restocked')->nullable(); // Última reposición
            $table->date('last_used')->nullable(); // Último uso
            
            // Metadatos
            $table->text('notes')->nullable(); // Notas adicionales
            $table->string('barcode')->nullable(); // Código de barras
            $table->string('qr_code')->nullable(); // Código QR
            
            $table->timestamps();
            
            // Índices para optimizar consultas
            $table->index(['category', 'is_active']);
            $table->index(['current_stock', 'minimum_stock']);
            $table->index('supplier_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};