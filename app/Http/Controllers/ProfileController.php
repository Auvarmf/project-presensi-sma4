<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index()
    {
        // Dapatkan pengguna yang sedang login (guru)
        $user = auth()->user();

        // Dapatkan mata pelajaran yang terkait dengan guru
        $subjects = $user->subjects;

        return view('dashboard.profile.index', [
            'title' => 'SMAN 4 Metro',
            'subjects' => $subjects,
        ]);
    }


    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|file|max:1024',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        $user = User::find($validatedData['user_id']);

        // Delete existing profile image if it exists
        if ($user->image) {
            Storage::delete($user->image);
        }

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('profile-image');
        }

        $user->update($validatedData);

        return redirect('/profile')->with('success', 'Profile berhasil diupdate!');
    }
}