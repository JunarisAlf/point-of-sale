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
        Schema::create('customer_trxs', function (Blueprint $table) {
            $table->id();
            $table->uuid('invoice_id')->default(DB::raw('UUID()'))->unique();
            $table->foreignId('customer_id')
                  ->nullable()
                  ->constrained(table: 'customers', column: 'id', indexName: 'cus_trx')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('cabang_id')
                  ->constrained(table: 'cabangs', column: 'id', indexName: 'cus_trx_cabang')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('user_id')
                  ->constrained(table: 'users', column: 'id', indexName: 'cus_trx_cashier')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->dateTime('date');
            $table->dateTime('paid_date')->nullable(); //if null the trx is do in cash
            $table->boolean('is_paid');
            $table->unsignedBigInteger('total_pay');
            $table->unsignedBigInteger('sub_total');
            $table->unsignedBigInteger('total');
            $table->unsignedBigInteger('total_discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_trxs');
    }
};
