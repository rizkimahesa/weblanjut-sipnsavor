<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Define the fillable attributes to avoid mass-assignment errors
    protected $fillable = [
        'id',  // Assuming you have a user_id field to associate with users
        'nama',
        'foto',
        'harga',
        'Pesanan',
        'user_id',
    ];
}
