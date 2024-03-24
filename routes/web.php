<?php

use App\Http\Controllers\admin\JadwalController as AdminJadwalController;
use App\Http\Controllers\admin\KelasController as AdminKelasController;
use App\Http\Controllers\admin\MataPelajaranController as AdminMapelController;
use App\Http\Controllers\admin\ProfileController as AdminProfileController;
use App\Http\Controllers\admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\admin\UserController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProfileController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PresensiSiswaController;

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

// Routing untuk Guest/tamu (pertama kali masuk website)
Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('home', ['title' => 'SMAN 4 Metro']);
    });

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);


    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store']);
});

// All Role
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout']);
});

// Routing untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/profile-admin', [AdminProfileController::class,'index']);
    Route::put('/profile-admin',[AdminProfileController::class ,'update']);

    Route::resource('/dashboard/mapel', AdminMapelController::class);
    Route::resource('/dashboard/kelas', AdminKelasController::class);
    Route::resource('/dashboard/jadwal', AdminJadwalController::class);
    Route::resource('/dashboard/siswa', AdminSiswaController::class);

    Route::resource('/dashboard/user', UserController::class);
});


// Routing untuk guru
Route::middleware(['auth', 'role:guru'])->group(function () {

    Route::resource('/dashboard/profile', DashboardProfileController::class)->only([
        'index', 'update'
    ]);

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::put('/profile', [ProfileController::class, 'update']);

    Route::get('/presensi', [PresensiController::class, 'index']);
    Route::resource('/presensi/presensi-siswa', PresensiSiswaController::class)->except('show');
    Route::post('/store', [KehadiranController::class, 'store'])->name('store');
    Route::get('/presensi/presensi-siswa/{id}', [PresensiSiswaController::class, 'index'])
        ->name('presensi-siswa.index');

    Route::put('/presensi/presensi-siswa/{id}', [PresensiSiswaController::class, 'update'])
        ->name('presensi-siswa.update');

    Route::get('/presensi/export/{id}', [PresensiSiswaController::class, 'export'])
        ->name('export-kehadiran');

});