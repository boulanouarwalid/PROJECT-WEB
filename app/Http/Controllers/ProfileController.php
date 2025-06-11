<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Show profile page
    public function showprofilcoord()
    {
        return view('coordinateur.profil');
    }

    // (Optional) Edit form
    public function edit()
    {
        return view('coordinateur.partiels.profil-edit');
    }

    // (Optional) Handle update
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
            // Add other fields here as needed
        ]);

        $user->update($data);

        return redirect()->route('profile.show')->with('success', 'Profil mis à jour.');
    }
}
