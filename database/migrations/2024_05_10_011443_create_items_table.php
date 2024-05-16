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
        Schema::create('items', function (Blueprint $table) {
            $table->string('item_id')->primary();
            $table->unsignedBigInteger('category_item_id')->nullable();
            $table->foreign('category_item_id')->references('category_item_id')->on('category_items')->onDelete('set null');
            $table->string('nama_item');
            $table->unsignedBigInteger('harga_sewa');
            $table->string('satuan_waktu');
            $table->string('satuan_item')->default('Buah');
            $table->unsignedBigInteger('harga_barang');
            $table->unsignedBigInteger('x_ringan')->default(0);
            $table->float('x_berat')->default(0);
            $table->float('hilang')->default(0);
            $table->string('keterangan')->default('-')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
