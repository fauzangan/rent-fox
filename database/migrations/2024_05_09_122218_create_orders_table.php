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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->date('tanggal_order');
            $table->date('tanggal_kirim');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('customer_id')->on('customers');
            $table->string('nama_customer');
            $table->string('identitas_customer');
            $table->string('alamat_customer');
            $table->string('kota_customer');
            $table->string('telp_customer')->nullable();
            $table->string('fax_customer')->nullable();
            $table->string('handphone_customer');
            $table->string('badan_hukum')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('alamat_perusahaan')->nullable();
            $table->string('kota_perusahaan')->nullable();
            $table->string('telp_perusahaan')->nullable();
            $table->string('fax_perusahaan')->nullable();
            $table->string('kirim_kepada');
            $table->string('nama_proyek');
            $table->string('alamat_kirim');
            $table->string('keterangan');
            $table->boolean('status_transport');
            $table->unsignedTinyInteger('status_order')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
