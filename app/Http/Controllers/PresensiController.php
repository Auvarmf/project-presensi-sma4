<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class PresensiController extends Controller
{
    public function index()
    {

        return view('presensi.index', [
            'title' => 'SMAN 4 Metro',
        ]);
    }
}
