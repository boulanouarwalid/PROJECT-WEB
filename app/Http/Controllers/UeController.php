<?php
namespace App\Http\Controllers;


use App\Models\Utilisateurs;
use App\Models\ues;
use App\Models\filieres;
use App\Models\affectations;
use App\Models\Departement;
use App\Models\niveau;
use App\Models\ChargeHoraire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\UEsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;





class UeController extends Controller
{


 public function import(Request $request)
    {
        $request->validate([
            'ue_file' => 'required|file|mimes:xlsx,xls',
        ]);
        try {
            Excel::import(new UEsImport(), $request->file('ue_file'));
            return redirect()->route('coordinateur.ues.index')->with('success', 'Importation réussie !');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }


    // Show the form for creating a new UE
public function create()
{
    $user = Auth::user();
    $departement = $user->currentCoordinatedDepartement();
    $filiere = $user->currentCoordinatedFiliere();

    $niveaux = niveau::where('filiere_id',$filiere->id)
                ->get();

    if (!$departement || !$filiere) {
        abort(403, "Vous n'êtes pas autorisé à créer des UEs car vous n'êtes pas coordinateur d'une filière.");
    }
    if($departement->id==1){
        $departementNOM=['Mathématiques et Informatique'];
    }elseif ($departement->id==2) {
         $departementNOM=['Génie Civil Energétique et Environnement '];
    }

    $enseignants = utilisateurs::where('deparetement', $departementNOM)
                         ->whereIn('role', ['prof', 'vacataire'])
                         ->get();

    return view('coordinateur.ues.create', [
        'departement' => $departement,
        'filiere' => $filiere, // Pass the single filiere
        'enseignants' => $enseignants,
        'niveaux'=> $niveaux
    ]);
}

    // Store a newly created UE
 public function store(Request $request)
{
    $user = Auth::user();
    $departement = $user->currentCoordinatedDepartement();
    $filiere = $user->currentCoordinatedFiliere();

    if (!$departement || !$filiere) {
        abort(403, "Vous n'êtes pas autorisé à créer des UEs car vous n'êtes pas coordinateur d'une filière.");
    }



    // Validate the request data
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'semestre' => 'required|in:S1,S2,S3,S4,S5,S6',
        'annee_universitaire' => 'required|string|max:9',
        'heures_cm' => 'required|integer|min:0',
        'heures_td' => 'required|integer|min:0',
        'heures_tp' => 'required|integer|min:0',
        'groupes_td' => 'required|integer|min:0',
        'groupes_tp' => 'required|integer|min:0',
        'niveau_id' => 'required|integer|exists:niveaux,id',

    ]);

    // Generate automatic UE code
    $autoCode = $this->generateUeCode($departement, $request->semestre);

    // Check if responsable is from the same department
    if ($request->filled('responsable_id')) {
        $responsable = Utilisateurs::find($request->responsable_id);

    }
    // Create the UE with automatic filiere assignment
    $ue = ues::create([
        'nom' => $validatedData['nom'],
        'code' => $autoCode,
        'heures_cm' => $validatedData['heures_cm'],
        'heures_td' => $validatedData['heures_td'],
        'heures_tp' => $validatedData['heures_tp'],
        'semestre' => $validatedData['semestre'],
        'annee_universitaire' => $validatedData['annee_universitaire'],
        'est_vacant' => !$request->filled('responsable_id'),
        'groupes_td' => $validatedData['groupes_td'],
        'groupes_tp' => $validatedData['groupes_tp'],
        'niveau_id' => $validatedData['niveau_id'],
        'filiere_id' => $filiere->id, // Automatically assigned
        'department_id' => $departement->id,
        'responsable_id' => null,

    ]);


    // If there's a responsable, create affectations
    if ($request->filled('responsable_id')) {
        $affectations=$this->createResponsableAffectations($ue, $request->responsable_id, $user->id);
    }


    return redirect()->route('coordinateur.ues.index')->with('success', 'UE créée avec succès.');
}
public function deleteAll()
{
    $filiere = auth()->user()->currentCoordinatedFiliere();
    if ($filiere) {
        $ues = \App\Models\ues::where('filiere_id', $filiere->id)->get();
        foreach ($ues as $ue) {
            // Delete related charge horaires first
            if (method_exists($ue, 'affectations')) {
                $affectations = $ue->affectations()->get();
                foreach ($affectations as $affectation) {
                    ChargeHoraire::where('affectation_id', $affectation->id)->delete();
                }
            }

            // Delete related wishes
            if (method_exists($ue, 'wishes')) {
                $ue->wishes()->delete();
            }
            // Delete related affectations
            if (method_exists($ue, 'affectations')) {
                $ue->affectations()->delete();
            }
            // Delete related notes
            if (method_exists($ue, 'notes')) {
                $ue->notes()->delete();
            }
            // Add more related deletions as needed
        }
        // Now delete the UEs
        \App\Models\ues::where('filiere_id', $filiere->id)->delete();
    }
    return redirect()->route('coordinateur.ues.index')->with('success', 'Toutes les UEs et leurs dépendances ont été supprimées.');
}
public function importForm() {
    return view('coordinateur.ues.import');
}
    // Generate automatic UE code
public function generateUeCode($departement, $semestre)
{
    // Get department prefix (first 3 letters of specialite)
    $depPrefix = strtoupper(substr($departement->specialite, 0, 3));

    // Get semester number (1-6)
    $semNum = substr($semestre, 1);

    // Get last 2 digits of year
    $year = date('y');

    // Find the latest UE code with this department prefix
    $latestUe = ues::where('department_id', $departement->id)
                 ->where('code', 'like', $depPrefix.'-%')
                 ->orderBy('code', 'desc')
                 ->first();

    // Get next sequential number
    $nextNum = $latestUe ? (int) substr($latestUe->code, -3) + 1 : 1;

    // Format: DEP-S-NNN (total 8-10 chars)
    return sprintf("%s-%s-%03d",
                  $depPrefix,
                  $semNum,
                  $nextNum);
}

    // Create affectations for responsable
protected function createResponsableAffectations($ue, $responsableId, $adminId)
{
    $createdAffectations = [];

    // Check if the responsable is a vacataire
    $responsable = Utilisateurs::find($responsableId);
    $isVacataire = $responsable && $responsable->role === 'vacataire';

    // CM
    $affectationCM = affectations::create([
        'annee_universitaire' => $ue->annee_universitaire,
        'type' => 'cours',
        'prof_id' => $responsableId,
        'ue_id' => $ue->id,
        'affecter_par' => $adminId,
        'status' => 'active',
        'heures_cm' => $ue->heures_cm,
        'heures_td' => 0,
        'heures_tp' => 0
    ]);
    $createdAffectations[] = $affectationCM;

    // Create charge horaire for vacataire CM
    if ($isVacataire && $ue->heures_cm > 0) {
        $this->createChargeHoraire($affectationCM, $ue->heures_cm, 'CM');
    }

    // TD
    if ($ue->heures_td > 0) {
        $affectationTD = affectations::create([
            'annee_universitaire' => $ue->annee_universitaire,
            'type' => 'td',
            'prof_id' => $responsableId,
            'ue_id' => $ue->id,
            'affecter_par' => $adminId,
            'status' => 'active',
            'heures_cm' => 0,
            'heures_td' => $ue->heures_td,
            'heures_tp' => 0
        ]);
        $createdAffectations[] = $affectationTD;

        // Create charge horaire for vacataire TD
        if ($isVacataire) {
            $this->createChargeHoraire($affectationTD, $ue->heures_td, 'TD');
        }
    }

    // TP
    if ($ue->heures_tp > 0) {
        $affectationTP = affectations::create([
            'annee_universitaire' => $ue->annee_universitaire,
            'type' => 'tp',
            'prof_id' => $responsableId,
            'ue_id' => $ue->id,
            'affecter_par' => $adminId,
            'status' => 'active',
            'heures_cm' => 0,
            'heures_td' => 0,
            'heures_tp' => $ue->heures_tp
        ]);
        $createdAffectations[] = $affectationTP;

        // Create charge horaire for vacataire TP
        if ($isVacataire) {
            $this->createChargeHoraire($affectationTP, $ue->heures_tp, 'TP');
        }
    }

    return $createdAffectations;
}

/**
 * Create charge horaire entry for vacataire affectation
 */
protected function createChargeHoraire($affectation, $volumeHoraire, $typeEnseignement)
{
    ChargeHoraire::create([
        'affectation_id' => $affectation->id,
        'volume_horaire' => $volumeHoraire,
        'completed_hours' => 0,
        'is_completed' => false,
        'commentaires' => "Charge horaire automatique pour {$typeEnseignement} - UE: " . $affectation->ue->nom,
        'heures_semaine' => ceil($volumeHoraire / 16), // Assuming 16 weeks per semester
        'date_debut' => now(),
        'date_fin' => now()->addMonths(4) // Assuming 4 months semester
    ]);
}

public function index(Request $request)
    {
        $filiere = auth()->user()->currentCoordinatedFiliere();
        if (!$filiere) {
            abort(403, "Vous n'êtes pas coordinateur d'une filière actuellement.");
        }
        $niveaux = niveau::where('filiere_id', $filiere->id)->get();

        // Get all unique semesters and years for filter dropdowns
        $allSemestres = ues::where('filiere_id', $filiere->id)->distinct()->pluck('semestre')->filter()->unique()->sort()->values();
        $allAnnees = ues::where('filiere_id', $filiere->id)->distinct()->pluck('annee_universitaire')->filter()->unique()->sortDesc()->values();

        $query = ues::where('filiere_id', $filiere->id)
            ->with([
                'responsable',
                'filiere',
                'departement',
                'affectations' => function($query) {
                    $query->orderBy('created_at', 'desc');
                }
            ]);


        if ($request->filled('semestre')) {
            $query->where('semestre', $request->semestre);
        }
        if ($request->filled('annee')) {
            $query->where('annee_universitaire', $request->annee);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%$search%")
                  ->orWhere('code', 'like', "%$search%")
                  ->orWhereHas('responsable', function($r) use ($search) {
                      $r->where('firstName', 'like', "%$search%")
                        ->orWhere('lastName', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%") ;
                  });
            });
        }

        $ues = $query->orderBy('semestre')->orderBy('code')->get();

        return view('coordinateur.ues.index', compact('ues', 'filiere', 'niveaux', 'allSemestres', 'allAnnees'));
    }
public function edit(ues $ue)
{
    $filiere = auth()->user()->currentCoordinatedFiliere();
    $departement = auth()->user()->currentCoordinatedDepartement();



    $professeurs = utilisateurs::where('deparetement', $departement->nom)
                 ->where('role', 'vacataire') // Include both roles
                 ->orderBy('lastName')
                 ->orderBy('firstName')
                 ->get();
                

    return view('coordinateur.ues.edit', [
        'ue' => $ue,
        'professeurs' => $professeurs,
        'filiere' => $filiere,
        'departement' => $departement
    ]);
}

public function update(Request $request, ues $ue)
{
    // Authorization check
    $filiere = auth()->user()->currentCoordinatedFiliere();
    $departement = auth()->user()->currentCoordinatedDepartement();
    if (!$filiere || $ue->filiere_id !== $filiere->id || !$departement) {
        return redirect()->back()
            ->with('error', 'Non autorisé ou filière/département non correspondant');
    }

    try {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'semestre' => 'required|in:S1,S2,S3,S4,S5,S6',
            'annee_universitaire' => 'required|string|max:9',
            'responsable_id' => 'nullable|exists:utilisateurs,id',
            'heures_cm' => 'required|integer|min:0',
            'heures_td' => 'required|integer|min:0',
            'heures_tp' => 'required|integer|min:0',
            'type_enseignement' => 'required_if:responsable_id,!=,null|in:cours,td,tp',
            'est_vacant' => 'sometimes|boolean'
        ]);

        DB::beginTransaction();

        // Update UE
        $ue->update([
            'nom' => $validated['nom'],
            'semestre' => $validated['semestre'],
            'annee_universitaire' => $validated['annee_universitaire'],
            'responsable_id' => $validated['responsable_id'] ?? null,
            'heures_cm' => $validated['heures_cm'],
            'heures_td' => $validated['heures_td'],
            'heures_tp' => $validated['heures_tp'],
            'est_vacant' => $request->has('est_vacant')
        ]);

        // Handle affectations
        if (!empty($validated['responsable_id'])) {
            // Delete old affectations and their charge horaires for this UE
            $oldAffectations = affectations::where('ue_id', $ue->id)->get();
            foreach ($oldAffectations as $oldAffectation) {
                // Delete related charge horaires
                ChargeHoraire::where('affectation_id', $oldAffectation->id)->delete();
            }
            affectations::where('ue_id', $ue->id)->delete();

            // Check if the responsable is a vacataire
            $responsable = Utilisateurs::find($validated['responsable_id']);
            $isVacataire = $responsable && $responsable->role === 'vacataire';

            // Determine teaching types to assign
            $types = $this->determineTeachingTypes($validated);

            foreach ($types as $type) {
                $heures = $this->calculateHours($type, $validated);

                $affectation = affectations::create([
                    'annee_universitaire' => $validated['annee_universitaire'],
                    'type' => $type,
                    'prof_id' => $validated['responsable_id'],
                    'ue_id' => $ue->id,
                    'affecter_par' => auth()->id(),
                    'status' => 'brouillon',
                    'heures_cm' => $heures['heures_cm'],
                    'heures_td' => $heures['heures_td'],
                    'heures_tp' => $heures['heures_tp']
                ]);

                // Create charge horaire for vacataire
                if ($isVacataire) {
                    $volumeHoraire = $heures['heures_cm'] + $heures['heures_td'] + $heures['heures_tp'];
                    if ($volumeHoraire > 0) {
                        $typeLabel = strtoupper($type === 'cour' ? 'CM' : $type);
                        $this->createChargeHoraire($affectation, $volumeHoraire, $typeLabel);
                    }
                }
            }

        } else {
            // If no responsible, clear all affectations and their charge horaires
            $oldAffectations = affectations::where('ue_id', $ue->id)->get();
            foreach ($oldAffectations as $oldAffectation) {
                // Delete related charge horaires
                ChargeHoraire::where('affectation_id', $oldAffectation->id)->delete();
            }
            affectations::where('ue_id', $ue->id)->delete();
        }

        DB::commit();
        return redirect()->route('coordinateur.ues.index')
                       ->with('success', 'UE mise à jour avec succès');
                       
    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollBack();
        return back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Une erreur est survenue lors de la mise à jour: ' . $e->getMessage())->withInput();
    }
}

/**
 * Determine which teaching types should be assigned
 */
protected function determineTeachingTypes(array $validatedData): array
{
    // Si un type spécifique est sélectionné
    if (!empty($validatedData['type_enseignement'])) {
        // Convertir 'cours' du formulaire en 'cour' pour la DB
        $type = $validatedData['type_enseignement'] === 'cours' ? 'cour' : $validatedData['type_enseignement'];
        return [$type];
    }
    
    // Sinon, retourner tous les types avec heures > 0
    $types = [];
    if ($validatedData['heures_cm'] > 0) $types[] = 'cour';  // 'cour' pas 'cours'
    if ($validatedData['heures_td'] > 0) $types[] = 'td';
    if ($validatedData['heures_tp'] > 0) $types[] = 'tp';
    
    return $types;
}
protected function calculateHours($type, $validated)
{
    switch ($type) {
        case 'cour':
            return [
                'heures_cm' => (int)$validated['heures_cm'],
                'heures_td' => 0,
                'heures_tp' => 0
            ];
        case 'td':
            return [
                'heures_cm' => 0,
                'heures_td' => (int)$validated['heures_td'],
                'heures_tp' => 0
            ];
        case 'tp':
            return [
                'heures_cm' => 0,
                'heures_td' => 0,
                'heures_tp' => (int)$validated['heures_tp']
            ];
        default:
            return ['heures_cm' => 0, 'heures_td' => 0, 'heures_tp' => 0];
    }
}



public function destroy(ues $ue)
{
    $filiere = auth()->user()->currentCoordinatedFiliere();
    $departement = auth()->user()->currentCoordinatedDepartement();

    if (!$filiere || $ue->filiere_id !== $filiere->id || !$departement || $ue->department_id !== $departement->id) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    // Start database transaction
    DB::beginTransaction();

    try {
        // Delete related charge horaires first
        $affectations = $ue->affectations()->get();
        foreach ($affectations as $affectation) {
            ChargeHoraire::where('affectation_id', $affectation->id)->delete();
        }

        // Delete related affectations
        $ue->affectations()->delete();

        // Then delete the UE
        $ue->delete();

        // Commit transaction
        DB::commit();

        return redirect()->route('coordinateur.ues.index')
                       ->with('success', 'UE supprimée avec succès');

    } catch (\Exception $e) {
        // Rollback transaction on error
        DB::rollBack();

        return back()->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
    }
}

public function getByDepartement(Departement $departement)
{
    return response()->json($departement->ues);
}

public function show(ues $ue)
{
    $ue->load(['responsable', 'filiere', 'departement']);
    return view('coordinateur.ues.show', compact('ue'));
}
}
