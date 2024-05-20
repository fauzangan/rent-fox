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
        Schema::create('logistik_harians', function (Blueprint $table) {
            $table->id('logistik_harian_id');
            $table->unsignedBigInteger('logistik_id');
            $table->foreign('logistik_id')->references('logistik_id')->on('logistiks')->onDelete('cascade');
            $table->date('tanggal_transaksi');
            $table->unsignedBigInteger('status_logistik_id');
            $table->foreign('status_logistik_id')->references('status_logistik_id')->on('status_logistiks')->onDelete('restrict');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->bigInteger('baik');
            $table->bigInteger('x_ringan');
            $table->bigInteger('x_berat');
            $table->bigInteger('jumlah_item');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistik_harians');
    }
};
