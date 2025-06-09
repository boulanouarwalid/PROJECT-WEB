<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive ;

class ArchiveController extends Controller
{

    // retourner une page pour afichage des et uploder des fichies :

    public function Archive(){

        // afichage des fichies :
        $dataarchive = Archive::all();
        return view('chefDeparM.Raporting' , compact('dataarchive'));
    }


    public function CreateFile(Request $request ){
        // creation d'une fichies :
        $request->validate([
            'file' => 'required|file|mimes:pdf,xls,csv,xlsx|max:20480' ,
            'objectif' => 'required' ,
        ]);

        // recuperation des donnes de fichies :

        $DataFile['Nomfile'] = $request->file('file')->getClientOriginalName();
        $DataFile['type']= $request->file('file')->getMimeType();
        $DataFile['tail'] = $request->file('file')->getSize();

        $DataFile['pathfile'] = $request->file('file')->store('archive' , 'public');


        $DataFile['Objectif'] = $request->objectif;
        $DataFile['service'] = "chefDepartement";


            // creation du fichies dans data base :
            $uplode =Archive::create($DataFile);
            if($uplode){
                return redirect()->route('Archive')->with('message_uploder' , "le fichies est bien telicharger") ;

            }


    }





    //
}
