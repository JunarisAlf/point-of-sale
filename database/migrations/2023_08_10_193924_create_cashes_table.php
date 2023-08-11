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
        Schema::create('cashes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cabang_id')
                  ->constrained(table: 'cabangs', column: 'id', indexName: 'cashes_cabang')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->dateTime('date');
            $table->enum('flow', ['in', 'out']);
            $table->string('name');
            $table->unsignedBigInteger('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashes');
    }
};
