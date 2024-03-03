<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'id_following',
    ];

     //untuk konek ke tabel follow
     protected $table = 'follow';

     //relasi nilai balik ke tabel user
     public function users(){
         return $this->belongsTo(User::class,'user_id','id');
     }
}
