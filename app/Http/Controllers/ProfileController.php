<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index', [
            'title' => 'SMAN 4 Metro'
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|file|max:1024',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('profile-image');
        }

        $validatedData['user_id'] = auth()->user()->id;

        $user = User::find($validatedData['user_id']);
        $user->update($validatedData);

        return to_route('profile-guru')->with('success', 'Profile berhasil diupdate!');
    }
}
