<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\foto;
use App\Models\like;
use App\Models\album;
use App\Models\follow;
use App\Models\komentar;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nama_lengkap',
        'no_telepon',
        'email',
        'alamat',
        'bio',
        'status_user',
        'pictures',
        'password',
    ];

    //untuk konek ke tabel
    protected $table = 'users';

    //untuk konek ke foto 1 to m
    public function foto(){
        return $this->hasMany(foto::class,'user_id','id');
    }

    //untuk konek ke like 1 to 1
    public function like(){
        return $this->hasOne(like::class,'user_id','id');
    }

    //untuk konek ke komentar 1 to m
    public function komentar(){
        return $this->hasMany(komentar::class,'user_id','id');
    }

    //untuk konek ke album 1to m
    public function album(){
        return $this->hasMany(album::class,'user_id','id');
    }

    //relasi kedalam tabel follow 1 to 1
    public function follow(){
        return $this->hasMany(follow::class,'user_id','id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
