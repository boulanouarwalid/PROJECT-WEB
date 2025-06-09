<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Utilisateurs;
use App\Models\Departement ;
use App\Models\ues ;
use App\Models\filieres ;
use App\Models\affectations ;
use Illuminate\Support\str ;
use App\Models\Responsabilite ;

class DepartementMathController extends Controller
{
    // function retourner dashbord
    public function dashdepartement(){
        if (Auth::guard('chedDepartement')->check()) {
            $admin = Auth::guard('chedDepartement')->user();
            $departement = Departement::where('nom' , $admin->deparetement)->first() ;

            $Responsable = DB::table('responsabilite')
                ->where('responsabilite.idd' , $departement->id)
                ->join('filieres', 'responsabilite.idf', '=', 'filieres.id')
                ->select(
                    'filieres.nom as nomf',
                    'responsabilite.*' // sans espace !
                )
                ->get();
            return view('chefDeparM.HomdepM' , compact('Responsable'));

        } else {
            return redirect()->route('login');
        }

    }


    // profil : setting
    public function profil_departement(){

        // recuperation des donnes de session :
        $DataUser = Auth::guard('chedDepartement')->user();
        $responsabilite = Responsabilite::where('idProf' , $DataUser->id)->first();
        return view('chefDeparM.profil' , compact('DataUser' , 'responsabilite'));
    }


    public function updatePassword(Request $request){
        // recuperation des donnes :
        $datauser = Auth::guard('chedDepartement')->user();
        $request->validate([
            'password' => 'required' ,
            'new_password' => 'required|min:8' ,
            'conf_password' => 'required' ,
        ]);

        if($request->password == $datauser->password){
            if($request->new_password == $request->conf_password){
                $datauser->password = $request->new_password  ;
                $resultat = $datauser->save();
                if($resultat){
                    return redirect()->route('profilData')->with('messagepassword' , 'le mode pass est modefie ');

                }
                else{
                    return "problemme dans la modefication " ;
                }



            }
        }



    }

    //fonction public qui permet de liser les profeseur aprtient au departement mathinfo :
    public function ListeProf(){

        // recuperation des donnes
        $user = Auth::guard('chedDepartement')->user();
        $departement = $user->deparetement;

        try{
            $dataProf_math = Utilisateurs::where('deparetement' , $departement)->get();
            if(!$dataProf_math->isEmpty()){
                return view('chefDeparM.profdep',compact('dataProf_math')) ;
            }
            else{
                return redirect()->with('message' , "Data n'existe pas ") ;
            }
        }catch(\Exception $e){
            return view('Ereur.pageEr');

        }
    }





    // function qui permet de lister les modules :
    public function liste_Module(){
        // afichage des module :

        $user = Auth::guard('chedDepartement')->user();
        $departement = $user->deparetement;

        try{
            $id_dep = Departement::where('nom'  , $departement)->pluck('id')->first();

            $Data_Ens = DB::table('ues')
            ->join('filieres' , 'ues.filiere_id','=','filieres.id')
            ->select('ues.*' , 'filieres.nom as nomf')
            ->where('ues.department_id' , $id_dep)
            ->get();

            // recuperation des donnes des filiere :
            $filier = filieres::where('departement_id' ,$id_dep)->select('id', 'nom')->get();

            return view('chefDeparM.Moduldepm' , compact('Data_Ens', 'filier')) ;


        }catch(\EXCEPTION $e){
            return view('Ereur.pageEr');
        }

    }

    public function filter_Module(Request $request ){
        // afechage des unite d'ensignemant par Filiere :

        $id_filier = $request->id ;
        try{
            $Data_ues= ues::where('filiere_id' , $id_filier)->get();
            if(!$Data_ues->isEmpty()){
                return view('chefDeparM.filterM', compact('Data_ues'));
            }
            else{
                return redirect()->route('moduledep')->with('message' , 'pas du model ') ;
            }

        }catch(\Exception $e){
            echo "problemme ".$e->getMessage();

        }

    }

    public function delete_M($id){

        // fonction de supresion d'une unite d'ensinement :
        $ues_delete  = ues::find($id);
        $resulatat = $ues_delete->delete();
        if($resulatat){
            return redirect()->route('moduledep')->with('supresion', "la supresion est valide ");
        }


    }

    public function create_Ens(){
        $user = Auth::guard('chedDepartement')->user();
        $departement = $user->deparetement;
        // selectionner des feliere juste pour chaque department :
        try{
            $id_dep = Departement::where('nom'  , $departement)->pluck('id')->first();
            $feliere =filieres::where('departement_id' , $id_dep)->get();

            return view('chefDeparM.CreatM' , compact("feliere")) ;
        }catch(\EXCEPTION $e){
            return view('Ereur.pageEr');
        }

    }

    public function Store_Function(Request $request){
        // recuperation des donnes et validation :
        $user = Auth::guard('chedDepartement')->user();
        $departement = $user->deparetement;
        $DataCreat = $request->validate([
            'nom' => 'required' ,
            'heures_cm' => 'required' ,
            'heures_td' => 'required' ,
            'heures_tp' => 'required' ,
            'semestre' =>'required',
            'annee_universitaire' =>'required' ,
            'groupes_td' => 'required' ,
            'groupes_tp' => 'required' ,
            'filiere_id' => 'required',

        ]);

        $DataCreat['code'] = str::random(3). '.' .$request->filiere_id;
        $DataCreat['department_id'] = Departement::where('nom'  , $departement)->pluck('id')->first();
        $DataCreat['est_vacant'] = true ;

        $ResulatatCreate = ues::create($DataCreat);
        if($ResulatatCreate){
            return redirect()->route('moduledep')->with('messagecreat' , "l'ensinement est ajouter avec succes ");
        }
        else{
            return "data not creat " ;
        }
    }

    public function Update_module($id){
        $user = Auth::guard('chedDepartement')->user();
        $departement = $user->deparetement;
        // recuperation des donnes de modules :
        try{
            $Unite_data = ues::find($id);
            $felier = DB::table('filieres')
                ->join('departements', 'filieres.departement_id', '=', 'departements.id')
                ->where('departements.nom', $departement)
                ->select('filieres.*') // ou ce que tu veux récupérer
                ->get();

            return view('chefDeparM.modUni' , compact('Unite_data' ,'felier'));

        }catch(\Exception $e){
            return view('Ereur.pageEr');
        }
    }

    public function edit_M(Request $request , $id){
        $user = Auth::guard('chedDepartement')->user();
        $departement = $user->deparetement;

        $DataUpdate = $request->validate([
            'nom' => 'required' ,
            'heures_cm' => 'required' ,
            'heures_td' => 'required' ,
            'heures_tp' => 'required' ,
            'semestre' =>'required',
            'annee_universitaire' =>'required' ,
            'groupes_td' => 'required' ,
            'groupes_tp' => 'required' ,
            'filiere_id' => 'required',

        ]);

        $DataUpdate['code'] = str::random(8). '.' .$request->filiere_id;
        $DataUpdate['department_id'] = Departement::where('nom'  , $departement)->pluck('id')->first();
        $DataUpdate['est_vacant'] = true ;
        try{
            $DataOriginate = ues::find($id);
            $resulatat = $DataOriginate->fill($DataUpdate)->save();
            if($resulatat){
                return redirect()->route('moduledep')->with('messageupdate' , "la modefiaction est efectue");
            }

        }catch(\exception){
            return "ereur";
        }
    }



    public function AffectationModel($id){
        // Afectation
        $user = Auth::guard('chedDepartement')->user();
        $departement = $user->deparetement;
        try{
            $DataProf = Utilisateurs::where('deparetement' , $departement)->get();
            return view('chefDeparM.AffectMod' , compact('DataProf' , 'departement' , 'id'));

        }catch(\Exception $e){
            return view('Ereur.pageEr');
        }
    }

    public function CreateAffectation(Request $request , $idEns){
        $Data_affectation = $request->validate([
            'prof_id' => 'required' ,
            'type' => 'required' ,
        ]);

        $Data_affectation['annee_universitaire'] = date('Y') ;
        $Data_affectation['status'] = 'confirmée' ;
        $Data_affectation['ue_id'] = $idEns ;
        $Data_affectation['affecter_par'] = $request->prof_id;
        $resulatat =affectations::create($Data_affectation);
        if($resulatat){
            return redirect()->route('moduledep')->with('Maff' , "affectation effectue");
        }
        else{
            return redirect()->route('')->with('erMe', "problemme dans affectation ");
        }
    }


    public function destroy_Affet($id){
        try{
            $Affectation = affectations::find($id);
            $delete_resul = $Affectation->delete();
            if($delete_resul){
                return redirect()->route('')->with('message','');
            }

        }catch(\Exception $e){
            return view('Ereur.pageEr');
        }
    }


    // fonction show pour aficher les information sur utilisatuer :
    public function Show_ENsinant($id ){
        // les donnes pour  utilisateur :
        $dataUser = Utilisateurs::find($id);
        return view('chefdeparM.searchcheed' ,compact('dataUser'));
    }


    public function serachProf(Request $request){
        $cinProf = $request->CIN_search ;
        $dataUser = Utilisateurs::where('CIN' , $cinProf)->first();
        return view('chefdeparM.searchcheed' ,compact('dataUser'));


    }




}
