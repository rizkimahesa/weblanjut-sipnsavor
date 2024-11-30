<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesan'; // Pastikan ini mengarah ke tabel yang benar

    protected $fillable = ['user_id', 'message'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
