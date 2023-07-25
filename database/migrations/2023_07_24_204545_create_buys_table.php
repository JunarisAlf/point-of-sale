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
        Schema::create('buys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')
                  ->constrained(table: 'suppliers', column: 'id', indexName: 'supplier_buy')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('cabang_id')
                  ->constrained(table: 'cabangs', column: 'id', indexName: 'cabang_buy')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->date('date');
            $table->boolean('is_paid');
            $table->boolean('is_arrived');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buys');
    }
};
