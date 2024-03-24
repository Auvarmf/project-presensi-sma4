<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaRequest;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::get();

        $data = [
            'data_siswa' => $siswa,
            'title'      => 'Daftar Siswa'
        ];

        return view('daftar-siswa-pages.index', $data);
    }

    public function create()
    {
        $data = [
            'siswas' => User::where('role','siswa')->get(),
            'title' => 'Tambah Siswa'
        ];

        return view('daftar-siswa-pages.create', $data);
    }

    public function store(SiswaRequest $request)
    {
        $data = $request->validated();

        $siswa = new Siswa($data);
        $siswa->nisn = $data['nisn'];

        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Berhasil menambahkan siswa');
    }

    public function edit(Siswa $siswa)
    {
        $data = [
            'siswa' => $siswa,
            'siswas' => User::where('role', 'siswa')->get(),
            'title' => 'Ubah Data Siswa'
        ];

        return view('daftar-siswa-pages.edit', $data);
    }

    public function update(SiswaRequest $request, Siswa $siswa)
    {
        $data = $request->validated();

        // Lakukan update data siswa
        $siswa->update($data);

        return redirect()->route('siswa.index')->with('success', 'Berhasil mengubah data siswa');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Berhasil menghapus data siswa');
    }
}
