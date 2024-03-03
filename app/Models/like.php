<?php

namespace App\Models;

use App\Models\foto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class like extends Model
{
    use HasFactory;
    protected $fillable = [
        'foto_id',
        'user_id',
    ];

    //untuk konek ke tabel
    protected $table = 'like';

    //untuk umpan balik ke tabel user
    public function users(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    //untuk umpan balik ke tabel foto
    public function foto(){
        return $this->belongsTo(foto::class,'foto_id','id');
    }
}
