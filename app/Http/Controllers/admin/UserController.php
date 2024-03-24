<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::whereIn('role', ['guru', 'siswa'])->get();
        $data = [
            'data_user' => $user,
            'title' => 'Daftar Akun',
        ];

        return view('daftar-akun-pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Akun',
        ];
        return view('daftar-akun-pages.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        // Simpan data user
        $data['password'] = bcrypt($data['password']);
        $user = new User($data);
        $user->save();

        return redirect()->route('user.index')->with('success','Berhasil menambahkan akun');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = [
            'title' => 'Ubah Data Akun',
            'user' => $user
        ];

        return view('daftar-akun-pages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Berhasil mengubah data akun');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Berhasil menghapus akun');
    }
}
