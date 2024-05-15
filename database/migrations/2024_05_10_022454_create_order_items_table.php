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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_item_id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->string('item_id')->nullable();
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('set null');
            $table->string('nama_item');
            $table->unsignedBigInteger('harga_sewa');
            $table->string('satuan');
            $table->unsignedInteger('waktu');
            $table->unsignedBigInteger('jumlah_item');
            $table->unsignedBigInteger('jumlah_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
