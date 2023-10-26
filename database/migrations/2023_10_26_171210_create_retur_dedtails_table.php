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
        Schema::create('retur_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('retur_id')
                ->constrained(table: 'returs', column: 'id', indexName: 'retur_details_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('item_id')
                ->constrained(table: 'items', column: 'id', indexName: 'retur_details_item_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retur_dedtails');
    }
};
