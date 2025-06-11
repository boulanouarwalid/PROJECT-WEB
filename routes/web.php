<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\ResponsabiliteController ;
use App\Http\Controllers\AdminController ;
use App\Http\Controllers\DepartementMathController;
use App\Http\Controllers\AnoncesController ;
use App\Http\Controllers\RaportingControler ;
use App\Http\Controllers\stAdminController ;
use App\Http\Controllers\FeliereController ;
use App\Http\Controllers\AuthCOntroller ;
use App\Http\Controllers\UesController ;
use App\Http\Controllers\ArchiveController ;
use App\Http\Controllers\UeController ;
use App\Http\Controllers\ExportController ;
use App\Http\Controllers\EmploiDuTempsController ;
use App\Http\Controllers\ChargeHoraireController ;
use App\Http\Controllers\NoteController ;

use App\Models\filieres;
use App\Models\ues ;
use App\Models\Utilisateurs ;
use App\Models\Departement ;
use App\Models\affectations ;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// login Route :
Route::get('/' , [AuthCOntroller::class , 'login'])->name('login');
Route::post('/Autentification',[AuthCOntroller::class , 'authontification'])->name('auth');
Route::get('/deconextion' , [AuthCOntroller::class , 'logout'])->name('deconexion');

/**************** Route pour admin ***********************************************/

Route::prefix('admin')->middleware('auth:admins')->group(function () {

    // Route pour le dashboard de l'administration
    Route::get('/dash', [UtilisateursController::class, 'index'])->name('index');

    // Route pour l'affichage de la liste des comptes
    Route::get('/listeUsers', [UtilisateursController::class, 'listeProf'])->name('listUser');

    // Route pour la création d'un compte
    Route::get('/Comptesprof', [UtilisateursController::class, 'create'])->name('create');
    Route::post('/compt/create', [UtilisateursController::class, 'store'])->name('store');

    // Route pour afficher un compte spécifique
    Route::get('/show/{id}', [UtilisateursController::class, 'show'])->name('show');

    // Route pour la suppression d'un compte
    Route::delete('/delete/compts/{id}', [UtilisateursController::class, 'destroy'])->name('delete');

    // Route pour la recherche
    Route::post('/search/compts', [UtilisateursController::class, 'serach'])->name('searchName');

    // Route pour la modification d'un compte
    Route::get('/update/compts/{id}', [UtilisateursController::class, 'edit'])->name('edit');
    Route::put('/update/edit/compt/{id}', [UtilisateursController::class, 'update'])->name('update');

    // Routes pour la gestion des paramètres admin
    Route::get('/parametre', [AdminController::class, 'parametreAdmin'])->name('param');
    Route::put('/modefication/admin/{id}', [AdminController::class, 'modeficationdata'])->name('mod_param');
    Route::put('/modefication/password/{id}', [AdminController::class, 'modefication_pasword'])->name('password_mod');

    // Routes pour la gestion des responsabilités
    Route::get('/responsabilite', [ResponsabiliteController::class, 'index'])->name('respon');
    Route::post('/create/reponsable', [ResponsabiliteController::class, 'ResTraitement'])->name('ChoixResponsabilite');

    Route::post('/affectation/chef/departement/{idD}', [ResponsabiliteController::class, 'Afectation'])->name('Afectation');
    Route::get('/show/enseignant/{id}', [ResponsabiliteController::class, 'show_Ensinant'])->name('showEnsignant');
    Route::put('/modefication/{id}', [ResponsabiliteController::class, 'modef_resp'])->name('modef_resp');
    Route::get('/supression/responsabilite/{id}', [stAdminController::class, 'DestroyResponsable'])->name('delet_resp');
    Route::post('/search/post/administration', [ResponsabiliteController::class, 'search'])->name('searchp');

    // Routes pour afficher les modèles admin
    Route::get('/modules', [ResponsabiliteController::class, 'listeModules_Admin'])->name('modules');

    // Routes pour la gestion des annonces
    Route::get('/anonces/service', [AnoncesController::class, 'AnoncesSHow'])->name('anonces');
    Route::post('/upload/file', [AnoncesController::class, 'createAnonces'])->name('uplodefil');
    Route::get('/destroy/anonces/{id}', [AnoncesController::class, 'destroyAnonces'])->name('supresionAnonces');

    // Statistiques pour le département
    Route::get('/departement/service', [stAdminController::class, 'statistiqueDepartement'])->name('departemenent');

    // Création d'un département
    Route::get('/createdepartement', [FeliereController::class, 'createDepartement'])->name('creationDepartement');
    Route::get('/gestion/felier', [FeliereController::class, 'index_Feliere'])->name('felierindex');
    Route::get('/create/felier', [FeliereController::class, 'CreateFeliere'])->name('createFeliere');
    Route::post('/store/feliere', [FeliereController::class, 'Store_Feliere'])->name('storeFeliere');
    Route::delete('/delete/felier/{id}', [FeliereController::class ,'destro_felier' ])->name('delete_fel');
    // Routes pour l'affectation des professeurs et responsables
    Route::get('/listProfiseur/{id}/{idFelier}', [ResponsabiliteController::class, 'ListageProf'])->name('listProf');
    Route::post('/creation/responsabilite/{idD}', [ResponsabiliteController::class, 'Affectation_Feliere'])->name('create_responsabilite');

    // route pour specialite :
    Route::get('/add/specialite' , [AdminController::class , 'Spesialite_index'])->name('specialite');
    Route::post('/create/specialite' , [AdminController::class , 'creat_specialite'])->name('create_spe');
    Route::delete('/delet/specialite/administartion/{id}' , [AdminController::class , 'destroy_spe'])->name('delete_spe');



    // route qui permet d'aficher une les unite d'ensinement :
    Route::get('/liste/unite/ensinement' ,[UesController::class , 'Ues_liste'])->name('uesListe');

    Route::get('/export/Ens' , [ExportController::class , 'ENSCSV'])->name('exportEns');

});




/* ---------------------------------------------- Route departement math_informatique -------------------------------- */


Route::prefix('departement')->middleware('auth:chedDepartement')->group(function () {
    Route::get('/chef/deparetment', [DepartementMathController::class , 'dashdepartement'])->name('dashdep');


    // route pour listage des profiseur :
    Route::get('/profiseur/deparetmeent' , [DepartementMathController::class , 'ListeProf'])->name('listeprof');
    Route::get('/shwo/ENsinant/{id}' , [DepartementMathController::class , 'Show_ENsinant'])->name('showEns');
    // route pour rechercher par CIN d'une profiseur :
    Route::post('/search/prof', [DepartementMathController::class , 'serachProf'])->name('searchproff');
    // route pour rechercher par niveaux d'une feliere :
    Route::post('/search/modules',[DepartementMathController::class , 'search_modules'])->name('searchModule');

    Route::get('/module/departement/info' , [DepartementMathController::class , 'liste_Module'])->name('moduledep');
    Route::post('/filter/module' , [DepartementMathController::class , 'filter_Module'])->name('filter');


    // creation d'une ensinemant :
    Route::get('/create/ensinement' , [DepartementMathController::class , 'create_Ens'])->name('createModel');
    Route::post('/Store/ensinemant', [DepartementMathController::class , 'Store_Function'])->name('storeEns');

    // Afectation d'une ensignant --> module :
    Route::get('/Afectation/Ensignemant/{id}' , [DepartementMathController::class , 'AffectationModel'])->name('Afect');
    Route::post('/store/Affectation/{idEns}' ,[DepartementMathController::class , 'CreateAffectation'])->name('store_af');


    // modefication une unités d'ensinement :

    Route::get('/update/data/unite/{id}' , [DepartementMathController::class , 'Update_module'])->name('updateM');
    Route::post('/edit/unite/{id}' , [DepartementMathController::class ,'edit_M' ])->name('editunite');
    Route::delete('/delete/unite/Ensinement/{id}' , [DepartementMathController::class , 'delete_M'])->name('supresion_mo');

    Route::get('/profil/parametre' ,[DepartementMathController::class , 'profil_departement'])->name('profilData');
    Route::post('/update/password' , [ DepartementMathController::class , 'updatePassword'] )->name('updateProfile');

    // route pour Raporting :
    Route::get('/Reaporting/Data' , [ArchiveController::class , 'Archive'])->name('Archive');
});







// Route ******************************* cordinateur ********************************************

Route::prefix('coordinateur')->middleware('auth:Cordinateur')->group(function () {

    // Dashboard (keep existing)
    Route::get('/dash', function () {

        $user = Auth::user();
        $filiere = $user->currentCoordinatedFiliere();

        $ues = ues::where('filiere_id', $filiere->id)->get();
        $uesaffected = ues::where('filiere_id', $filiere->id)
            ->whereNotNull('responsable_id')
            ->get();
        $vacataire = Utilisateurs::where('role', 'vacataire')->get();

        return view('coordinateur.dash', compact('ues', 'uesaffected', 'vacataire'));
    })->name('coordinateur.dash');

    // New routes for sidebar actions
    Route::get('/vacataire/create', function () {

        $vacataires = utilisateurs::where('role', 'vacataire')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('coordinateur.vacataire.create', ['vacataires' => $vacataires]);
    })->name('coordinateur.cva');

    // Pending notes approval
    Route::get('/notes/pending', [NoteController::class, 'coordinateurPendingNotes'])
        ->name('coordinateur.notes.pending');
    Route::post('/notes/{note}/publish', [NoteController::class, 'publish'])
        ->name('coordinateur.notes.publish');

    Route::post('/vacataire/create', [AuthCOntroller::class, 'register'])->name('vacataire.create');

    Route::delete('/coordinateur/vacataire/{id}', [AuthCOntroller::class, 'destroy'])
        ->name('vacataire.destroy')
        ->middleware('auth');

    Route::put('/vacataire/{id}/status', [AuthCOntroller::class, 'updateStatus'])
        ->name('vacataire.updateStatus');

    Route::get('/ie', function () {
        return view('coordinateur.IE');
    })->name('coordinateur.ie');

    // Historique des années passées des UEs du coordinateur
    Route::get('/historique', function () {

        $user = auth()->user();
        $filiere = $user->currentCoordinatedFiliere();

        $logs = [];
        if ($filiere) {
            $logs = \App\Models\ues::where('filiere_id', $filiere->id)
                ->orderByDesc('annee_universitaire')
                ->get(['annee_universitaire', 'nom as ue_nom', 'semestre']);
        }
        return view('coordinateur.historique', compact('logs'));
    })->name('coordinateur.historique');

    // Route to trigger group notification for all coordinateurs (for demo/testing)
    Route::post('/trigger-group-notification', function () {

        $coordinateurs = \App\Models\Utilisateur::where('role', 'coordinateur')->get();
        foreach ($coordinateurs as $coordinateur) {
            $coordinateur->notify(new \App\Notifications\DefineGroupsNotification());
        }
        return back()->with('success', 'Notification envoyée à tous les coordinateurs.');
    })->name('coordinateur.trigger_group_notification');

    // Mark notification as read
    Route::post('/notifications/{id}/read', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return back();
    })->name('notifications.read');

    Route::post('/ues/delete-all', [UeController::class, 'deleteAll'])
        ->name('coordinateur.ues.deleteAll');

    Route::get('/emploi-du-temps', [EmploiDuTempsController::class, 'index'])
        ->name('coordinateur.et');

    Route::get('/emploi-du-temps/create', [EmploiDuTempsController::class, 'create'])
        ->name('coordinateur.emploi_du_temps.create');

    Route::post('/emploi-du-temps/store', [EmploiDuTempsController::class, 'store'])
        ->name('coordinateur.emploi_du_temps.store');

    // Nested group for UEs routes
    Route::prefix('/ues')->group(function () {
        Route::get('/', [UeController::class, 'index'])->name('coordinateur.ues.index');
        Route::get('/create', [UeController::class, 'create'])->name('coordinateur.ues.create');
        Route::post('/', [UeController::class, 'store'])->name('coordinateur.ues.store');
        Route::get('/{ue}/edit', [UeController::class, 'edit'])->name('coordinateur.ues.edit');
        Route::delete('/{ue}', [UeController::class, 'destroy'])->name('coordinateur.ues.destroy');
        Route::put('/{ue}', [UeController::class, 'update'])->name('coordinateur.ues.update');

        Route::get('/import', [UeController::class, 'importForm'])->name('coordinateur.ues.import.form');
        Route::post('/import', [UeController::class, 'import'])->name('coordinateur.ues.import');

        Route::get('/{ue}', [UeController::class, 'show'])->name('coordinateur.ues.show');
    });
    Route::get('/profile', [ProfileController::class, 'showprofilcoord'])->name('profile.show');
});


// Profile page
Route::middleware(['auth'])->group(function () {
    
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});



// **************************** Route **************************************************
Route::post('/import/process', [ImportController::class, 'process'])->name('import.process');


// CSV exports
Route::get('/export/vacataires/csv', [ExportController::class, 'vacatairesCSV'])
->name('export.vacataires.csv');

// PDF exports
Route::get('/export/vacataires/pdf', [ExportController::class, 'vacatairesPDF'])
->name('export.vacataires.pdf');

// Form processing
Route::post('/export/process', [ExportController::class, 'processExport'])
->name('export.process');

// Custom export
Route::post('/export/custom', [ExportController::class, 'customExport'])
->name('export.custom');

// Excel exports
Route::get('/export/unites/excel', [ExportController::class, 'unitesExcel'])
     ->name('export.unites.excel');

// CSV exports
Route::get('/export/unites/csv', [ExportController::class, 'unitesCSV'])
     ->name('export.unites.csv');

// PDF exports
Route::get('/export/unites/pdf', [ExportController::class, 'unitesPDF'])
     ->name('export.unites.pdf');



// Route **************************************** Prof ****************************************************


Route::prefix('prof')->middleware('auth:profiseur')->group(function () {
        Route::get('/dash', function () {
            return view('prof.dash');
        })->name('prof.dash');
        Route::get('/modules', function () {

            $user = Auth::user();

        $affectations= Affectations::where('prof_id' ,$user->id)->get();
    // Calculate totals
    $chargeTotale = $affectations->sum('charge_totale');
    $chargeMinimale = 192; // Default minimum hours
    $alerteCharge = $chargeTotale < $chargeMinimale;


            return view('prof.modules', compact(

        'chargeTotale',
        'chargeMinimale',
        'alerteCharge' ,
        'affectations'
    ));
        })->name('prof.modules');
        Route::get('/charge-horaire', [ChargeHoraireController::class, 'index'])->name('prof.chargehoraire');
        Route::get('/charge-horaire/create', [ChargeHoraireController::class, 'create'])->name('charge-horaire.create');
        Route::post('/charge-horaire', [ChargeHoraireController::class, 'store'])->name('charge-horaire.store');
        Route::get('/historique', function () {

            return view('prof.historique');
        })->name('prof.historique');


        Route::get('/ues', function () {

            $user=Auth::user();
            $departemet = Departement::where('nom' , $user->deparetement)->first();

            $ues=ues::where('department_id',$departemet->id)->paginate(10);


            return view('prof.ues.index',compact('ues'));
        })->name('prof.ues');

        Route::get('/notes', [NoteController::class, 'index'])->name('prof.notes');
        Route::post('/notes/{ue}/upload', [NoteController::class, 'upload'])
            ->name('notes.upload');
        Route::get('/notes/{note}/download', [NoteController::class, 'download'])->name('notes.download');
        Route::get('/notes/template', [NoteController::class, 'downloadTemplate'])->name('notes.template');
            // Add this new route

        });
    // Récupérer les UE par département
Route::get('/departements/{departement}/ues', [UEController::class, 'getByDepartement']);

// Récupérer les affectations par enseignant
Route::get('/prof/{enseignant}/affectations', [AffectationController::class, 'getByEnseignant']);

// Gestion des affectations
Route::resource('affectations', AffectationController::class)->only([
    'store', 'destroy'
]);
    // Wishes routes (keep outside professor group since they're used by multiple roles)
    Route::post('/wishes', [WisheController::class, 'store'])->name('wishes.store');
    Route::delete('/wishes/{id}', [WisheController::class, 'destroy'])
        ->name('wishes.destroy')
        ->where('id', '[0-9]+');





 // *************************************** Vactaire ************************************************
Route::prefix('vacataire')->middleware('auth:vacataire')->group(function () {
     Route::get('/dash', function () {
        $user = Auth::guard('vacataire')->user();

        $ues = $user->ues()
                   ->with(['filiere', 'niveau', 'departement'])
                   ->get();

        $normalSessionUEs = $ues->filter(function($ue) {
            return $ue->notes()->where('session_type', 'normal')->doesntExist();
        });

        $retakeSessionUEs = $ues->filter(function($ue) {
            return $ue->notes()->where('session_type', 'rattrapage')->doesntExist();
        });

        return view('vacataire.dash', [
            'ues' => $ues,
            'normalSessionUEs' => $normalSessionUEs,
            'retakeSessionUEs' => $retakeSessionUEs ,
            'user' => $user
        ]);

    })->name('vacataire.dash');

    Route::get('/ues', function () {
        $ues = auth()->user()->ues()
                            ->with(['filiere', 'niveau', 'departement'])
                            ->get();
        return view('vacataire.ues', compact('ues'));
    })->name('vacataire.ues');

    // UE Details
    Route::get('/ue/{ue}', function (Ue $ue) {
        if (!auth()->user()->ues->contains($ue)) {
            abort(403);
        }

        return view('vacataire.ue-details', [
            'ue' => $ue->load(['filiere', 'niveau', 'departement'])
        ]);
    })->name('ue.details');

    Route::get('/notes', [VacataireNoteController::class, 'index'])->name('vacataire.notes');

    Route::get('/notes/upload/{ue}/{session_type?}', function (Ue $ue, $session_type = 'normal') {
        if (!auth()->user()->ues->contains($ue)) abort(403);
        return view('vacataire.notes-upload', compact('ue', 'session_type'));
    })->name('notes.upload');

    Route::post('/notes/upload/{ue}', [VacataireNoteController::class, 'upload'])
        ->name('notes.upload.submit');

    Route::get('/notes/view/{ue}/{session_type}', [VacataireNoteController::class, 'view'])
        ->name('notes.view');
});
