<?php

namespace App\Imports;

use App\Models\Ues;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UEsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $user = auth()->user();
        $departement = $user ? $user->currentCoordinatedDepartement() : null;
        $filiere = $user ? $user->currentCoordinatedFiliere() : null;
        

        foreach ($rows as $row) {
            if (empty($row['nom_ue']) || empty($row['semestre'])) continue;
            $code = app(\App\Http\Controllers\UeController::class)->generateUeCode($departement, $row['semestre']);
            $Ue=Ues::create([
                'nom' => $row['nom_ue'],
                'code' => $code,
                'heures_cm' => $row['cm'] ?? 0,
                'heures_td' => $row['td'] ?? 0,
                'heures_tp' => $row['tp'] ?? 0,
                'semestre' => $row['semestre'],
                'annee_universitaire' => date('Y').'-'.(date('Y')+1),
                'est_vacant' => true,
                'responsable_id' => null,
                'groupes_td' => $row['groupes_td'] ?? 0,
                'groupes_tp' => $row['groupes_tp'] ?? 0,
                // Determine niveau_id based on filiere and semestre
                'niveau_id' => (function() use ($row, $filiere) {
                    $semestreGroup = in_array($row['semestre'], ['S1', 'S2']) ? 1 : (in_array($row['semestre'], ['S3', 'S4']) ? 2 : (in_array($row['semestre'], ['S5', 'S6']) ? 3 : null));
                    if (!$filiere || !$semestreGroup) return null;
                    $niveau = \App\Models\niveau::where('filiere_id', $filiere->id)
                        ->where('nom', 'LIKE', '%'.$semestreGroup)
                        ->first();
                    return $niveau ? $niveau->id : null;
                })(),
                'filiere_id' => $filiere->id,
                'department_id' => $departement->id,
                'program' => null,
            ]);
        }
    }
}
