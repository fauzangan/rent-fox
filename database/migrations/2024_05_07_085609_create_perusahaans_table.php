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
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id('perusahaan_id');
            $table->unsignedBigInteger('badan_hukum_id');
            $table->foreign('badan_hukum_id')->references('badan_hukum_id')->on('badan_hukums');
            $table->string('nama');
            $table->string('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('telp')->nullable();
            $table->string('fax')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaans');
    }
};
