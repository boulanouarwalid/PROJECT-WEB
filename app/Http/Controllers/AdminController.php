<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
use App\models\Admin ;
use Illuminate\Support\Facades\Auth;
use App\Models\Departement ;
use App\Models\specialite ;

class AdminController extends Controller
{
    // creation des donnes pour admin :
    public function createAdmindata(){
        $Nomcomplet = "lebhir walid" ;
        $email = "walid.lebhir@acadimie.com" ;
        $password = "walid2002#" ;
        $role = "Admin" ;
        $teliphone = "+121789856431";

        $resul =  DB::insert('INSERT INTO admins (Nomcomplet,email,password,teliphone,role) VALUE (?,?,?,?,?)',[$Nomcomplet ,$email,$password,$teliphone,$role]);
        if($resul){
            return "data inseret" ;
        }
        else{
            return "problemme ";
        }

    }

    // afichage page parametra
    public function parametreAdmin(){
        $user = Auth::guard('admins')->user();
        $dataAdmin = Admin::find($user->id);
        if($dataAdmin){
            return view('Admin.parametre' , compact('dataAdmin'));
        }
        else{
            return "problemme sytemme ";
        }

    }

    // modefication des information personnele
    public function modeficationdata(Request $request ){
        $dataAdmin_modefie = $request->validate([
            'Nomcomplet' => 'required' ,
            'email'=> 'required|email',
            'teliphone' => 'required' ,
        ]);

        $idAdmin = $request->id;
        $dataActuelle = Admin::find($idAdmin);
        $resultat = $dataActuelle->fill($dataAdmin_modefie)->save();
        if($resultat){
            return redirect()->route('param')->with('mod_data' , 'Modification effectuée avec succès');
        }
        else{
            return "problemme ";
        }
    }

    // modefication de password
    public function modefication_pasword(Request $request ){

        $modepass_required = $request->validate([
            'password' => 'required',
            'nv_password' => 'required',
            'conf_password' => 'required' ,
        ]);

        $password_request = $request->password ;
        $nouveaux_password = $request->nv_password ;
        $password_confirmation = $request->conf_password ;

        $id_Admin = $request->id ;
        $dataAdmin_recuperer = Admin::find($id_Admin)->first();
        if($dataAdmin_recuperer->password == $password_request){
            if($nouveaux_password == $password_confirmation){
                $resultat = DB::update('UPDATE admins SET password =? WHERE id=?' , [$nouveaux_password , $id_Admin]);
                if($resultat >0){
                    return redirect()->route('param')->with('pass_mod' , 'Mot de passe modifié !') ;
                }
                else{
                    return "problemmee";
                }
            }
        }
    }


    // creation d'une spesialite :

    public function Spesialite_index(){
        // selection departement :


            $departement = Departement::select('id' , 'Nom')->get();
            // recuperation des sprcielite :
            $specielite = DB::table('specialites')
            ->join('Departements' , 'specialites.idDepartement', '=','departements.id')
            ->select('specialites.*' , 'departements.nom as Nomdepartement')
            ->get();
            return view('Admin.add_spe' , compact('departement' , 'specielite'));




    }

    public function creat_specialite(Request $request ){
        $Data_specialite = $request->validate([
            'Nom' => 'required' ,
            'idDepartement' => 'required' ,
        ]);

        $description  = $request->description ;
        if(!empty($description)){
            $Data_specialite['description'] = $description ;
        }

        // ajouter une specialite
        try{
            $resultat = specialite::create($Data_specialite);
            if($resultat){
                return redirect()->route('specialite')->with('messageCreat' , "specialite Ajouter avec suces ");
            }

        }catch(\Exception $e){
            echo "Problemme". $e->getMessage();
        }

    }

    public function destroy_spe(Request $request ){
        // supresion d'une specialite :
        $id_specialite = $request->id ;

            $dataSuprimer = specialite::findOrfail($id_specialite);
            $resultat = $dataSuprimer->delete();
            if($resultat){
                return redirect()->route('specialite')->with('messageSupe' , "la supresion éfectue");
            }

    }


}
