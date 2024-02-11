<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MataPelajaranRequest;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matapelajaran = MataPelajaran::get();
        $data = [
            'mata_pelajaran' => $matapelajaran,
            'title' => 'Daftar Mata Pelajaran',
        ];

        return view('daftar-mapel-pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Mata Pelajaran',
        ];
        return view('daftar-mapel-pages.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MataPelajaranRequest $request)
    {
        $data = $request->validated();

        $matapelajaran = new MataPelajaran($data);

        $matapelajaran->save();

        return to_route('mapel.index')->with('success','Berhasil menambahkan mata pelajaran');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataPelajaran $mataPelajaran)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataPelajaran $mapel)
    {
        $data = [
            'matapelajaran' => $mapel,
            'title' => 'Ubah Data Mata pelajaran',
        ];

        return view('daftar-mapel-pages.edit', $data);

        // dd($mapel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MataPelajaranRequest $request, MataPelajaran $mapel)
    {
        $data =$request->validated();

        $mapel->update($data);

        return to_route('mapel.index')->with('success','Berhasil mengubah data mata pelajaran');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataPelajaran $mapel)
    {
        $mapel->delete();

        return to_route('mapel.index')->with('success','Berhasil menghapus mata pelajaran');
    }
}
