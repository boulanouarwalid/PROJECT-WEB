<?php

namespace App\Http\Controllers;

use App\Models\Utilisateurs;
use App\Models\Responsabilite ;
use App\Models\Departement ;
use Illuminate\Support\str ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB ;

use App\Models\Specialite ;


use Illuminate\Support\Facades\Mail;
use App\Mail\welcomemail;

class UtilisateursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('admins')->check()) {
            $admin = Auth::guard('admins')->user();

            try{
                $dataResp = Responsabilite::take(4)->get();
                $statRe = Responsabilite::all()->count();
                $nombrProf = Utilisateurs::all()->count();
                if($dataResp){
                    return view('Admin.Hom' , compact('dataResp','statRe' , 'nombrProf'));
                }
            }
            catch(\Exception $e){
                \Log::error('Erreur dans la récupération des données', [
                    'message' => $e->getMessage()
                ]);
                return view('Ereur.pageEr');
            }

        } else {
            return redirect()->route('login');
        }
        // recuperation des responsable d'administration :



    }

    public function listeProf(){

        // recuperations des donnes :
        try{
            $datacompts = Utilisateurs::paginate(10);
            return view('Admin.Compts' , compact('datacompts'));
        }
        catch(\Exception $e){
            \Log::error('Erreur lors de la récupération des données: ' . $e->getMessage());
            return view('Ereur.pageEr');

        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            try{
                $specialite = Specialite::select('Nom')->get();
                return view('Admin.create' , compact('specialite'));
            }catch(\EXCEPTION $e){
                return view('Ereur.pageEr');
            }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // cree une compt pour utilisateur :
        $data_recuperer = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'data_nissance' => 'required|date',
            'Numeroteliphone' => 'required',
            'CIN' => 'required',
            'role' => 'required',
            'ville' => 'required',
            'specialite' => 'required',
            'emailPersonelle' => 'required'

        ]);
        $data_recuperer['password'] = Str::random(10) ;
        $Nom=$request->lastName ;
        $prenom = $request->firstName ;
        $data_recuperer['email'] = $prenom.".".$Nom ."@acadimie.com" ;

        $idDepartement = Specialite::where('Nom' , $request->specialite)->select('idDepartement')->first();
        $dep = Departement::find($idDepartement->idDepartement)->nom;

            $data_recuperer['deparetement'] = $dep;

            $creation =  Utilisateurs::create($data_recuperer);
            if($creation){
                // rederiction ver la apge d'afichage des donnes
                try {
                    Mail::to( $data_recuperer['emailPersonelle'])
                        ->cc('walidwalido1691999@gmail.com') // CC to yourself
                        ->send(new welcomemail([
                            'name' => $data_recuperer['firstName'] . ' ' . $data_recuperer['lastName'],
                            'email' => $data_recuperer['email'],
                            'password' => $data_recuperer['password'],
                            'department' => $data_recuperer['deparetement'], 
                        ]));
                        
                    $message = 'Vacataire enregistré avec succès. Identifiants envoyés par email.';
                } catch (\Exception $e) {
                    $message = 'Vacataire enregistré mais échec d\'envoi d\'email: ' . $e->getMessage();
                }


                return redirect()->route('listUser')->with('ajouterCompt' , 'creation est valide ')->with('message' , 'not serve');

            }
            else{
                // returner une ereur
                return "problemme";
            }




    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // fonction shwo qui permet d'aficher utilisateur par utilisateur
        $id_user = $request->id ;
        $data_user = Utilisateurs::find($id_user) ;
        dd($data_user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id_compt = $request->id ;
        $comptss = Utilisateurs::find($id_compt);
        $Departement = departement::select('nom')->get();
        return view('Admin.update' , compact('comptss' , 'Departement'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // modefication des donnes
        $dataModefie = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'data_nissance' => 'required|date',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'role' => 'required',
            'ville' => 'required',
            'deparetement' => 'required',
            'specialite' => 'required',

        ]);

        $id = $request->id ;
        $dataOriginale = Utilisateurs::find($id) ;
        $resulta_update =   $dataOriginale->fill($dataModefie)->save();
        if($resulta_update){
            return redirect()->route('listUser')->with('messageUpdate' , 'modefication efectue');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request )
    {
        // superion d'un utilisateur :

        $id_request = $request->id ;
        $data_utilisateur = Utilisateurs::find($id_request);
        $data_utilisateur->delete();
       if($data_utilisateur){
            return back()->with('messagesupresion' , 'la supresion efectue avec succes ') ;
       }
       else {
        return "problemme dans la supresion";

       }
    }

    public function serach(Request $request ){

        // fonction pour efectuer la recherche par id / lastName / email

        if(!empty($request->namesearch)){
            $namerecupere = $request->namesearch;
            // recuperation apàartir de base de donnes :
            $dataCompt = Utilisateurs::where('lastName' , $namerecupere)->first();
            if($dataCompt){
                return view('Admin.search', compact('dataCompt') );
            }
            else{
                return "this compts is not existe " ;
            }

        }

        if(!empty($request->emailsearch)){
            $email_recuperer = $request->emailsearch ;
            $dataCompt = Utilisateurs::where('Email',$email_recuperer)->first();
            if($dataCompt){
                return view('Admin.search' ,compact('dataCompt'));
            }
            else{
                return "data n'exsite pas";
            }
        }
        if(!empty($request->searchid)){
            $id_recupere = $request->searchid ;
            $dataCompt = Utilisateurs::find($id_recupere) ;
            if($dataCompt){
                return view('Admin.search' ,compact('dataCompt'));
            }
            else{
                return "data not exsite ";
            }
        }



    }

    public function parametre(){
        return view('Admin.parametre');
    }


}
