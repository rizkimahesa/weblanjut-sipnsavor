<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom no_hp
            $table->string('no_hp', 15)->nullable()->after('password');  // Sesuaikan panjang sesuai kebutuhan

            // Menghapus kolom yang tidak diperlukan (contoh kolom yang tidak diperlukan)
            // $table->dropColumn('column_name'); // Jika ada kolom yang tidak diperlukan
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom no_hp jika rollback
            $table->dropColumn('no_hp');

            // Menambahkan kembali kolom yang dihapus jika diperlukan
            // $table->string('column_name');
        });
    }
}
