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
        Schema::create('customer_trx_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cus_trx_id')
                  ->constrained(table: 'customer_trxs', column: 'id', indexName: 'cus_trx_detail')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('item_id')
                  ->constrained(table: 'items', column: 'id', indexName: 'cus_trx_detail_item')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('satuan_id')
                  ->nullable()
                  ->constrained(table: 'item_qty_converters', column: 'id', indexName: 'item_qty_converters_sell_detail')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->unsignedInteger('qty_satuan')->nullable();
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('discount');
            $table->unsignedBigInteger('grand_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_trx_details');
    }
};
