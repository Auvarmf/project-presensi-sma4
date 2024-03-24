<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalRequest;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::get();

        $data = [
            'data_jadwal'  => $jadwal,
            'title'   => 'Daftar Jadwal'
        ];

        return view('daftar-jadwal-pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'data_kelas'    => Siswa::get(),
            'data_mapel'    => MataPelajaran::get(),
            'guru_pengajar' => User::where('role','guru')->get(),
            'title' => 'Tambah Jadwal',
        ];

        return view('daftar-jadwal-pages.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JadwalRequest $request)
    {
        $data = $request->validated();

        $jadwal = new Jadwal($data);
        $jadwal->id_kelas = $data['id_kelas'];
        $jadwal->id_mapel = $data['id_mapel'];
        $jadwal->id_guru = $data['id_guru'];

        $jadwal->save();

        return to_route('jadwal.index')->with('success','Berhasil menambahkan jadwal');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        $data = [
            'data_kelas'    => Siswa::get(),
            'data_mapel'    => MataPelajaran::get(),
            'guru_pengajar' => User::where('role','guru')->get(),
            'jadwal'        => $jadwal,
            'title'         => 'Ubah Data Jadwal',
        ];

        return view('daftar-jadwal-pages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JadwalRequest $request, Jadwal $jadwal)
    {
        $data = $request->validated();

    // Update atribut pada model dengan data yang baru
    $jadwal->id_kelas = $data['id_kelas'];
    $jadwal->id_mapel = $data['id_mapel'];
    $jadwal->id_guru = $data['id_guru'];
    $jadwal->hari = $data['hari'];
    $jadwal->waktu_mulai = $data['waktu_mulai'];
    $jadwal->waktu_selesai = $data['waktu_selesai'];

    // Simpan perubahan ke dalam database
    $jadwal->save();

    return redirect()->route('jadwal.index')->with('success', 'Berhasil mengubah data jadwal');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return to_route('jadwal.index')->with('success', 'Berhasil menghapus data jadwal');
    }
}