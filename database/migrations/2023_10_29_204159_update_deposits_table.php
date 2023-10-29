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
        Schema::table('deposits', function (Blueprint $table) {
            $table->unsignedBigInteger('total_system');
            $table->foreignId('user_id')
                ->nullable(true)
                ->constrained(table: 'users', column: 'id', indexName: 'user_deposit')
                ->onDelete('set null')
                ->onUpdate('set null');
            $table->json('data')->nullable();
            $table->bigInteger('total')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->dropForeign('user_deposit');
            $table->dropColumn('user_id');
            $table->dropColumn('data');
            $table->dropColumn('total_system');

        });
    }
};
