<?php

namespace App\Http\Controllers;

use App\Models\foto;
use App\Models\User;
use App\Models\album;
use Illuminate\Http\Request;

class UploadFotoController extends Controller
{
    //untuk menampilkan halaman upload foto
    public function upload(Request $request)
    {
         // Mengambil semua data album dari database
        $data = [
            'data_album'     => album::all()
        ];
         // Mengembalikan view 'pages.upload' dengan data album yang telah diambil
        return view('pages.upload', $data);
    }

    public function upload_foto()
    {
         // Mengambil daftar album yang dimiliki oleh user yang sedang login.
        $album = album::with('user')->where('user_id', auth()->user()->id)->get();
        // Mengembalikan view 'pages.upload' dan menyertakan data album ke dalamnya.
        return view('pages.upload', compact('album'));
    }

    //proses unggah foto
    public function unggah_foto(Request $request)
    {
        $namafile   = pathinfo($request->file, PATHINFO_FILENAME);
        $extensi    = $request->filefoto->getClientOriginalExtension();
        // Membuat nama file unik dengan menambahkan timestamp.
        $namafoto   = 'unggah' . time() . '.' . $extensi;
        // Memindahkan file yang diunggah ke direktori 'unggah' dengan nama yang baru dibuat.
        $request->filefoto->move('unggah', $namafoto);
        //simpan
        $datasimpan = [
            'user_id' => auth()->User()->id,
            'judul_foto' => $request->judul_foto,
            'deskripsi_foto' => $request->deskripsi_foto,
            'lokasi_file'   => $namafoto,
            'album_id' => $request->nama_album,

        ];
        // Menyimpan data foto ke dalam tabel 'foto'.
        foto::create($datasimpan);
        // Mengarahkan user kembali ke halaman home setelah proses unggah selesai.
        return redirect('/home');
    }

    //proses tambah album
    public function tambah_album(Request $request)
    {
        //simpan
        if ($request->album_id == 0) {
            $tambahalbum = [
                'user_id' => auth()->User()->id,
                'nama_album' => $request->nama_album,
            ];
        }
        // Jika album yang dipilih memiliki ID 0, maka tambahkan album baru
        album::create($tambahalbum);
         // Mengarahkan user kembali ke halaman upload setelah proses penambahan album selesai
        return redirect('/upload');
    }

    //Untuk menampilkan detail album berdasarkan ID album yang diberikan.
    public function show($id)
    {
         // Mengambil data album berdasarkan ID, serta menyertakan relasi dengan foto-foto yang terkait
        $album = album::with('foto')->findOrFail($id);
        return view('pages.detail_album', compact('album'));
    }

    //Untuk mengambil postingan (foto) yang diposting oleh user yang sedang login.
    public function getdatapostingan(Request $request)
    {
        $postinganuserid = auth()->user()->id;
        $explore = foto::with(['like', 'album', 'users'])->withCount(['like', 'komentar'])->whereHas('users', function ($query) use ($postinganuserid) {
            $query->where('user_id', $postinganuserid);
        })->paginate(4);
        return response()->json([
            'data' => $explore,
            'statuscode' => 200,
            'idUser'    => auth()->user()->id
        ]);
    }

    //getDataAlbum -- bertujuan untuk mengambil dan menampilkan data foto yang diposting oleh user yang sedang login dan terkait dengan sebuah album.
    public function getdataalbum(Request $request)
    {
        $postinganuserid = auth()->user()->id;
        $explore = foto::with(['like', 'album', 'users'])->withCount(['like', 'komentar'])->whereHas('users', function ($query) use ($postinganuserid) {
            $query->where('user_id', $postinganuserid);
        })->where('album_id', '!=', null)->paginate();
        return response()->json([
            'data' => $explore,
            'statuscode' => 200,
            'idUser'    => auth()->user()->id
        ]);
    }


}
