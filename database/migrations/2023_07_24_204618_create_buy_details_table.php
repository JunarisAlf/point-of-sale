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
        Schema::create('buy_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buy_id')
                  ->constrained(table: 'buys', column: 'id', indexName: 'buy_details')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('item_id')
                  ->constrained(table: 'items', column: 'id', indexName: 'item_buy_details')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('satuan_id')
                  ->constrained(table: 'item_qty_converters', column: 'id', indexName: 'item_qty_converters_buy_detail')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->unsignedInteger('qty_satuan');
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('grand_price');
            $table->date('expired_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_details');
    }
};
