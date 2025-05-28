<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tamu', function (Blueprint $table) {
            $table->unsignedTinyInteger('rating')->nullable(); // Menambahkan kolom rating
        });
    }

    public function down(): void
    {
        Schema::table('tamu', function (Blueprint $table) {
            $table->dropColumn('rating');
        });
    }
};