<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        return view('jadwal.jadwal', [
            'title' => 'SMAN 4 Metro',
        ]);
    }
}
