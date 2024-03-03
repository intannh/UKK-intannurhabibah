<?php

namespace App\Http\Controllers;

use App\Models\foto;
use App\Models\User;
use App\Models\album;
use App\Models\follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //untuk menampilkan halaman profile user
    public function profile(Request $request)
    {
        // Mengambil data user yang sedang login
        $user = auth()->user();
        // Mengambil daftar album beserta foto-foto yang dimiliki oleh user yang sedang login
        $tampilAlbum = album::with('foto')->where('user_id', auth()->user()->id)->get();
        // Menghitung jumlah pengikut user yang sedang login
        $userFollowers = DB::table('follow')->where('id_following', $user->id)->count();
        // Menghitung jumlah user yang diikuti oleh user yang sedang login
        $dataFollowCount = DB::table('follow')->where('user_id', $user->id)->count();

        return view('pages.profile', compact('tampilAlbum','userFollowers','dataFollowCount'));
    }

    //untuk menampilkan halaman edit profile user
    public function ubahprofile(Request $request)
    {
        // Mengambil data user pengguna yang sedang login
        $data = [
            'dataprofile' => User::where('id', auth()->user()->id)->first()
        ];
        return view('pages.edit_profile', $data);
    }

    //edit data profile user
    public function updateProfile(Request $request)
    {
        $dataUpdate = [
            'nama_lengkap'  => $request->nama_lengkap,
            'username'      => $request->username,
            'email'         => $request->email,
            'no_telepon'    => $request->no_telepon,
            'alamat'        => $request->alamat,
            'bio'           => $request->bio
        ];
        //proses Update data
        User::where('id', auth()->user()->id)->update($dataUpdate);
        return redirect('/edit_profile');
    }

    //edit foto profile user
    public function fotoprofil(Request $request)
    {
        $namafile   = pathinfo($request->file, PATHINFO_FILENAME);
        $extensi    = $request->file->getClientOriginalExtension();
        $namafoto   = 'unggah' . time() . '.' . $extensi;
        $request->file->move('unggah', $namafoto);
        //data
        $dataupdate = [
            'pictures'  => $namafoto,
        ];
        //proses update
        User::where('id', auth()->user()->id)->update($dataupdate);
        return redirect('/edit_profile');
    }

    //untuk menampilkan halaman edit password user
    public function ubahpassword()
    {
        return view('pages.edit_password');
    }

    //proses update passowrd
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = Auth::user();
        // Memeriksa apakah kata sandi lama yang dimasukkan sesuai dengan kata sandi yang tersimpan dalam database
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }
        // Memperbarui kata sandi user dengan kata sandi baru yang dimasukkan
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah ');
    }

    //data unggahan user
    public function getdatapostingan(Request $request)
    {
        // Mendapatkan ID user yang sedang login
        $postinganuserid = auth()->user()->id;
        // Mengambil postingan (foto) yang diposting oleh user yang sedang login
        $explore = foto::with(['like', 'album', 'users'])->withCount(['like', 'komentar'])->whereHas('users', function ($query) use ($postinganuserid) {
            $query->where('user_id', $postinganuserid);
        })->paginate(0);
        return response()->json([
            'data' => $explore,
            'statuscode' => 200,
            'idUser'    => auth()->user()->id
        ]);
    }

    
    ///data liked user
    public function getdataliked(Request $request)
    {
        // Mendapatkan ID user yang sedang login
        $postinganuserid = auth()->user()->id;
        // Mengambil postingan (foto) yang disukai oleh user yang sedang login
        $explore = foto::with(['like', 'album', 'users'])->withCount(['like', 'komentar'])->whereHas('like', function ($query) use ($postinganuserid) {
            $query->where('user_id', $postinganuserid);
        })->paginate();
        return response()->json([
            'data' => $explore,
            'statuscode' => 200,
            'idUser'    => auth()->user()->id
        ]);
    }

    //hapus foto
    public function deletefoto(Request $request, $id)
    {
        try {
            // Cari data foto berdasarkan ID
            $foto = foto::findOrFail($id);
            // Hapus data komentar yang terkait dengan foto
            $foto->komentar()->delete();
            // Hapus data suka yang terkait dengan foto
            $foto->like()->delete();
             // Hapus file yang terkait dengan foto
            $filePath = ('unggah/' . $foto->lokasi_file); // Sesuaikan dengan struktur direktori yang sesuai

            // Periksa apakah file tersebut ada
            if (File::exists($filePath)) {
                // Hapus file jika ada
                File::delete($filePath);
            }

            // Hapus data foto
            $foto->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus foto dan data terkait.'], 500);
        }
    }

}
