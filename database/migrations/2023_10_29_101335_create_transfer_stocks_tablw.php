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
        Schema::create('transfer_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')
                ->constrained(table: 'items', column: 'id', indexName: 'transfer_stocks_item_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('from_cabang_id')
                ->constrained(table: 'cabangs', column: 'id', indexName: 'transfer_stocks_from_cabang_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('to_cabang_id')
                ->constrained(table: 'cabangs', column: 'id', indexName: 'transfer_stocks_to_cabang_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('stock_id')
                ->constrained(table: 'cabang_items', column: 'id', indexName: 'transfer_stocks_stock_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('quantity');
            $table->boolean('is_acc')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_stocks');
    }
};
