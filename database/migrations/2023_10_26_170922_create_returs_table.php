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
        Schema::create('returs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cabang_id')
                ->constrained(table: 'cabangs', column: 'id', indexName: 'retur_cabang_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->enum('type', ['ke-supplier', 'dari-customer']);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returs');
    }
};
