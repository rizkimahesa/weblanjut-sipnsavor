<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Define the fillable attributes to avoid mass-assignment errors
    protected $fillable = ['user_id', 'menu_id', 'nama', 'harga', 'Pesanan', 'foto'];
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id'); // Pastikan 'menu_id' adalah kolom relasi yang ada di Cart
    }
    public function items()
    {
        return $this->hasMany(CartItem::class); // Pastikan menggunakan nama relasi yang sesuai
    }

    public function getItems()
    {
        return $this->items; // Mengambil semua item dari cart
    }
}
