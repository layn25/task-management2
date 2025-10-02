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
        Schema::create('pengembalian_asets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('penugasan_aset_id')->references('id')->on('penugasan_asets');
            $table->dateTime('tanggal');
            $table->enum('kondisi', ['baik', 'rusakRingan', 'rusakBerat'])->default('baik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian_asets');
    }
};
