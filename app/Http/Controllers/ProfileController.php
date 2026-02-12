<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $fileName);

            $user->photo = $fileName;
        }

        $user->save();

        return back()->with('success', 'Profile berhasil diperbarui.');
    }
}
