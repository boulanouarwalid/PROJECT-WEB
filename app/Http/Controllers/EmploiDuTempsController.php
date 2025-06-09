<?php

namespace App\Http\Controllers;

use App\Models\EmploiDuTemps;
use App\Models\Salle;
use App\Models\Ue;
use App\Models\niveau;
use App\Models\Utilisateur;
use App\Models\responsabilite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Imports\UEsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class EmploiDuTempsController extends Controller
{


public function import(Request $request)
{
    $request->validate([
        'ue_file' => 'required|file|mimes:xlsx,xls|max:5120' // 5MB max
    ]);

    try {
        $file = $request->file('ue_file');
        $filiere = $request->user()->currentCoordinatedFiliere();
        
        Excel::import(new UEsImport($filiere), $file);
        
        return redirect()->back()
            ->with('success', 'Les UEs ont été importées avec succès!');
            
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Erreur lors de l\'importation: '.$e->getMessage());
    }
}
public function index(Request $request)
{
    $user = Auth::user();
    $filiere = $user->currentCoordinatedFiliere();
    
    // Debug 1: Check filiere data
  
    
    // Get available semesters and niveaux based on filière
    $niveaux =niveau::where('filiere_id',$filiere->id)->get();
    $semesters = ['S1', 'S2', 'S3', 'S4', 'S5', 'S6'];
    
    // Debug 2: Check available niveaux
    
    
    // Get selected filters (or defaults)
    $selectedSemestre = $request->get('semestre', 'S1');
    $selectedNiveau = $request->get('niveau', $niveaux->first()->id ?? null);
    
    // Debug 3: Check selected filters
  

    $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    $creneaux = [
        ['08:30:00', '10:30:00'],
        ['10:30:00', '12:30:00'],
        ['14:30:00', '16:30:00'], 
        ['16:30:00', '18:30:00'],
    ];

    // Debug 4: Log the query being built


    $emplois = EmploiDuTemps::where('semestre', $selectedSemestre)
        ->where('annee_universitaire', date('Y').'-'.(date('Y')+1))
        ->where('niveau_id', $selectedNiveau)
        ->get();
    
    // Debug 5: Check the final query results
 
    // Keep the dd() for immediate debugging
   

    return view('coordinateur.emploi_du_temps.index', 
        compact('jours', 'creneaux', 'emplois', 'niveaux', 'semesters',
                'selectedSemestre', 'selectedNiveau'));
}
public function create(Request $request)
{
    $user = Auth::user();
    $departement = $user->currentCoordinatedDepartement();
    $filiere = $user->currentCoordinatedFiliere();
    $selectedSemestre = $request->get('semestre', 'S1');
    
    // Get niveaux for the filiere
    $niveaux = Niveau::where('filiere_id', $filiere->id)->get();


    $semestres = ['S1', 'S2', 'S3', 'S4', 'S5', 'S6'];

    // Get UEs for the filiere
    $ues = Ue::where('filiere_id', $filiere->id)->get();

    // Determine department name(s) for filtering enseignants
    if ($departement->id == 1) {
        $departementNOM = ['Mathématiques et Informatique'];
    } elseif ($departement->id == 2) {
        $departementNOM = ['Génie Civil Energétique et Environnement'];
    } else {
        $departementNOM = [];
    }

    $enseignants = Utilisateur::whereIn('departements', $departementNOM)
        ->where('role', 'vacataire')
        ->get();

    $salles = Salle::where('department_id', $departement->id)->get();

    $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    $creneaux = [
        ['08:30:00', '10:30:00'],
        ['10:30:00', '12:30:00'],
        ['14:30:00', '16:30:00'],
        ['16:30:00', '18:30:00'],
    ];

     $selectedNiveau = $request->get('niveau_id', $niveaux->first()->id ?? null);
    
    return view('coordinateur.emploi_du_temps.create', compact(
        'ues', 'enseignants', 'salles', 'jours', 'creneaux',
        'selectedSemestre', 'selectedNiveau', 'semestres', 'niveaux'
    ));
}

public function store(Request $request)
{
    // Validate the request data
    $validated = $request->validate([
        'ue_id' => 'required|exists:ues,id',
        'enseignant_id' => 'required|exists:utilisateurs,id',
        'salle_id' => 'required|exists:salles,id',
        'jour' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi,samedi',
        'heure_debut' => 'required|in:08:30:00,10:30:00,14:30:00,16:30:00',
        'type_seance' => 'required|in:cours,td,tp',
        'groupe' => 'nullable|integer|min:1',
        'semestre' => 'required|in:S1,S2,S3,S4,S5,S6',
        'niveau_id' => 'required|integer|exists:niveaux,id',
    ]);

    // If we get here, validation passed
    // Map time slots to their end times
    $creneaux = [
        '08:30:00' => '10:30:00',
        '10:30:00' => '12:30:00',
        '14:30:00' => '16:30:00',
        '16:30:00' => '18:30:00',
    ];
    
    $heure_fin = $creneaux[$request->heure_debut];
    $annee = date('Y') . '-' . (date('Y') + 1);

    // Check for conflicts
    $conflictSalle = EmploiDuTemps::where('salle_id', $request->salle_id)
        ->where('jour', $request->jour)
        ->where('heure_debut', $request->heure_debut)
        ->where('semestre', $request->semestre)
        ->where('annee_universitaire', $annee)
        ->exists();

    if ($conflictSalle) {
        return back()->withErrors(['salle_id' => 'Cette salle est déjà utilisée dans ce créneau.'])->withInput();
    }

    $conflictProf = EmploiDuTemps::where('enseignant_id', $request->enseignant_id)
        ->where('jour', $request->jour)
        ->where('heure_debut', $request->heure_debut)
        ->where('semestre', $request->semestre)
        ->where('annee_universitaire', $annee)
        ->exists();

    if ($conflictProf) {
        return back()->withErrors(['enseignant_id' => 'Cet enseignant a déjà une séance à ce moment.'])->withInput();
    }

    // Create the timetable entry
    EmploiDuTemps::create([
        'ue_id' => $request->ue_id,
        'enseignant_id' => $request->enseignant_id,
        'salle_id' => $request->salle_id,
        'jour' => $request->jour,
        'heure_debut' => $request->heure_debut,
        'heure_fin' => $heure_fin,
        'type_seance' => $request->type_seance,
        'groupe' => $request->groupe,
        'semestre' => $request->semestre,
        'annee_universitaire' => $annee,
        'niveau_id' => $request->niveau_id,
    ]);

    return redirect()->route('coordinateur.et', [
        'semestre' => $request->semestre,
        'niveau' => $request->niveau_id,
    ])->with('success', 'Séance ajoutée avec succès.');
}
}