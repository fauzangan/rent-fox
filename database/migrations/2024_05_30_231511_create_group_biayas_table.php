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
        Schema::create('group_biayas', function (Blueprint $table) {
            $table->id('group_biaya_id');
            $table->string('nama_group');
            $table->string('prefiks', 10)->unique();
            $table->string('keterangan')->nullable()->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_biayas');
    }
};
