<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('Nama Makanan'); // Nama makanan
            $table->string('Foto'); // Foto makanan
            $table->decimal('Harga', 10, 2); // Harga makanan
            $table->integer('Pesanan')->default(1); // Jumlah makanan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
