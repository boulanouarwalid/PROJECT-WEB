<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive ;

class ArchiveController extends Controller
{

    // retourner une page pour afichage des et uploder des fichies :

    public function Archive(){

        return view('chefDeparM.Raporting'); 
    }


    public function CreateFile(Request $request ){
        // creation d'une fichies :
        $DataFile = $request->validate([
            'file' => 'required|file|mimes:pdf,xls,csv,xlsx|max:20480' ,
        ]);

        // recuperation des donnes de fichies :
        $fichies = $request->file('file');
        $DataFile['Nomfile'] = $fichies->getClientOriginalName();
        $DataFile['type']= $fichies->getMimeType();
        $DataFile['tail'] = $fichies->getSize();

        $DataFile['path'] = $fichies->store('Archive' , 'public');


        $DataFile['Objectif'] = "Archive departement " ;
        try{

            // creation du fichies dans data base :
            $uplode =Archive::create($DataFile);
            if($uplode){
                return "file  uplod" ;

            }

        }catch(\Exception $e){
            return "problemme". $e->getMessage();
        }
    }
}
