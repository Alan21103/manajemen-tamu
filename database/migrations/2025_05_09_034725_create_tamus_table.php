<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tamu', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tanggal')->nullable();
            $table->string('instansi')->nullable();
            $table->string('no_telepon')->nullable();
            $table->text('tujuan_kunjungan');
            $table->string('bidang')->nullable();
            $table->timestamps(); 

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamus');
    }
};
