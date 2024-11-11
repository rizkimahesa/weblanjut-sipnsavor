<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom yang tidak diperlukan
            $table->dropColumn(['email_verified_at', 'remember_token', 'created_at', 'updated_at']);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Jika rollback, kita tambahkan kembali kolom yang dihapus
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps(); // Untuk created_at dan updated_at
        });
    }
}
