<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    //menampilkan halaman register
    public function register(Request $request)
    {
        return view('pages.register');
    }

    //proses register
    public function registered(Request $request)
    {
        // Pesan validasi untuk umpan balik yang lebih deskriptif kepada pengguna
        $messages = [
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
        ];

        // Membuat profil otomatis
        $newProfile = 'users.png'; // Nama file gambar profil default

        // Validasi input pengguna
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'email' => 'required|unique:users,email',
        ], $messages);

        // Simpan data pengguna baru
        $dataStore = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'pictures' => $newProfile,
        ];

        // Salin profil default ke direktori penyimpanan pengguna baru
        $defaultProfilePath = public_path('unggah/'.$newProfile);
        copy(public_path('assets/users.png'),$defaultProfilePath);
        // Simpan data pengguna baru dalam basis data
        User::create($dataStore,$newProfile);
        return redirect('/login')->with('success', 'Data berhasil disimpan');
    }

    //log in
    public function auth(Request $request)
    {
         // Validate input pengguna
        $request->validate([
            'email' => ['required', 'email'],
            'password'  => ['required'],
        ]);

        // Proses log in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
             // Jika autentikasi berhasil, regenerasi sesi pengguna dan arahkan ke halaman home
            $request->session()->regenerate();
            return redirect('/home');
        } else {
            // Jika autentikasi gagal, lempar ValidationException dengan pesan kesalahan
            throw ValidationException::withMessages([
                'email' => 'Email atau Password Anda Salah',
                // 'password'  => 'Password Anda Salah',
            ]);
        }
    }

    //proses logout
    public function logout(Request $request)
    {
        // Mencabut keberlakuan sesi pengguna, sehingga pengguna tidak lagi dianggap login
        $request->session()->invalidate();
         // Me-generate kembali ID sesi baru untuk mencegah serangan penyalahgunaan sesi
        $request->session()->regenerate();
        // Mengarahkan pengguna kembali ke halaman utama setelah logout
        return redirect('/');
    }
}
