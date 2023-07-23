<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('stock_opnames', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_item_id')
                  ->constrained(table: 'cabang_items', column: 'id', indexName: 'stock_item_opname')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->date('date');
            $table->foreignId('user_id')
                  ->constrained(table: 'users', column: 'id', indexName: 'user_stock_opname')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('old_quantity');
            $table->integer('quantity');
            $table->boolean('is_acc')->default(false);
            $table->timestamps();

            $table->unique(['stock_item_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('stock_opnames');
    }
};
