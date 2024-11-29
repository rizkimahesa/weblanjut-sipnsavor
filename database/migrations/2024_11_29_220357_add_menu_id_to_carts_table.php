<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('carts', function (Blueprint $table) {
        $table->unsignedBigInteger('menu_id')->after('id');  // Menambahkan kolom menu_id
        $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade'); // Menambahkan foreign key
    });
}

public function down()
{
    Schema::table('carts', function (Blueprint $table) {
        $table->dropForeign(['menu_id']);  // Menghapus foreign key jika rollback
        $table->dropColumn('menu_id');  // Menghapus kolom menu_id
    });
}
};
