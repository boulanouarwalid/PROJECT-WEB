<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Utilisateurs ;
use App\Models\Responsabilite ;
use App\Models\Admin ;
use Illuminate\Support\str ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Mail\welcomemail;
use App\Models\Departement ;
use App\Models\Affectations ;

class AuthCOntroller extends Controller
{

    public function login(){
        return view('auth.login');
    }

    public function authontification(Request $request){
        $email = $request->email ;
        $password = $request->password ;

        $DataAdmin = Admin::where('email' ,$email)->first();
        $dataProf = Utilisateurs::where('Email' , $email)->first();
        if($DataAdmin){
            if($DataAdmin->password == $password){
                Auth::guard('admins')->login($DataAdmin);
                return redirect()->route('index');
            }
        }else if($dataProf){
                if($dataProf->password == $password ){
                    $responsabilite = Responsabilite::where('idProf' , $dataProf->id)->first();
                    if($responsabilite){
                        if($responsabilite->Responsabilite == "chef de departement"){
                            Auth::guard('chedDepartement')->login($dataProf);
                            return redirect()->route('dashdep');


                        }else if($responsabilite->Responsabilite == "Cordinateur"){
                            Auth::guard('Cordinateur')->login($dataProf);
                            return redirect()->route('coordinateur.dash');
                        }
                    }
                    else {
                        if($dataProf->role == "profiseur"){
                            Auth::guard('profiseur')->login($dataProf);
                            return redirect()->route('prof.dash');
                        }
                        else if($dataProf->role == "vacataire"){
                            Auth::guard('vacataire')->login($dataProf);
                            return  redirect()->route('vacataire.dash') ;
                        }
                    }
                }
                else{
                    return redirect()->route('login')->with(
                        'error', 'Mot de passe incorrect.'
                    ) ;
                }
        }
        else{
            return redirect()->route('login')->with(
                'error', 'Email ou mot de passe incorrect.'
            ) ;
        }



    }

    // creation d'une lougout :

    public function logout(Request $request ){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }












    // fonction vacataire :

    public function register(Request $request)
    {
        $departement = auth()->user()->currentCoordinatedDepartement();

        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'emailpersonel'=> 'required|string|email|max:255',
            'ville' => 'required|string|max:255',
            'Numerotelephone' => 'required|string|max:20',
            'CIN' => 'required|string|max:20|unique:utilisateurs',

        ]);

        // Generate institutional email
        $emailInstitutionnel = strtolower($validated['firstName'] . '.' . $validated['lastName'] . '@academiq.ma');

        // Generate random password (12 characters)
        $password = Str::random(10);

        $user = Auth::guard('Cordinateur')->user();

        $specialite = $user->deparetement ;


        // Create user
        $user = utilisateurs::create([
            'firstName' => $validated['firstName'],  // Changed from first_name
            'lastName' => $validated['lastName'],    // Changed from last_name
            'emailPersonelle' => $validated['emailpersonel'],
            'email' => $emailInstitutionnel,
            'ville' => $validated['ville'],
            'CIN' => $validated['CIN'],
            'Numeroteliphone' => $validated['Numerotelephone'],
            'password' => $password,
            'role' => "vacataire",
            'deparetement' => $departement->nom,
            'specialite' => $specialite,
            'status' => 'active',
            'data_nissance' => '1/1/1' ,
        ]);


        // Send welcome email
        try {
            Mail::to( $validated['emailpersonel'])
                ->cc('walidwalido1691999@gmail.com') // CC to yourself
                ->send(new welcomemail([
                    'name' => $validated['firstName'] . ' ' . $validated['lastName'],
                    'email' => $emailInstitutionnel,
                    'password' => $password,
                    'department' => $departement->nom
                ]));

            $message = 'Vacataire enregistré avec succès. Identifiants envoyés par email.';
        } catch (\Exception $e) {
            $message = 'Vacataire enregistré mais échec d\'envoi d\'email: ' . $e->getMessage();
        }

        return redirect()->route('coordinateur.cva')
               ->with('success', $message);
    }

    /**
     * Handle post-authentication redirect.
     */
    protected function authenticated(Request $request, $user)
    {
          $request->session()->regenerateToken();
        // Fallback if role system not properly set up
        if (!method_exists($user, 'getPrimaryRole')) {
            return redirect()->intended('/dash');
        }

        $roleRedirects = [
            'admin' => '/admin/dash',
            'coordinateur' => '/coordinateur/dash',
            'prof' => '/prof/dash',
            'vacataire' => '/vacataire/dash',
        ];

        $primaryRole = $user->getPrimaryRole();

        $redirectUrl = $roleRedirects[$primaryRole] ?? '/dash';

        // Check if there's an intended URL first
        if ($redirectUrl === '/dash' && $request->session()->has('url.intended')) {
            return redirect()->intended();
        }

        return redirect()->to($redirectUrl);
    }
    public function updateStatus(Request $request, $id)
{
    $validated = $request->validate([
        'status' => 'required|in:active,inactive,pending'
    ]);

    $vacataire = utilisateur::findOrFail($id);
    $vacataire->status = $validated['status'];
    $vacataire->save();

    return response()->json(['success' => true]);
}

public function destroy($id)
{


    try {
        // Find the vacataire
        $vacataire = utilisateurs::findOrFail($id);
        $name = $vacataire->firstName . ' ' . $vacataire->lastName;

        // Delete related responsibilities


        // Delete the vacataire
        $vacataire->delete();

        return response()->json([
            'success' => true,
            'id' => $id,
            'message' => "$name a été supprimé avec succès"
        ]);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Vacataire non trouvé'
        ], 404);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de la suppression: ' . $e->getMessage()
        ], 500);
    }
}
}
