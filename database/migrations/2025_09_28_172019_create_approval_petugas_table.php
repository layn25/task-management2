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
        Schema::create('approval_petugas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('penugasan_id')->references('id')->on('penugasans');
            $table->text('deskripsi');
            $table->string('bukti');
            $table->enum('kondisi', ['diterima', 'ditolak', 'diproses'])->default('diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_petugas');
    }
};
