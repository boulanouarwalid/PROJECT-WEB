<?php

// app/Models/EmploiDuTemps.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmploiDuTemps extends Model
{
    protected $fillable = [
        'ue_id',
         'enseignant_id',
          'semestre',
          'jour',
        'heure_debut',
        'heure_fin',
        'salle_id',
        'type_cours',
        'annee_universitaire',
        'niveau_id'
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
        return $this->belongsTo(Utilisateurs::class, 'salle_id');
    }
}
