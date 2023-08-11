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
        Schema::create('online_trx_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('online_trx_id')
                  ->constrained(table: 'online_trxs', column: 'id', indexName: 'online_trx_detail')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('item_id')
                  ->constrained(table: 'items', column: 'id', indexName: 'online_trx_detail_item')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('grand_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_trx_detail');
    }
};
