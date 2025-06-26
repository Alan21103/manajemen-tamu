<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileImageToUsersTable extends Migration
{
    /**
     * Menjalankan migrasi untuk menambahkan kolom profile_image ke tabel users.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom 'profile_image' dengan tipe data string
            $table->string('profile_image')->nullable()->after('email');
        });
    }

    /**
     * Membatalkan migrasi untuk menghapus kolom profile_image dari tabel users.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom 'profile_image'
            $table->dropColumn('profile_image');
        });
    }
}
