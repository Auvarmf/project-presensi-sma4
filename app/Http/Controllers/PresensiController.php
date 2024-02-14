<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function index()
    {
        // Mengambil semua data siswa dari tabel siswa
        $siswaData = Siswa::all();

        $qrCode = null; // Inisialisasi variabel qrCode dengan nilai null

        // Memastikan bahwa pengguna sudah login
        if (Auth::check()) {
            // Mengambil data pengguna yang login
            $user = Auth::user();
            
            // Asumsi ingin menampilkan nama pengguna dalam QR Code
            $username = $user->npm; 
            
            // Membuat QR Code
            $qrCode = QrCode::size(300)->generate("{$username}");
        }

        // Mengembalikan view dengan data siswa dan QR Code (jika ada)
        return view('presensi.index', [
            'title' => 'SMAN 4 Metro',
            'siswaData' => $siswaData,
            'qrCode' => $qrCode, // Kirim QR code ke view
        ]);
    }
}
