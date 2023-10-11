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
        Schema::create('multi_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')
                  ->constrained(table: 'items', column: 'id', indexName: 'item_multi_price')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('price');
            $table->decimal('percentage', 4, 2, true)->unsigned(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multi_prices');
    }
};
