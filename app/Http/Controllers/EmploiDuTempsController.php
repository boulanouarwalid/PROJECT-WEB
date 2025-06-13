<?php

namespace App\Http\Controllers;

use App\Models\EmploiDuTemps;
use App\Models\Salle;
use App\Models\Ues;
use App\Models\Utilisateurs;
use App\Models\niveau;
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

    // Get available semesters and niveaux based on filière
    $niveaux = niveau::where('filiere_id', $filiere->id)->get();
    $semesters = ['S1', 'S2', 'S3', 'S4', 'S5', 'S6'];

    // Get selected filters (or defaults)
    $selectedSemestre = $request->get('semestre', 'S1');
    $selectedNiveau = $request->get('niveau', $niveaux->first()->id ?? null);
    // Get all UEs for the filiere, grouped by semestre for filtering
    $allUes = ues::where('filiere_id', $filiere->id)->get();
    $uesBySemestre = $allUes->groupBy('semestre');

    // Get UEs for the selected semestre
    $ues = $allUes->where('semestre', $selectedSemestre);
    
    $enseignants = Utilisateurs::where('deparetement', $user->currentCoordinatedDepartement()->nom)
        ->whereIn('role',['profiseur','vacataire']) 
        ->get();
    $salles = Salle::where('department_id', $user->currentCoordinatedDepartement()->id)->get();
    $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    $creneaux = [
        ['08:30:00', '10:30:00'],
        ['10:30:00', '12:30:00'],
        ['14:30:00', '16:30:00'],
        ['16:30:00', '18:30:00'],
    ];

    $emplois = EmploiDuTemps::where('semestre', $selectedSemestre)
        ->where('annee_universitaire', date('Y').'-'.(date('Y')+1))
        ->where('niveau_id', $selectedNiveau)
        ->get();

    return view('coordinateur.ET',
        compact('jours', 'creneaux', 'emplois', 'niveaux', 'semesters',
                'selectedSemestre', 'selectedNiveau', 'ues', 'uesBySemestre', 'allUes', 'enseignants', 'salles'));
}










public function show($id)
{
    try {
        $emploi = EmploiDuTemps::with(['ue', 'enseignant', 'salle', 'niveau'])->findOrFail($id);
        return response()->json($emploi);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Séance non trouvée']);
    }
}

public function update(Request $request, $id)
{
    $request->validate([
        'ue_id' => 'required|exists:ues,id',
        'enseignant_id' => 'required|exists:utilisateurs,id',
        'salle_id' => 'required|exists:salles,id',
        'jour' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi,samedi',
        'heure_debut' => 'required',
        'heure_fin' => 'required',
        'type_seance' => 'required|in:cours,td,tp',
    ]);

    try {
        $emploi = EmploiDuTemps::findOrFail($id);
        $emploi->update([
            'ue_id' => $request->ue_id,
            'enseignant_id' => $request->enseignant_id,
            'salle_id' => $request->salle_id,
            'jour' => $request->jour,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'type_seance' => $request->type_seance,
        ]);

        return response()->json(['success' => true, 'message' => 'Séance mise à jour avec succès']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Erreur lors de la mise à jour: ' . $e->getMessage()]);
    }
}

public function destroy($id)
{
    try {
        $emploi = EmploiDuTemps::findOrFail($id);
        $emploi->delete();

        return response()->json(['success' => true, 'message' => 'Séance supprimée avec succès']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Erreur lors de la suppression: ' . $e->getMessage()]);
    }
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

    // Get UEs for the filiere and selected semestre
    $ues = Ues::where('filiere_id', $filiere->id)
        ->where('semestre', $selectedSemestre)
        ->get();

    // Get enseignants (both professors and vacataires)
    $enseignants = Utilisateurs::where('deparetement', $departement->nom)
        ->whereIn('role', ['profiseur', 'vacataire'])
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
    try {
        // Validate the request data
        $validated = $request->validate([
            'ue_id' => 'required|exists:ues,id',
            'enseignant_id' => 'required|exists:utilisateurs,id',
            'salle_id' => 'required|exists:salles,id',
            'jour' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi,samedi',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'type_seance' => 'required|in:cours,td,tp',
            'niveau_id' => 'nullable|integer|exists:niveaux,id',
        ]);

        // Map time slots to their end times (if not provided)
        $creneaux = [
            '08:30:00' => '10:30:00',
            '10:30:00' => '12:30:00',
            '14:30:00' => '16:30:00',
            '16:30:00' => '18:30:00',
        ];

        $heure_fin = $request->heure_fin ?? ($creneaux[$request->heure_debut] ?? $request->heure_debut);
        $annee = date('Y') . '-' . (date('Y') + 1);

        // Get UE to determine niveau and semestre if not provided
        $ue = ues::find($request->ue_id);
        $niveau_id = $request->niveau_id ?? $ue->niveau_id ?? 1;
        $semestre = $request->semestre ?? $ue->semestre ?? 'S1';

        // Check for conflicts
        $conflictSalle = EmploiDuTemps::where('salle_id', $request->salle_id)
            ->where('jour', $request->jour)
            ->where('heure_debut', $request->heure_debut)
            ->where('annee_universitaire', $annee)
            ->exists();

        if ($conflictSalle) {
            $message = 'Cette salle est déjà utilisée dans ce créneau.';
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $message]);
            }
            return back()->withErrors(['salle_id' => $message])->withInput();
        }

        $conflictProf = EmploiDuTemps::where('enseignant_id', $request->enseignant_id)
            ->where('jour', $request->jour)
            ->where('heure_debut', $request->heure_debut)
            ->where('annee_universitaire', $annee)
            ->exists();

        if ($conflictProf) {
            $message = 'Cet enseignant a déjà une séance à ce moment.';
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $message]);
            }
            return back()->withErrors(['enseignant_id' => $message])->withInput();
        }

        // Create the timetable entry
        $createData = [
            'ue_id' => $request->ue_id,
            'enseignant_id' => $request->enseignant_id,
            'salle_id' => $request->salle_id,
            'niveau_id' => $niveau_id,
            'jour' => $request->jour,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $heure_fin,
            'type_seance' => $request->type_seance,
            'groupe' => null,
            'semestre' => $semestre,
            'annee_universitaire' => $annee,
        ];

        $emploi = EmploiDuTemps::create($createData);

        // Return appropriate response
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Séance ajoutée avec succès']);
        }

        return redirect()->route('coordinateur.et', [
            'semestre' => $semestre,
            'niveau' => $niveau_id
        ])->with('success', 'Séance ajoutée avec succès!');

    } catch (\Exception $e) {
        \Log::error('=== EMPLOI DU TEMPS STORE ERROR ===');
        \Log::error('Exception message: ' . $e->getMessage());
        \Log::error('Exception trace: ' . $e->getTraceAsString());

        $message = 'Erreur lors de l\'ajout: ' . $e->getMessage();
        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => $message]);
        }
        return back()->withErrors(['general' => $message])->withInput();
    }
}
}