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
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('set null');
            $table->string('kirim_kepada');
            $table->string('nama_proyek');
            $table->string('alamat_kirim');
            $table->string('keterangan');
            $table->string('memo')->nullable();
            $table->unsignedBigInteger('status_transport_id')->nullable();
            $table->foreign('status_transport_id')->references('status_transport_id')->on('status_transports')->onDelete('set null');
            $table->unsignedBigInteger('total_harga')->default(0);
            $table->float('discount')->default(0);
            $table->unsignedBigInteger('total_harga_disc')->default(0);
            $table->unsignedBigInteger('biaya_transport')->default(0);
            $table->unsignedBigInteger('status_order_id')->nullable();
            $table->foreign('status_order_id')->references('status_order_id')->on('status_orders')->onDelete('set null');
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
