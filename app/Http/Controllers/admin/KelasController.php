<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KelasRequest;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::get();

        $data = [
            'data_kelas' => $kelas,
            'title'      => 'Daftar Kelas'
        ];

        return view('daftar-kelas-pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'wali_kelas' => User::where('role','guru')->get(),
            'title'      => 'Tambah Kelas'
        ];

        return view('daftar-kelas-pages.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KelasRequest $request)
    {
        $data = $request->validated();

        $kelas = new Kelas($data);
        $kelas->wali_kelas_id = $data['wali_kelas_id'];

        $kelas->save();

        return to_route('kelas.index')->with('success','Berhasil menambahkan kelas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kela)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kela)
    {
        $data = [
            'kelas' => $kela,
            'wali_kelas' => User::where('role','guru')->get(),
            'title'   => 'Ubah Data Kelas'
        ];

        return view('daftar-kelas-pages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KelasRequest $request, Kelas $kela)
    {
        $data =$request->validated();

        $kela->update($data);

        return to_route('kelas.index')->with('success','Berhasil mengubah data kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect()->route('kelas.index')->with('success', 'Berhasil menghapus data kelas');
    }
}
