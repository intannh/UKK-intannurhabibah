<?php

namespace App\Models;

use App\Models\foto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class album extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_album',
        'user_id',
    ];

    //untuk konek ke tabel
    protected $table = 'album';

    //untuk umpan balik ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //untuk konek ke tabel foto
    public function foto()
    {
        return $this->hasMany(foto::class, 'album_id', 'id');
    }
}
