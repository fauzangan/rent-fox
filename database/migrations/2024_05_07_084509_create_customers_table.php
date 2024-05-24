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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('nama');
            $table->string('jenis_identitas');
            $table->date('identitas_berlaku')->nullable();
            $table->string('nomor_identitas')->unique();
            $table->string('jabatan')->default("-")->nullable();
            $table->string('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('telp')->default('-')->nullable();
            $table->string('fax')->default('-')->nullable();
            $table->string('handphone')->unique();
            $table->text('keterangan')->default("-")->nullable();
            $table->string('bonafidity');
            $table->unsignedBigInteger('status_customer_id')->nullable();
            $table->foreign('status_customer_id')->references('status_customer_id')->on('status_customers')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
