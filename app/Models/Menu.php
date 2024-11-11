<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Define fillable attributes to prevent mass assignment errors
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'foto',
    ];
}
