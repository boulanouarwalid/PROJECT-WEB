<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class salle extends Model
{
    protected $fillable = [
        'nom','type','capacite'
    ];
    public function emploisDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }

    /**
     * Get the constraints for this room
     */
    public function contraintes()
    {
        return $this->hasMany(ContrainteSalle::class);
    }

    /**
     * Check if room is available at given time
     */
    public function isAvailable($jour, $heureDebut, $heureFin, $ignoreId = null)
    {
        // Check against scheduled sessions
        $conflict = $this->emploisDuTemps()
            ->where('jour', $jour)
            ->where(function($query) use ($heureDebut, $heureFin) {
                $query->whereBetween('heure_debut', [$heureDebut, $heureFin])
                    ->orWhereBetween('heure_fin', [$heureDebut, $heureFin])
                    ->orWhere(function($q) use ($heureDebut, $heureFin) {
                        $q->where('heure_debut', '<=', $heureDebut)
                          ->where('heure_fin', '>=', $heureFin);
                    });
            });

        if ($ignoreId) {
            $conflict->where('id', '!=', $ignoreId);
        }

        // Check against room constraints
        $constraintConflict = $this->contraintes()
            ->where('jour', $jour)
            ->where(function($query) use ($heureDebut, $heureFin) {
                $query->whereBetween('heure_debut', [$heureDebut, $heureFin])
                    ->orWhereBetween('heure_fin', [$heureDebut, $heureFin])
                    ->orWhere(function($q) use ($heureDebut, $heureFin) {
                        $q->where('heure_debut', '<=', $heureDebut)
                          ->where('heure_fin', '>=', $heureFin);
                    });
            });

        return !$conflict->exists() && !$constraintConflict->exists();
    }
}
