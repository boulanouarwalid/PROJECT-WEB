<?php

namespace App\Http\Controllers;

use App\Models\Affectations;
use App\Models\ChargeHoraire;
use Illuminate\Http\Request;
use App\Models\Utilisateurs;
use App\Models\Ues;
use App\Models\Niveau;
use App\Models\Groupe;
use Carbon\Carbon;

class ChargeHoraireController extends Controller
{
    public function index()
    {
        $affectations = Affectations::with(['ue', 'professeur', 'chargeHoraires'])
            ->where('prof_id', auth()->id())
            ->get()
            ->map(function ($affectation) {
                $affectation->charge_totale = $affectation->chargeHoraires->sum('volume_horaire');
                return $affectation;
            });
            
        $chargeMinimale = config('workload.min', 192);
        $chargeMaximale = config('workload.max', 300);
        $chargeTotale = $affectations->sum('charge_totale');
        $alerteCharge = $chargeTotale < $chargeMinimale;

        return view('prof.charge-horaire.index', compact('affectations', 'chargeTotale', 'chargeMinimale', 'alerteCharge'));
    }

public function create(Affectation $affectation)
{
    $departement = auth()->user()->currentCoordinatedDepartement();
    
    if ($departement->id == 1) {
        $departementNOM = ['Mathématiques et Informatique'];
    } elseif ($departement->id == 2) {
        $departementNOM = ['Génie Civil Energétique et Environnement'];
    }
   
    $enseignants = Utilisateur::where('departements', $departementNOM)
                        ->whereIn('role', ['prof', 'vacataire'])
                        ->get();
                        
    $filiere = auth()->user()->currentCoordinatedFiliere();
    
    $ues = Ue::where('filiere_id', $filiere->id)
            ->with(['niveau', 'responsable', 'filiere', 'departement'])
            ->orderBy('semestre')
            ->orderBy('code')
            ->paginate(10);

    $niveaux = Niveau::where('filiere_id', $filiere->id)
                ->with(['groupes' => function($query) {
                    $query->orderBy('type')->orderBy('nom');
                }])
                ->get();

    // Get selected values from old input or request
    $selectedType = request('type_enseignement', old('type_enseignement'));
    $selectedNiveau = request('niveau_id', old('niveau_id'));
    
    // Filter groups based on selected type and niveau
    $filteredGroups = collect();
    if ($selectedType && in_array($selectedType, ['td', 'tp']) && $selectedNiveau) {
        $filteredGroups = Groupe::where('niveau_id', $selectedNiveau)
                            ->where('type', $selectedType)
                            ->orderBy('nom')
                            ->get();
    }

    return view('prof.charge-horaire.create', compact(
        'affectation', 
        'enseignants', 
        'departement', 
        'ues', 
        'niveaux',
        'filteredGroups',
        'selectedType',
        'selectedNiveau'
    ));
}

public function store(Request $request)
{
   
   

    // If this is just a form step submission
    if ($request->has('form_step')) {
        // Debug 2: Confirm form step handling
        
        
        return redirect()->back()->withInput();
    }


    $validated = $request->validate([
        'annee_universitaire' => 'required|string|size:9',
        'type_enseignement' => 'required|in:cours,td,tp',
        'prof_id' => 'required|exists:utilisateurs,id',
        'niveau_id' => 'required|exists:niveaux,id',
        'ue_id' => 'required|exists:ues,id',
        'affecter_par' => 'required|exists:utilisateurs,id',
       'groupe_id' => [
            'required_if:type_enseignement,td,tp',
            'nullable',
            'exists:groupes,id',
            function ($attribute, $value, $fail) use ($request) {
                if (in_array($request->type_enseignement, ['td', 'tp']) && empty($value)) {
                    $fail('Veuillez sélectionner un groupe pour ce type d\'enseignement.');
                } elseif ($value) {
                    $group = Groupe::find($value);
                    if (!$group || $group->niveau_id != $request->niveau_id) {
                        $fail('Le groupe sélectionné ne correspond pas au niveau choisi.');
                    }
                }
            }
        ],
        'volume_horaire' => [
            'required',
            'integer',
            'min:1',
            function ($attribute, $value, $fail) use ($request) {
                $ue = Ue::find($request->ue_id);
                $maxHours = match($request->type_enseignement) {
                    'cours' => $ue->heures_cm,
                    'td' => $ue->heures_td,
                    'tp' => $ue->heures_tp,
                    default => 0
                };
                if ($value > $maxHours) {
                    $fail("Le volume horaire ne peut pas dépasser {$maxHours}h pour ce type d'enseignement.");
                }
            }
        ],
        'heures_semaine' => 'required|integer|min:1',
        'date_debut' => 'required|date',
        'commentaires' => 'nullable|string|max:1000',
    ]);



    $ue = Ue::findOrFail($validated['ue_id']);

    // Debug 8: Check UE niveau match
    


    if ($ue->niveau_id != $validated['niveau_id']) {
        return back()->withErrors([
            'ue_id' => "L'UE sélectionnée n'appartient pas au niveau choisi."
        ])->withInput();
    }

    $assignedHours = ChargeHoraire::whereHas('affectation', function ($query) use ($validated) {
        $query->where('ue_id', $validated['ue_id'])
            ->where('annee_universitaire', $validated['annee_universitaire'])
            ->where('type_enseignement', $validated['type_enseignement']);
    })->sum('volume_horaire');

    $maxHours = match($validated['type_enseignement']) {
        'cours' => $ue->heures_cm,
        'td' => $ue->heures_td,
        'tp' => $ue->heures_tp,
        default => 0,
    };

  
   
    

    if ($assignedHours + $validated['volume_horaire'] > $maxHours) {
        return back()->withErrors([
            'volume_horaire' => "Le volume horaire total dépasse la limite autorisée ({$maxHours} heures)."
        ])->withInput();
    }

    $totalHours = ChargeHoraire::whereHas('affectation', function ($query) use ($validated) {
        $query->where('prof_id', $validated['prof_id'])
            ->where('annee_universitaire', $validated['annee_universitaire']);
    })->sum('volume_horaire');

    // Debug 10: Check professor workload


    if ($totalHours + $validated['volume_horaire'] > config('workload.max', 300)) {
        return back()->withErrors([
            'volume_horaire' => "La charge horaire totale du professeur dépasse le maximum autorisé."
        ])->withInput();
    }

    $affectation = Affectation::create([
        'annee_universitaire' => $validated['annee_universitaire'],
        'type_enseignement' => $validated['type_enseignement'],
        'prof_id' => $validated['prof_id'],
        'ue_id' => $validated['ue_id'],
        'affecter_par' => $validated['affecter_par'],
    ]);

 
  

    ChargeHoraire::create([
        'affectation_id' => $affectation->id,
        'volume_horaire' => $validated['volume_horaire'],
        'heures_semaine' => $validated['heures_semaine'],
        'date_debut' => $validated['date_debut'],
        'date_fin' => Carbon::parse($validated['date_debut'])->addWeeks(15),
        'commentaires' => $validated['commentaires'] ?? null,
        'groupe_id' => $validated['groupe_id'] ?? null,
    ]);

    return redirect()->back()->with('success', 'Affectation créée avec succès.');
}
    public function show(ChargeHoraire $chargeHoraire)
    {
        return view('prof.charge-horaire.show', compact('chargeHoraire'));
    }

    public function destroy(ChargeHoraire $chargeHoraire)
    {
        $chargeHoraire->delete();
        return back()->with('success', 'Séance supprimée avec succès');
    }
    public function getGroupes(Request $request)
        {
            $request->validate([
                'niveau_id' => 'required|exists:niveaux,id',
                'type' => 'required|in:td,tp'
            ]);

            $groupes = Groupe::where('niveau_id', $request->niveau_id)
                        ->where('type', $request->type)
                        ->orderBy('nom')
                        ->get(['id', 'nom']);

            return response()->json($groupes);
        }
}