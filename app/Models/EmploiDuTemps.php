<?php

// app/Models/EmploiDuTemps.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmploiDuTemps extends Model
{
    protected $fillable = [
        'ue_id',
        'enseignant_id',
        'salle_id',
        'niveau_id',
        'jour',
        'heure_debut',
        'heure_fin',
        'type_seance',
        'groupe',
        'semestre',
        'annee_universitaire'
    ];

    public function ue()
    {
        return $this->belongsTo(Ues::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Utilisateurs::class, 'enseignant_id');
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
}
