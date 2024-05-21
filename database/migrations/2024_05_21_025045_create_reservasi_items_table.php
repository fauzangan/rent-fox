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
        Schema::create('reservasi_items', function (Blueprint $table) {
            $table->id('reservasi_item_id');
            $table->unsignedBigInteger('reservasi_id');
            $table->foreign('reservasi_id')->references('reservasi_id')->on('reservasis')->onDelete('cascade');
            $table->unsignedBigInteger('logistik_id');
            $table->foreign('logistik_id')->references('logistik_id')->on('logistiks')->onDelete('cascade');
            $table->string('item_id');
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
            $table->unsignedBigInteger('jumlah_item');
            $table->float('discount')->nullable()->default(0);
            $table->unsignedBigInteger('jumlah_harga_disc')->default(0);
            $table->unsignedBigInteger('jumlah_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi_items');
    }
};
