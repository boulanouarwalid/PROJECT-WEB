<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Departement ;
use App\Models\filieres ;
use App\Models\Responsabilite ;

class FeliereController extends Controller
{
    // function qui permet d'ajouter des donnes dans table departement :
    public function createDepartement(){
        // data departement :
        $tableaux_departement = [
            'nom' => "physique",
            'specialite' => "physique ,Energitique et Recherche dans dommaina geni civil ",
        ];

        // creation des donnes :
        $createRsulatat = Departement::create($tableaux_departement);
        if($createRsulatat){
            return "data est cree";
        }
        else{
            return "data  not create " ;
        }

    }

    // fonction index pour page des feliere :
    public function index_Feliere(){
        // afichage des feliere avec departement ==> on fait une jointure :

        try{
            $filier = DB::table('filieres')
            ->join('departements' ,'filieres.departement_id', '=' , 'departements.id')
            ->select('filieres.*', 'departements.nom as nom_departement')
            ->get();

            // on fait une count pour les elements :
            $nbr_Department = Departement::all()->count();
            $nbrFilirer = filieres::all()->count();
            $responsabilite =Responsabilite::all()->count();
           

            return view('Admin.module', compact("filier" , 'nbr_Department' ,'nbrFilirer' , 'responsabilite'));
        }catch(\EXCEPTION $e){
            echo "problemme dans serveur ".$e->getMessage();
        }

    }

    public function CreateFeliere(){
        try{
            // recuperation des feliere :
            $Departement = Departement::all();
        }
        catch(\EXCEPTION $e){
            echo "problemme dens server ".$e->getMessage();
        }
        return view('Admin.AjoutFel' , compact("Departement"));

    }

    public function Store_Feliere(Request $request){
        // validation des donnes :
        $request->validate([
            'nom' => 'required' ,
            'departement' => 'required' ,
            'description' => 'required' ,
        ]);

        // recuperation id de departement :
        $departement = $request->departement ;
        try{
            $departementdata = Departement::where('nom' , $departement)->first();
            $id_departement = $departementdata->id ;
            // data create pour feliere :
            $DataFeliere = [
                'nom' => $request->nom ,
                'departement_id' => $id_departement ,
            ];
            $Resulatat_create = filieres::create($DataFeliere);
            if($Resulatat_create){
                return redirect()->route('felierindex')->with('messageFeli' , 'le feliere est cree avec succes');
            }
            else{
                return redirect()->route('felierindex')->width('ErrerMessage' , 'Problemme dans creation du feliere');

            }

        }catch(\EXCEPTION $e){
            echo "problemme dans le serveur". $e->getMessage();
        }

    }


    public function destro_felier(Request $request){
        // fonction pour supresion d'une filiere :
        $id_feliere = $request->id ;
        $data_destroy = filieres::find($id_feliere);
        $resulatat = $data_destroy->delete();

        if($resulatat){
            return redirect()->route('felierindex')->with('SupresionMessage' , "la supresion est efectue");
        }
    }
}
