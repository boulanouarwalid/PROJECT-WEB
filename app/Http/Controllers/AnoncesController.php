<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonces ;

class AnoncesController extends Controller
{
    public function AnoncesSHow(){
        // Afichage des anonces :
        try{
            // recuperation des donnes :
            $DataAnonces = Annonces::all();
            return view('Admin.Anonces' ,compact("DataAnonces"));

        }
        catch(\EXCEPTION $e){
            echo "problemme dans le serveur " ;
        }

    }

    // fonction qui permet d'ajouter une anonces :
    public function createAnonces(Request $request ){
        $request->validate([
            'titre' => 'required|max:255',
            'Description' => 'required' ,
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048' ,
        ]);


        $service = "Administration" ;

        $fichiesAnonces = $request->file('file');
        $file = $fichiesAnonces->store('Anonces' , 'public');

        $resultat =  Annonces::create([
            'titre' => $request->titre ,
            'Description' => $request->Description ,
            'service' => $service ,
            'file' => $file ,
            'name' => $fichiesAnonces->getClientOriginalName() ,
            'type' => $fichiesAnonces->getMimeType() ,
            'tail' => $fichiesAnonces->getSize(),
        ]);

        if($resultat ){
            return redirect()->route('anonces')->with('uplodsucces' , 'la fichies est uploder ') ;
        }

    }


    public function destroyAnonces(Request $request){
        $idAnonce = $request->id ;
        $Anonces = Annonces::find($idAnonce);
        $resultat = $Anonces->delete();
        if($resultat){
            return redirect()->route("anonces")->with('supresionfile' , 'le fichies est supermer');
        }
        else{
            return "problemme ";
        }

    }

}
