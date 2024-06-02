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
        Schema::create('buku_harians', function (Blueprint $table) {
            $table->id('buku_harian_id');
            $table->date('tanggal_transaksi');
            $table->string('posting_biaya_id')->nullable();
            $table->foreign('posting_biaya_id')->references('posting_biaya_id')->on('posting_biayas')->onDelete('set null');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('set null');
            $table->string('keterangan')->nullable();
            $table->bigInteger('debit')->default(0);
            $table->bigInteger('kredit')->default(0);
            $table->bigInteger('saldo')->default(0);
            $table->unsignedBigInteger('data_buku_harian_id')->nullable();
            $table->foreign('data_buku_harian_id')->references('data_buku_harian_id')->on('data_buku_harians')->onDelete('set null');
            $table->string('vendor')->nullable()->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_harians');
    }
};
