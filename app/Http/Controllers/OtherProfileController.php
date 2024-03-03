<?php

namespace App\Http\Controllers;

use App\Models\foto;
use App\Models\like;
use App\Models\User;
use App\Models\follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtherProfileController extends Controller
{
    //untuk menampilkan halamaan profil public
    public function profil_public($id)
    {
        // Mengambil data pengguna berdasarkan ID yang diberikan
        $user = User::find($id);
        // Mengembalikan view 'pages.other_profile' dengan data yang diperlukan untuk menampilkan profil pengguna lain
        return view('pages.other_profile', [
            'username' => $user->username, // Nama pengguna
            'pictures' => $user->pictures,
            'bio'   => $user->bio,
            'user_id'   => $id, // ID pengguna yang ditampilkan di profil
            'folowers_id' => follow::where('id_following', $id)->pluck('user_id')->toArray(),
        ]);
    }

    //otherprofile.js
    public function getProfilePublic(Request $request, $id)
    {
        // Mengambil data user berdasarkan ID
        $dataUser                 = User::where('id', $id)->first();
         // Menghitung jumlah pengikut dan yang diikuti oleh user
        $dataJumlahFollower       = DB::select('SELECT COUNT(user_id) as jmlfollower FROM follow where id_following = ' . $id);
        $dataJumlahFollowing      = DB::select('SELECT COUNT(id_following) as jmlfollowing FROM follow where user_id = ' . $id);
        // Memeriksa apakah user saat ini mengikuti user lain
        $dataFollow               = follow::where('id_following', $id)->where('user_id', auth()->user()->id)->first();

        // Menghitung jumlah pengikut dan yang diikuti oleh user lain
        $dataFollowers    = DB::select('SELECT COUNT(id_following) as jmlfollowers FROM follow where id_following=' . $id);
        $dataFollowing    = DB::select('SELECT COUNT(id_following) as jmlfollowers FROM follow where user_id=' . $id);
        return response()->json([
            'dataUser'              => $dataUser,

            'jumlahFollower'        => $dataJumlahFollower,
            'jumlahFollowing'       => $dataJumlahFollowing,

            'datafollowers'   => $dataFollowers,
            'datafollowing'   => $dataFollowing,

            'dataUserActive'        => auth()->user()->id,
            'dataFollow'            => $dataFollow
        ], 200);
    }

    //data unggahan public
    public function getdatapublic(Request $request, $id)
    {
        // Mendapatkan ID pengguna yang sedang login
        $publicuserid = auth()->user()->id;
        // Mengambil data foto publik dari user lain berdasarkan ID user tersebut
        $explore = foto::with(['like', 'album', 'users'])->withCount(['like', 'komentar'])->where('user_id', $id)->orderBy('id', 'desc')->paginate(4);
        return response()->json([
            'data' => $explore,
            'statuscode' => 200,
            'idUser'    => auth()->user()->id
        ]);
    }

    //data liked public
    public function getdatalikedpublic(Request $request, $id)
    {
        // Mendapatkan ID pengguna yang sedang login
        $likeduserid = auth()->user()->id;
        // Mengambil data foto publik yang disukai oleh user lain berdasarkan ID user tersebut
        $explore = foto::with(['like', 'album', 'users'])->withCount(['like', 'komentar'])->whereHas('like', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->paginate();
        return response()->json([
            'data' => $explore,
            'statuscode' => 200,
            'idUser'    => auth()->user()->id
        ]);
    }

}
