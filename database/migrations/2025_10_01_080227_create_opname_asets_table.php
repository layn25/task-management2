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
        Schema::create('opname_asets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('aset_id')->references('id')->on('asets');
            $table->text('deskripsi')->nullable();
            $table->enum('kondisi', ['baik', 'rusakRingan', 'rusakBerat'])->default('baik');
            $table->dateTime('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opname_asets');
    }
};
