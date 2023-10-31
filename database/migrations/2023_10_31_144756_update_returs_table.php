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
        Schema::table('returs', function (Blueprint $table) {
            $table->foreignId('supplier_id')
                ->nullable(true)
                ->constrained(table: 'suppliers', column: 'id', indexName: 'suppliers_retur')
                ->onDelete('set null')
                ->onUpdate('set null');
            $table->foreignId('customer_id')
                ->nullable(true)
                ->constrained(table: 'customers', column: 'id', indexName: 'customers_retur')
                ->onDelete('set null')
                ->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('returs', function (Blueprint $table) {
            $table->dropForeign('suppliers_retur');
            $table->dropForeign('customers_retur');
            $table->dropColumn('supplier_id');
            $table->dropColumn('customer_id');
        });
    }
};
