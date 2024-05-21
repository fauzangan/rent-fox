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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id('reservasi_id');
            $table->date('tanggal_reservasi');
            $table->unsignedBigInteger('status_reservasi_id');
            $table->foreign('status_reservasi_id')->references('status_reservasi_id')->on('status_reservasis')->onDelete('cascade');
            $table->string('nama_customer');
            $table->string('telp_customer')->nullable();
            $table->string('fax_customer')->nullable();
            $table->string('handphone');
            $table->string('badan_hukum')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('telp_perusahaan')->nullable();
            $table->string('fax_perusahaan')->nullable();
            $table->string('proyek')->nullable()->default('-');
            $table->string('keterangan')->nullable()->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
