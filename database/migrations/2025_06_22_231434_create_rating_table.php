<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel data_tamu
            $table->unsignedBigInteger('tamu_id');
            $table->foreign('tamu_id')->references('id')->on('tamu')->onDelete('cascade');

            // Nilai rating dan komentar
            $table->tinyInteger('nilai')->comment('Rating 1-5');
            $table->text('komentar')->nullable();

            // Tanggal pengisian rating
            $table->timestamp('diisi_pada')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rating');
    }
};