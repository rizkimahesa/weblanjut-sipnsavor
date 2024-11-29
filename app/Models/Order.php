<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders'; // Pastikan nama tabel sudah benar

    protected $fillable = [
        'user_id',
        'menu_id',
        'quantity',
        'total_price',
    ];

    

    public function menu()
{
    return $this->belongsTo(Menu::class, 'menu_id'); // Relasi dengan tabel menus
}

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // 'user_id' merujuk ke id di tabel users
    }
}
