<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\OtherProfileController;
use App\Http\Controllers\PengikutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadFotoController;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//menampilkan halaman index
Route::get('/', function () {
    return view('pages.index');
});
//menampilkan halaman register
Route::get('/register', [AuthController::class, 'register']);
//proses register
Route::post('/registered', [AuthController::class, 'registered']);
//menampilkan halaman login
Route::get('/login', function () {
    return view('pages.login');
})->name('login');
//proses login
Route::post('/auth', [AuthController::class, 'auth']);

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('pages.home');
    });

    //EXPLORE

    //data Explore
    Route::get('/getDataExplore', [ExploreController::class, 'getdata']);
    //like foto
    Route::post('/like', [ExploreController::class, 'like']);

    //EXPLORE DETAIL

    //tampilan explore-detail
    Route::get('/explore_detail/{id}', [ExploreController::class, 'explore_detail']);
    //data detail explore
    Route::get('/explore_detail/{id}/getdatadetail', [ExploreController::class, 'getdatadetail']);
    //Menampilkan Komentar
    Route::get('/explore_detail/getkomen/{id}', [ExploreController::class, 'ambildatakomentar']);
    //kirim komentar
    Route::post('/explore_detail/kirimkomentar', [ExploreController::class, 'kirimkomentar']);
    //follow user melalui tampilan explore detail
    Route::post('/explore_detail/ikuti', [ExploreController::class, 'ikuti']);

    //UPLOAD FOTO

    //untuk menampilkan halaman upload foto
    Route::get('/upload', [UploadFotoController::class, 'upload']);
    Route::get('/upload_foto', [UploadFotoController::class, 'upload_foto']);
    //proses unggah foto
    Route::post('/unggah_foto', [UploadFotoController::class, 'unggah_foto']);
    //untuk menampilkan halaman tambah album
    Route::get('/tambah_album', function () {
        return view('pages.tambah_album');
    });
    //proses tambah album
    Route::post('/tambah_album', [UploadFotoController::class, 'tambah_album']);
     //Untuk menampilkan detail album berdasarkan ID album yang diberikan.
    Route::get('/detail_album/{id}', [UploadFotoController::class, 'show'])->name('detail_album.show');

    //PROFILE USER

    //untuk menampilkan halaman profile user
    Route::get('/profile', [ProfileController::class, 'profile']);
    //untuk menampilkan halaman edit profile user
    Route::get('/edit_profile', [ProfileController::class, 'ubahprofile']);
    //edit data profile user
    Route::post('/updateprofile', [ProfileController::class, 'updateProfile']);
    //edit foto profile user
    Route::post('/ubahprofil', [ProfileController::class, 'fotoprofil']);
    //untuk menampilkan halaman edit password user
    Route::get('/ubahpassword', [ProfileController::class, 'ubahPassword']);
    //proses update password
    Route::post('/updatepassword', [ProfileController::class, 'updatePassword']);
    //data unggahan user
    Route::get('/getDataPostingan', [ProfileController::class, 'getdatapostingan']);
    //data liked user
    Route::get('/getDataLiked', [ProfileController::class, 'getdataliked']);
    //hapus foto
    Route::delete('/deletefoto/{id}', [ProfileController::class, 'deletefoto']);

    //OTHER PROFILE

    //untuk menampilkan halamaan profil public
    Route::get('/other_profile/{id}', [OtherProfileController::class, 'profil_public']);
    //otherprofile.js
    Route::get('/other_profile/getProfilePublic/{id}', [OtherProfileController::class, 'getProfilePublic'])->name('getProfilePublic');
    //data unggahan public
    Route::get('/getDataPublic/{id}', [OtherProfileController::class, 'getdatapublic']);
    //data liked public
    Route::get('/getDataLikedPublic/{id}', [OtherProfileController::class, 'getdatalikedpublic']);

    //proses logout
    Route::get('/logout', [AuthController::class, 'logout']);

});

