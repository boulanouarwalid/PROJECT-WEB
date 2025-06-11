<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AffectationController extends Controller
{
    public function getByEnseignant(Utilisateur $enseignant)
{
    return response()->json(
        $enseignant->affectations()->with('ue')->get()
    );
}
}
