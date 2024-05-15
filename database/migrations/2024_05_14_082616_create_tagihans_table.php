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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id('tagihan_id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->date('tanggal_ditagihkan');
            $table->unsignedBigInteger('jenis_tagihan_id');
            $table->foreign('jenis_tagihan_id')->references('jenis_tagihan_id')->on('jenis_tagihans');
            $table->date('jatuh_tempo_1');
            $table->date('jatuh_tempo_2');
            $table->unsignedBigInteger('jumlah_tagihan');
            $table->unsignedBigInteger('status_tagihan_id');
            $table->foreign('status_tagihan_id')->references('status_tagihan_id')->on('status_tagihans');
            $table->string('keterangan')->default('-')->nullable();
            $table->unsignedBigInteger('total_dp')->nullable();
            $table->unsignedBigInteger('dp1')->nullable();
            $table->unsignedBigInteger('dp2')->nullable();
            $table->unsignedBigInteger('dp3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
