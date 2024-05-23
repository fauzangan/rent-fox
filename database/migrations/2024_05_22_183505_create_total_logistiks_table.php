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
        Schema::create('total_logistiks', function (Blueprint $table) {
            $table->id('total_logistik_id');
            $table->unsignedBigInteger('status_total_logistik_id')->nullable();
            $table->foreign('status_total_logistik_id')->references('status_total_logistik_id')->on('status_total_logistiks')->onDelete('set null');
            $table->date('tanggal_transaksi');
            $table->unsignedBigInteger('logistik_id');
            $table->foreign('logistik_id')->references('logistik_id')->on('logistiks')->onDelete('cascade');
            $table->bigInteger('jumlah_item');
            $table->string('keterangan')->nullable()->default('-');
            $table->unsignedBigInteger('data_total_logistik_id');
            $table->foreign('data_total_logistik_id')->references('data_total_logistik_id')->on('data_total_logistiks')->onDelete('cascade');
            $table->string('vendor')->nullable()->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_logistiks');
    }
};
