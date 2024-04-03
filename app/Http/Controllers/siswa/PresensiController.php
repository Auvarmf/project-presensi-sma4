<?php

namespace App\Http\Controllers\siswa;

use Illuminate\Http\Request;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function index()
    {
        // Mengambil semua data siswa dari tabel siswa
        $userData = User::all();

        $qrCode = null; // Inisialisasi variabel qrCode dengan nilai null

        // Memastikan bahwa pengguna sudah login
        if (Auth::check()) {
            // Mengambil data pengguna yang login
            $user = Auth::user();
            
            // Asumsi ingin menampilkan nama pengguna dalam QR Code
            $nip = $user->nip; 
            
            // Membuat QR Code
            $qrCode = QrCode::size(300)->generate("{$nip}");
        }

        // Mengembalikan view dengan data siswa dan QR Code (jika ada)
        return view('presensi.siswa', [
            'title' => 'SMAN 4 Metro',
            'userData' => $userData,
            'qrCode' => $qrCode, // Kirim QR code ke view
        ]);
    }
}
