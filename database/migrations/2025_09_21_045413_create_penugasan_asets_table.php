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
        Schema::create('penugasan_asets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('penugasan_id')->references('id')->on('penugasans');
            $table->foreignUuid('aset_id')->references('id')->on('asets');
            $table->dateTime('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penugasan_asets');
    }
};
