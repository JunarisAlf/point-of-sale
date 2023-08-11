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
        Schema::create('online_trxs', function (Blueprint $table) {
            $table->id();
            $table->string('note');
            $table->date('date');
            $table->unsignedBigInteger('total');
            $table->foreignId('cabang_id')
                ->constrained(table: 'cabangs', column: 'id', indexName: 'online_trx_cabang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_trxs');
    }
};
