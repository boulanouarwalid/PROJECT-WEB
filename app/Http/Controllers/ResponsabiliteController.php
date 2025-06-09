<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\str ;
use Illuminate\Support\Facades\DB ;
use App\Models\Utilisateurs;
use App\Models\Responsabilite;
use App\Models\Departement ;
use App\Models\filieres;

class ResponsabiliteController extends Controller
{

    public function index(){
        try{
            // Recuperation de tout les profiseur
            $Ensinant = Utilisateurs::all();
            $dep = Departement::all();
            return view('Admin.Resp' , compact('Ensinant' , 'dep'));
        }catch(\Exception $e){
            \Log::error('ereur dans la recuperation des donnes ');
            return view('Ereur.pageEr');
        }

    }

    public function ResTraitement(Request $request){
        $dataRotourner = $request->departement ;

        try{
            if($dataRotourner == "Mathematique/informatique"){
                // recuperation des donnes des profiseur mathematique :
                $EnsinatDep = Utilisateurs::where("deparetement" , "Mathematique/informatique")->get();
                $datad = Departement::where('nom' ,$dataRotourner)->get()->first();
                $idD = $datad->id ;
            }
            else if($dataRotourner == "physique"){
                $EnsinatDep = Utilisateurs::where("deparetement" , "physique")->get();
                $datad = Departement::where('nom' ,$dataRotourner)->get()->first();
                $idD = $datad->id ;
            }
            else{
                return "data n'existe pas ";
            }

        }catch(\Exception $e){
            return view('Ereur.pageEr');
        }

        return view("Admin.Affectdep" , compact("EnsinatDep" ,'idD'));

    }

    // function d'arfectation d'une responsabilite :
    public function Afectation(Request $request , $idD){
        $idrequest = $request->ensignantId ;
            // on fait la recuperation des donnes de user :
            $datauser = Utilisateurs::find($idrequest);
            try{

                $responsabilite = "chef de departement";
                $ResulatatTest = Responsabilite::where("Responsabilite" , $responsabilite)->get();

                    $DataCreate = [
                        "idProf" => $idrequest ,
                        "Nomprof" => $datauser->lastName ,
                        "prenomprof"=> $datauser->firstName,
                        "CIN" => $datauser->CIN ,
                        "Responsabilite" => $responsabilite,
                        "idd" => $idD

                    ];
                    $rotourCreate =  Responsabilite::create($DataCreate);

                    if($rotourCreate){
                        return redirect()->route('respon')->with('valide' , "responsabilite AJouter ");
                    }
                    else{
                        return redirect()->route('respon')->with('ereur' , "Problemme service ");
                    }


            }catch(\Exception $e){
                return $e->getMessage();
            }

    }

    // fonctionalite pour show (Afichage une ensignant);
    public function show_Ensinant(Request $request){
        $id = $request->id ;

        try{
            $Data_Ensignant = Utilisateurs::find($id);
            return view('Admin.showEn', compact("Data_Ensignant"));
        }catch(\EXCEPTION $e){
            return view('Ereur.pageEr');
        }
    }

    // afectation du feliere :

    public function ListageProf(Request $request ){
        $idD = $request->id ;
        try{
            $DataDepartement = Departement::find($request->id);
            $idFeliere = $request->idFelier ;



            $Nom_departement = $DataDepartement->nom ;
            $UserData = Utilisateurs::where('deparetement' ,$Nom_departement)->get();
            return view('Admin.AffectCord' , compact('UserData' , 'Nom_departement' , 'idFeliere' , 'idD'));
        }catch(\EXCEPTION $e){
            return view('Ereur.pageEr');
        }

    }

    // fonction d'afectation du felier :
    public function Affectation_Feliere(Request $request , $id){
        // recuepation des donnes :

        $datarequest = $request->id ;
        list($userId, $filierId) = explode('|', $datarequest);

        // creation d'une responsabilite :

            $dataUser = Utilisateurs::find($userId);
            $responsabiliteCreate = [
                'idProf' => $userId ,
                'Nomprof' => $dataUser->lastName ,
                'CIN' => $dataUser->CIN ,
                'Responsabilite' => "Cordinateur" ,
                'prenomprof' => $dataUser->firstName ,
                'idf' => $filierId ,
                'idd' => $id ,
            ] ;

            $resulatatCreat = Responsabilite::create($responsabiliteCreate);
            if($resulatatCreat){
                return redirect()->route('felierindex')->with('massageValide' , 'la responsabilite est cree avec succes');
            }


    }


}
