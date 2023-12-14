<?php

namespace App\Http\Controllers\Akun;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EditAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showProfile(User $user)
    {
        return view('akun.index', compact('user'));
    }
    public function editProfile()
    {
        $user = Auth::user();
        return view('akun.edit', compact('user'));
    }

    public function updateProfile(Request $request, User $user)
    {
        $user = Auth::user();

        // Validation logic (customize based on your requirements)
        $request->validate([
            'nama' => 'required',
            // Add more fields as needed
        ]);

        // Update user profile
        $user->update($request->all());

        return redirect()->route('akun.index')->with('success', 'Profile updated successfully.');
    }
}
