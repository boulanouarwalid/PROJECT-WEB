<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateurs ;
use App\Models\Deparetementmath;

class RaportingControler extends Controller
{
    //les fonction statistuqe du systeme pour chaque departement :
    public function StatistiqueProfiseur(){
        // moyenne des prof de departement par feliere

        $deparement = "Informatique/mathematique" ;
        $nombrefeliere = 3 ;
        try{
            $quantitePro = Utilisateurs::where('deparetement', $deparement)->count();
            $moyenne_prof = $quantitePro/$nombrefeliere ;

            // on retourner lma moyenne des profiseur et nombre des profiseur
            return [$quantitePro , $moyenne_prof] ;
        }
        catch(\Exception $e){
            \Log::error('Erreur dans la récupération des données', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return view('Ereur.pageEr');
        }
    }

    public function feliereS(){
        // statistique pour nombre des prof par feliere :
        $tableaux_feliere = ["geni informatique " , "ingénieur donnés" , "tdia"];
        try{

            $geni_informatique =Deparetementmath::where('feliere' , $tableaux_feliere[0])->count();
            $data = Deparetementmath::where('feliere' , $tableaux_feliere[1])->count();
            $tdia = Deparetementmath::where('feliere' , $tableaux_feliere[2])->count();

            $statistuqeFeliere = [$geni_informatique , $data , $tdia];
            return $statistuqeFeliere ;


        }
        catch(\Exception $e){
            \Log::error('Erreur dans la récupération des données', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return view('Ereur.pageEr');
        }
    }




    // function generale du statisque :
    public function raportDep(){
        $tableauxmoyenne = array();
        $statistiqueFeliere = array();
        $tableauxmoyenne = $this->StatistiqueProfiseur();
        $statistiqueFeliere = $this->feliereS();

        return [$tableauxmoyenne , $statistiqueFeliere];
    }
}
