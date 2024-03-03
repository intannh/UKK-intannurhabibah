<?php

namespace App\Http\Controllers;

use App\Models\foto;
use App\Models\like;
use App\Models\follow;
use App\Models\komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExploreController extends Controller
{

    //data Explore
    public function getdata(Request $request)
    {
        if ($request->cari !== 'null') {
            $explore = foto::with(['like', 'album', 'users'])->withCount(['like', 'komentar'])->where('judul_foto', 'like', '%' . $request->cari . '%')->orderBy('id', 'desc')->paginate();
        } else {
            $explore = foto::with(['like', 'album', 'users'])->withCount(['like', 'komentar'])->paginate(0);
        }

        return response()->json([
            'data'           => $explore,
            'statuscode'     => 200,
            'idUser'         => auth()->user()->id
        ]);
    }

    //like foto
    public function like(Request $request)
    {
        try {
            $request->validate([
                'idfoto' => 'required'
            ]);

            // Mencari apakah pengguna sudah menyukai foto ini sebelumnya
            $existingLike = like::where('foto_id', $request->idfoto)->where('user_id', auth()->user()->id)->first();
            if (!$existingLike) {
                // Jika pengguna belum menyukai foto ini sebelumnya, buat data like baru
                $dataSimpan = [
                    'foto_id'   => $request->idfoto,
                    'user_id'   => auth()->user()->id
                ];
                like::create($dataSimpan);
            } else {
                // Jika pengguna sudah menyukai foto ini sebelumnya, hapus like
                like::where('foto_id', $request->idfoto)->where('user_id', auth()->user()->id)->delete();
            }

            return response()->json('Data Berhasil di simpan', 200);
        } catch (\Throwable $th) {
            return response()->json('Something went worng', 500);
        }
    }

    //tampilan explore-detail
    public function explore_detail($id)
    {
        return view('pages.explore_detail', [
            // Mengambil data foto berdasarkan ID yang diberikan
            'foto' => foto::whereId($id)->first(),

        ]);
    }

    //data detail explore
    public function getdatadetail(Request $request, $id)
    {
        // Mengambil detail foto berdasarkan ID yang diberikan, termasuk informasi pengguna dan album terkait
        $dataDetailFoto     = foto::with(['users', 'album'])->where('id', $id)->firstOrFail();
        // Menghitung jumlah pengikut (followers) dari pemilik foto
        $dataJumlahPengikut = DB::table('follow')->selectRaw('count(id_following) as jmlfolow')->where('id_following', $dataDetailFoto->users->id)->first();
        // Memeriksa apakah pengguna saat ini mengikuti pemilik foto
        $dataFollow         = follow::where('id_following', $dataDetailFoto->users->id)->where('user_id', auth()->user()->id)->first();
        return response()->json([
            'dataDetailFoto'    => $dataDetailFoto, // Detail foto yang telah diambil
            'dataJumlahFollow'  => $dataJumlahPengikut, // Jumlah pengikut dari pemilik foto
            'dataUser'          => auth()->user()->id, // ID pengguna saat ini
            'dataFollow'        => $dataFollow, // Informasi apakah pengguna saat ini mengikuti pemilik foto
        ], 200);
    }

    //menampilkan Komentar
    public function ambildatakomentar(Request $request, $id)
    {
        // Mengambil semua komentar yang terkait dengan foto berdasarkan ID foto, termasuk informasi pengguna yang melakukan komentar
        $ambilkomentar = komentar::with('users')->orderBy('id', 'DESC')->where('foto_id', $id)->get();
        // Mengembalikan respons JSON berisi data komentar yang telah diambil
        return response()->json([
            'data'  => $ambilkomentar,
        ], 200);
    }

    //kirim komentar
    public function kirimkomentar(Request $request)
    {
        try {
            $request->validate([
                'idfoto'   => 'required',
                'isi_komentar'  => 'required',
            ]);
            $dataStoreKomentar = [
                'user_id'  => auth()->user()->id, // ID pengguna yang melakukan komentar
                'foto_id'   => $request->idfoto, // ID foto yang dikomentari
                'isi_komentar'  => $request->isi_komentar, // Isi komentar yang dikirimkan oleh pengguna
            ];
            // Simpan data komentar ke dalam tabel komentar
            komentar::create($dataStoreKomentar);
            return response()->json([
                'data'      => 'Data berhasil di simpan',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json('Data komentar gagal di simpann', 500);
        }
    }

    //follow user melalui tampilan explore detail
    public function ikuti(Request $request)
    {
        try {
            $request->validate([
                'idfollow' => 'required'
            ]);
            //Mencari apakah pengguna sudah mengikuti pengguna yang dituju sebelumnya
            $existingFollow = follow::where('user_id', auth()->user()->id)->where('id_following', $request->idfollow)->first();
            if (!$existingFollow) {
                // Jika pengguna belum mengikuti pengguna yang dituju sebelumnya, buat entri follow baru
                $dataSimpan = [
                    'user_id'   => auth()->user()->id,
                    'id_following'  => $request->idfollow
                ];
                follow::create($dataSimpan);
            } else {
                // Jika pengguna sudah mengikuti pengguna yang dituju sebelumnya, hapus entri follow
                follow::where('user_id', auth()->user()->id)->where('id_following', $request->idfollow)->delete();
            }
            return response()->json('Data berhasil di eksekusi', 200);
        } catch (\Throwable $th) {
            return response()->json('something went wrong', 500);
        }
    }
}
