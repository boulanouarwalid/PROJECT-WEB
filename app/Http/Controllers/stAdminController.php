<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateurs ;
use App\Models\Responsabilite ;
use Illuminate\Support\Facades\DB;
class stAdminController extends Controller
{

    // fonction de statistique d'administration :
    public function statistiqueDepartement(){

        // calculer les profiseur de departement mathematique :

            $sta_Dinfo = Utilisateurs::where('deparetement' , 'Mathematique/informatique')->count();
            $sta_Dphysique = Utilisateurs::where('deparetement' , 'physique')->count();
            $totale_Prof = Utilisateurs::all()->count();

            //analyse d'une jointure de rcuperation des responsabilite :

           $Responsabilite = DB::table('responsabilite')
            ->leftJoin('departements', 'responsabilite.idd', '=', 'departements.id')
            ->leftJoin('filieres', 'responsabilite.idf', '=', 'filieres.id')
            ->select(
                'responsabilite.*',
                'departements.nom as nomd',
                'filieres.nom as nomf'
            )
            ->get();

            return view('Admin.departement' , compact('sta_Dinfo', 'sta_Dphysique' ,'totale_Prof','Responsabilite' ));



    }

    // supresion d'une responsable :

    public function DestroyResponsable(Request $request){
        $idResponsabilite = $request->id ;

        try{
            // recuperation du responsbailite :
            $Responsabilite = Responsabilite::find($idResponsabilite);
            $resulatatDelet = $Responsabilite->delete();
            if($resulatatDelet){
                return redirect()->route('departemenent');
            }
            else{
                return redirect()->route('departemenent') ;
            }
        }catch(\EXCEPTION $e){
            return view('Ereur.pageEr');
        }
    }




}
