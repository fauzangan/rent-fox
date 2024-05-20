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
        Schema::create('logistiks', function (Blueprint $table) {
            $table->id('logistik_id');
            $table->string('item_id');
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
            $table->unsignedBigInteger('stock_awal');
            $table->bigInteger('total_log')->default(0);
            $table->bigInteger('claim_hilang')->default(0);
            $table->bigInteger('total_stock')->default(0);
            $table->bigInteger('reserve')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistiks');
    }
};
