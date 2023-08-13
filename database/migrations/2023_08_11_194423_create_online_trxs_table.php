<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->uuid('invoice_id')->default(DB::raw('UUID()'))->unique();
            $table->string('note');
            $table->datetime('date');
            $table->unsignedBigInteger('total');
            $table->foreignId('cabang_id')
                ->constrained(table: 'cabangs', column: 'id', indexName: 'online_trx_cabang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('user_id')
                ->constrained(table: 'users', column: 'id', indexName: 'online_trx_cashier')
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
