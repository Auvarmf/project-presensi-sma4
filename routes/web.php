<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProfileController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\JadwalController;


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

Route::get('/', function () {
    return view('home', [
        'title' => 'SMAN 4 Metro',
    ]);
})->middleware('guest');

// Route::get('/mahasiswa', function () {
//     return view('home-user', [
//         'title' => 'CNN | Mahasiswa',
//         'subtitle' => 'Mahasiswa',
//         'name' => 'Auvar Mahsa Fahlevi',
//         'npm' => '2117051027',
//         'role' => 'Mahasiswa',
//         'jurusan' => 'Ilmu Komputer',
//         'prodi' => 'S1 Ilmu Komputer'
//     ]);
// });

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


Route::resource('/dashboard/profile', DashboardProfileController::class)->middleware('auth');

Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth');

Route::get('/presensi', [PresensiController::class, 'index'])->middleware('auth');
Route::get('/jadwal', [JadwalController::class, 'index'])->middleware('auth');
