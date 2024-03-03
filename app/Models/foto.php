<?php

namespace App\Models;

use App\Models\like;
use App\Models\User;
use App\Models\album;
use App\Models\komentar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class foto extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul_foto',
        'deskripsi_foto',
        'user_id',
        'album_id',
        'lokasi_file',
    ];

    //untuk konek ke tabel
    protected $table = 'foto';

    //untuk umpan balik ke tabel user
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //untuk konek ke like
    public function like()
    {
        return $this->hasMany(like::class, 'foto_id', 'id');
    }

    //untuk umpan balik ke tabel album
    public function album()
    {
        return $this->belongsTo(album::class, 'album_id');
    }

    //untuk konek ke komentar
    public function komentar()
    {
        return $this->hasMany(komentar::class, 'foto_id', 'id');
    }
}
