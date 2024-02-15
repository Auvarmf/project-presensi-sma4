<?php

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('home', ['title' => 'SMAN 4 Metro']);
    });

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);


    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::resource('/dashboard/profile', DashboardProfileController::class)->only([
        'index', 'update'
    ]);

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::put('/profile', [ProfileController::class, 'update']);

    Route::get('/presensi', [PresensiController::class, 'index']);
    Route::resource('/presensi/presensi-siswa', PresensiSiswaController::class)->except('show');
    Route::post('/store', [KehadiranController::class, 'store'])->name('store');
    Route::get('/presensi/presensi-siswa/{kode_mp}', [PresensiSiswaController::class, 'index'])
        ->name('presensi-siswa.index');

    Route::put('/presensi/presensi-siswa/{kode_mp}', [PresensiSiswaController::class, 'update'])
        ->name('presensi-siswa.update');

    Route::get('/presensi/export/{kode_mp}', [PresensiSiswaController::class, 'export'])
        ->name('export-kehadiran');
});