<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::get();

        return view('dashboard.profile.index', [
            'title' => 'SMAN 4 Metro',
            'subjects' => $jadwal,
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

        return redirect('/profile-guru')->with('success', 'Profile berhasil diupdate!');
    }
}