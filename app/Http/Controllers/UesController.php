<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement ;
use App\Models\filieres ;
use App\Models\affectation ;
use Illuminate\Support\Facades\DB ;

class UesController extends Controller
{
    public function Ues_liste(){
        // afichage des liste d'ensinement :

        // recuperation des departement :
        $dep = Departement::select('nom' , 'id')->get();

        // jointure pour la recuperation des afectatio et unite d'ensinement :
        $collectionData = DB::table('affectations')
        ->join('ues' , 'affectations.ue_id' , '=' ,'ues.id')
        ->join('utilisateurs' , 'affectations.prof_id' , 'utilisateurs.id')
        ->join('filieres' , 'ues.filiere_id' , '=' , 'filieres.id')
        ->select(
            DB::raw("CONCAT(utilisateurs.lastName, ' ', utilisateurs.firstName) as nomprof"),
            'utilisateurs.CIN as cinprof',
            'filieres.nom as nomf' ,
            'ues.*',
            'affectations.type as typeA' ,
        )
        ->get();


        return view('Admin.UEsAfiche' , compact('dep' , 'collectionData'));
    }



    public function AfchageUnite(){
         // afichage des liste d'ensinement :

        // recuperation des departement :
        $dep = Departement::select('nom' , 'id')->get();

        // jointure pour la recuperation des afectatio et unite d'ensinement :
        $collectionData = DB::table('affectations')
        ->join('ues' , 'affectations.ue_id' , '=' ,'ues.id')
        ->join('utilisateurs' , 'affectations.prof_id' , 'utilisateurs.id')
        ->join('filieres' , 'ues.filiere_id' , '=' , 'filieres.id')
        ->select(
            DB::raw("CONCAT(utilisateurs.lastName, ' ', utilisateurs.firstName) as nomprof"),
            'utilisateurs.CIN as cinprof',
            'filieres.nom as nomf' ,
            'ues.*',
            'affectations.type as typeA' ,
        )
        ->get();
            

        return view('ChefDeparM.listues' , compact('collectionData'));
    }
}
