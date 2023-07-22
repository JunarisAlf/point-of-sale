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
        Schema::create('cabang_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cabang_id')
                  ->constrained(table: 'cabangs', column: 'id', indexName: 'stock_cabang')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('item_id')
                  ->constrained(table: 'items', column: 'id', indexName: 'stock_item')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->date('expired_date');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('buying_price');
            $table->timestamps();
            $table->unique(['cabang_id', 'item_id', 'expired_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabang_items');
    }
};
