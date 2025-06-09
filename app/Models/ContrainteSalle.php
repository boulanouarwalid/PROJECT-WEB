<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContrainteSalle extends Model
{
    use HasFactory;

    protected $table = 'contraintes_salles';

    protected $fillable = [
        'salle_id',
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
     * Get the salle that owns the constraint
     */
    public function salle()
    {
        return $this->belongsTo(Salle::class);
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