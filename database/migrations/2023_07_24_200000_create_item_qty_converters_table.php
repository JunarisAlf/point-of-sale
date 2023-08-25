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
        Schema::create('item_qty_converters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')
                  ->constrained(table: 'items', column: 'id', indexName: 'item_converter')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('name');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_qty_converters');
    }
};
