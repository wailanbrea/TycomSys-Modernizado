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
        // Verificar si la columna ya existe antes de agregarla
        if (!Schema::hasColumn('invoices', 'customer_id')) {
            Schema::table('invoices', function (Blueprint $table) {
                $table->unsignedBigInteger('customer_id')->nullable()->after('ticket_id');
                $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
                $table->index(['customer_id']);
            });
        }

        // Verificar si la columna ya existe antes de agregarla
        if (!Schema::hasColumn('repair_equipment', 'customer_id')) {
            Schema::table('repair_equipment', function (Blueprint $table) {
                $table->unsignedBigInteger('customer_id')->nullable()->after('ticket_number');
                $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
                $table->index(['customer_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
        });

        Schema::table('repair_equipment', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
        });
    }
};

