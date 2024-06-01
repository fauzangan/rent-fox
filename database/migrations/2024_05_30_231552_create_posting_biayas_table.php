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
        Schema::create('posting_biayas', function (Blueprint $table) {
            $table->string('posting_biaya_id')->primary();
            $table->string('nama_posting');
            $table->unsignedBigInteger('group_biaya_id')->nullable();
            $table->foreign('group_biaya_id')->references('group_biaya_id')->on('group_biayas')->onDelete('set null');
            $table->string('keterangan')->nullable()->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posting_biayas');
    }
};
