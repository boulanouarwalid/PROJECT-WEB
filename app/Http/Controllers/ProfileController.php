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
    public function editcoord()
    {
        return view('coordinateur.profil-edit');
    }

    // (Optional) Handle update
    public function updatecoord(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'Numeroteliphone' => 'nullable|string',
            'emailPersonelle' => 'nullable|email',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // Only update allowed fields
        $updateData = [
            'Numeroteliphone' => $data['Numeroteliphone'] ?? $user->Numeroteliphone,
            'emailPersonelle' => $data['emailPersonelle'] ?? $user->emailPersonelle,
        ];

        // Handle password change if requested
        if (!empty($data['new_password'])) {
            if (!\Hash::check($data['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
            }
            $updateData['password'] = bcrypt($data['new_password']);
        }

        $user->update($updateData);

        return redirect()->route('profile.show')->with('success', 'Profil mis à jour.');
    }
}
