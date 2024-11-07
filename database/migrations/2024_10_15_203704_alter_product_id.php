<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('history', function (Blueprint $table) {
            // Hapus foreign key dengan nama default Laravel
            $table->dropForeign(['product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('history', function (Blueprint $table) {
            // Kembalikan foreign key dengan onDelete cascade
            $table->foreign('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');
        });
    }
};
