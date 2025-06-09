<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContrainteEnseignant extends Model
{
    use HasFactory;

    protected $table = 'contraintes_enseignants';

    protected $fillable = [
        'enseignant_id',
        'jour',
        'heure_debut',
        'heure_fin',
        'raison'
    ];

    protected $casts = [
        'heure_debut' => 'datetime:H:i',
        'heure_fin' => 'datetime:H:i',
    ];

    /**
     * Get the enseignant that owns the constraint
     */
    public function enseignant()
    {
        return $this->belongsTo(Utilisateur::class, 'enseignant_id');
    }

    /**
     * Check if constraint is active for a given time slot
     */
    public function isActiveForTimeSlot($day, $startTime, $endTime)
    {
        return $this->jour === $day &&
               $this->heure_debut <= $endTime &&
               $this->heure_fin >= $startTime;
    }
}