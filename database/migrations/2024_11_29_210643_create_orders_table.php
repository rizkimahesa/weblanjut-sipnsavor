<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Menghubungkan ke tabel users
        $table->foreignId('menu_id')->constrained()->onDelete('cascade');  // Menghubungkan ke tabel menus
        $table->integer('quantity');
        $table->decimal('total_price', 10, 2);  // Format angka dengan dua angka desimal
        $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');  // Status order
        $table->timestamps();
    });
    
    
    
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
