<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateurs;
use App\Models\affectations;

class AffectationController extends Controller
{
    public function getByEnseignant(Utilisateurs $enseignant)
    {
        return response()->json(
            $enseignant->affectations()->with('ue')->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prof_id' => 'required|exists:utilisateurs,id',
            'ue_id' => 'required|exists:ues,id',
            'type' => 'required|in:cours,td,tp',
            'heures_cm' => 'nullable|integer|min:0',
            'heures_td' => 'nullable|integer|min:0',
            'heures_tp' => 'nullable|integer|min:0',
            'annee_universitaire' => 'required|string',
        ]);

        $affectation = affectations::create([
            'prof_id' => $validated['prof_id'],
            'ue_id' => $validated['ue_id'],
            'type' => $validated['type'],
            'heures_cm' => $validated['heures_cm'] ?? 0,
            'heures_td' => $validated['heures_td'] ?? 0,
            'heures_tp' => $validated['heures_tp'] ?? 0,
            'annee_universitaire' => $validated['annee_universitaire'],
            'affecter_par' => auth()->id(),
            'status' => 'active'
        ]);

        return response()->json($affectation->load(['professeur', 'ue']));
    }

    public function destroy(affectations $affectation)
    {
        $affectation->delete();
        return response()->json(['message' => 'Affectation supprimée avec succès']);
    }
}
