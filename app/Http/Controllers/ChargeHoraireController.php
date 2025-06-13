<?php

namespace App\Http\Controllers;

use App\Models\affectations;
use App\Models\ChargeHoraire;
use Illuminate\Http\Request;
use App\Models\Utilisateurs;
use App\Models\Ues;
use App\Models\Niveau;
use App\Models\filieres;
use App\Models\Groupe;
use App\Models\Departement;
use Carbon\Carbon;

class ChargeHoraireController extends Controller
{
    public function index()
    {
        $affectations = affectations::with(['ue', 'professeur', 'chargeHoraires'])
            ->where('prof_id', auth()->id())
            ->paginate(10);

        // Calculate charge totale for each affectation
        $affectations->getCollection()->transform(function ($affectation) {
            $affectation->charge_totale = $affectation->chargeHoraires->sum('volume_horaire');
            return $affectation;
        });

        $chargeMinimale = config('workload.min', 192);
        $chargeMaximale = config('workload.max', 300);

        // Calculate total charge from all affectations (not just current page)
        $allAffectations = affectations::with('chargeHoraires')
            ->where('prof_id', auth()->id())
            ->get();
        $chargeTotale = $allAffectations->sum(function($affectation) {
            return $affectation->chargeHoraires->sum('volume_horaire');
        });

        $alerteCharge = $chargeTotale < $chargeMinimale;

        return view('prof.charge-horaire.index', compact('affectations', 'chargeTotale', 'chargeMinimale', 'alerteCharge'));
    }

public function createprofaffectation(affectations $affectation = null)
{
    // Get the current user's department
    $currentUser = auth()->user();
    $departement = $currentUser->currentCoordinatedDepartement();

    // If no department found through responsibilities, use the user's department field
    if (!$departement) {
        $departementName = $currentUser->getDepartmentName();
    } else {
        $departementName = $departement->nom;
    }

    // Get professors and vacataires from the same department using the new model method
    $enseignants = Utilisateurs::byDepartmentAndRoles($departementName)->get();

    if($departementName == 'Mathématiques et Informatique'){
        $departementId=1;
    }else{
        $departementId=2;
    }
 

    $ues = Ues::where('departement_id', $departementId)
            ->with([ 'responsable', 'filiere', 'departement'])
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
        'departementName',
        'ues',
        'niveaux',
        'filteredGroups',
        'selectedType',
        'selectedNiveau'
    ));
}

public function storeprofaffectation(Request $request)
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
                $ue = Ues::find($request->ue_id);
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



    $ue = Ues::findOrFail($validated['ue_id']);

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

    $affectation = affectations::create([
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

    /**
     * Create affectation for professors with niveau and semester filtering
     */
    public function create(Request $request)
    {
        // Get the current user's department
        $currentUser = auth()->user();
        $departement = $currentUser->currentCoordinatedDepartement();

        // If no department found through responsibilities, use the user's department field
        if (!$departement) {
            $departementName = $currentUser->getDepartmentName();
            if($departementName == 'Mathematique/informatique'){
                $departementId=1;
            }else{
                $departementId=2;
            }
        } else {
            $departementName = $departement->nom;
        }
       
        // Get professors and vacataires from the same department
        $enseignants = Utilisateurs::byDepartmentAndRoles($departementName)->get();
        
        // Get all filieres for the department
        $filieres = collect();
        
            $filieres = filieres::where('departement_id', $departementId)
                              ->orderBy('nom')
                              ->get();
        

        // Get selected filiere and semester from request
        $selectedFiliere = $request->get('filiere_id');
        $selectedSemester = $request->get('semestre');

        // Filter UEs based on filiere and semester
        $ues = collect();
        if ($selectedFiliere && $selectedSemester) {
            $ues = ues::where('filiere_id', $selectedFiliere)
                     ->where('semestre', $selectedSemester)
                     ->where(function($query) {
                         // Show UEs that are either vacant OR need additional TD/TP assignments
                         $query->where('est_vacant', true)
                               ->orWhereNull('responsable_id')
                               ->orWhere(function($q) {
                                   // UEs that still need TD/TP even if they have a responsable for CM
                                   $q->where('heures_td', '>', 0)
                                     ->orWhere('heures_tp', '>', 0);
                               });
                     })
                     ->with(['filiere', 'departement', 'responsable', 'affectations' => function($query) {
                         $query->where('annee_universitaire', date('Y') . '-' . (date('Y') + 1))
                               ->with('chargeHoraires');
                     }])
                     ->orderBy('code')
                     ->get()
                     ->map(function($ue) {
                         // Calculate remaining hours for each type
                         $assignedCM = $ue->affectations->where('type', 'cours')
                                         ->sum(function($affectation) {
                                             return $affectation->chargeHoraires->sum('volume_horaire');
                                         });
                         $assignedTD = $ue->affectations->where('type', 'td')
                                         ->sum(function($affectation) {
                                             return $affectation->chargeHoraires->sum('volume_horaire');
                                         });
                         $assignedTP = $ue->affectations->where('type', 'tp')
                                         ->sum(function($affectation) {
                                             return $affectation->chargeHoraires->sum('volume_horaire');
                                         });

                         $ue->remaining_cm = max(0, $ue->heures_cm - $assignedCM);
                         $ue->remaining_td = max(0, $ue->heures_td - $assignedTD);
                         $ue->remaining_tp = max(0, $ue->heures_tp - $assignedTP);

                         // Only show UEs that have remaining hours
                         $ue->has_remaining_hours = ($ue->remaining_cm > 0 || $ue->remaining_td > 0 || $ue->remaining_tp > 0);

                         return $ue;
                     })
                     ->filter(function($ue) {
                         return $ue->has_remaining_hours;
                     });
        }

        // Get groups for the selected filiere
        $groupes = collect();
        if ($selectedFiliere) {
            $groupes = groupe::whereHas('niveau', function($query) use ($selectedFiliere) {
                $query->where('filiere_id', $selectedFiliere);
            })
            ->orderBy('type')
            ->orderBy('nom')
            ->get();
        }

        return view('prof.charge-horaire.create', compact(
            'enseignants',
            'departement',
            'departementName',
            'filieres',
            'ues',
            'groupes',
            'selectedFiliere',
            'selectedSemester'
        ));
    }

    /**
     * Store affectation for professors
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'prof_id' => 'required|exists:utilisateurs,id',
            'ue_id' => 'required|exists:ues,id',
            'type_enseignement' => 'required|in:cours,td,tp',
            'annee_universitaire' => 'required|string|size:9',
            'heures_semaine' => 'required|integer|min:1',
            'date_debut' => 'required|date',
            'groupe_id' => 'nullable|exists:groupes,id',
            'commentaires' => 'nullable|string|max:1000',
        ]);

        // Get the UE
        $ue = ues::findOrFail($validated['ue_id']);

        // Automatically get all available hours for the selected type
        $totalHours = match($validated['type_enseignement']) {
            'cours' => $ue->heures_cm,
            'td' => $ue->heures_td,
            'tp' => $ue->heures_tp,
            default => 0
        };

        // Check if there are already affectations for this UE and type
        $existingAffectations = affectations::where('ue_id', $validated['ue_id'])
                                          ->where('type', $validated['type_enseignement'])
                                          ->where('annee_universitaire', $validated['annee_universitaire'])
                                          ->with('chargeHoraires')
                                          ->get()
                                          ->sum(function($affectation) {
                                              return $affectation->chargeHoraires->sum('volume_horaire');
                                          });

        // Calculate remaining hours
        $remainingHours = $totalHours - $existingAffectations;

        if ($remainingHours <= 0) {
            return back()->withErrors([
                'type_enseignement' => "Aucune heure disponible pour ce type d'enseignement. Toutes les heures sont déjà affectées."
            ])->withInput();
        }

        // Use all remaining hours as volume horaire
        $volumeHoraire = $remainingHours;

        try {
            \DB::beginTransaction();

            // Create the affectation
            $affectation = affectations::create([
                'prof_id' => $validated['prof_id'],
                'ue_id' => $validated['ue_id'],
                'type' => $validated['type_enseignement'],
                'annee_universitaire' => $validated['annee_universitaire'],
                'affecter_par' => auth()->id(),
                'status' => 'confirmée'
            ]);

            // Create charge horaire with all available hours
            ChargeHoraire::create([
                'affectation_id' => $affectation->id,
                'volume_horaire' => $volumeHoraire, // Use calculated available hours
                'heures_semaine' => $validated['heures_semaine'],
                'date_debut' => $validated['date_debut'],
                'date_fin' => Carbon::parse($validated['date_debut'])->addWeeks(15),
                'commentaires' => $validated['commentaires'] ?? null,
                'groupe_id' => $validated['groupe_id'] ?? null,
            ]);

            // Update UE responsable_id if this is a 'cours' affectation
            if ($validated['type_enseignement'] === 'cours') {
                $ue->update([
                    'responsable_id' => $validated['prof_id'],
                    'est_vacant' => false // Mark as no longer vacant
                ]);
            }

            \DB::commit();

            return redirect()->back()->with('success', "Affectation créée avec succès. {$volumeHoraire} heures ont été assignées pour " . strtoupper($validated['type_enseignement']) . ".");

        } catch (\Exception $e) {
            \DB::rollback();
            return back()->withErrors([
                'error' => 'Erreur lors de la création de l\'affectation: ' . $e->getMessage()
            ])->withInput();
        }
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

    /**
     * Get UEs filtered by type of enseignement (AJAX)
     */
    public function getUesByType(Request $request)
    {
        $request->validate([
            'filiere_id' => 'required|exists:filieres,id',
            'semestre' => 'required|in:S1,S2,S3,S4,S5',
            'type_enseignement' => 'required|in:cours,td,tp'
        ]);

        $ues = ues::where('filiere_id', $request->filiere_id)
                 ->where('semestre', $request->semestre)
                 ->with(['responsable', 'affectations' => function($query) {
                     $query->where('annee_universitaire', date('Y') . '-' . (date('Y') + 1))
                           ->with('chargeHoraires');
                 }])
                 ->get()
                 ->map(function($ue) use ($request) {
                     $type = $request->type_enseignement;
                     $assignedHours = $ue->affectations->where('type_enseignement', $type)
                                        ->sum(function($affectation) {
                                            return $affectation->chargeHoraires->sum('volume_horaire');
                                        });

                     $totalHours = match($type) {
                         'cours' => $ue->heures_cm,
                         'td' => $ue->heures_td,
                         'tp' => $ue->heures_tp,
                         default => 0
                     };

                     $remainingHours = max(0, $totalHours - $assignedHours);

                     return [
                         'id' => $ue->id,
                         'code' => $ue->code,
                         'nom' => $ue->nom,
                         'total_hours' => $totalHours,
                         'assigned_hours' => $assignedHours,
                         'remaining_hours' => $remainingHours,
                         'responsable' => $ue->responsable ?
                             $ue->responsable->firstName . ' ' . $ue->responsable->lastName :
                             'Vacant',
                         'has_remaining' => $remainingHours > 0
                     ];
                 })
                 ->filter(function($ue) {
                     return $ue['has_remaining'];
                 })
                 ->values();

        return response()->json($ues);
    }
}
