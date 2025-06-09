<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class groupe extends Model
{
    protected $fillable = [
        'nom','niveau_id','type'
    ];
     public function niveau()
         {
             return $this->belongsTo(niveau::class, 'niveau_id');
         }
    public function chargeHoraires()
    {
        return $this->hasMany(ChargeHoraire::class);
    }

    public function affectations()
    {
        return $this->hasManyThrough(
            Affectation::class,
            ChargeHoraire::class,
            'groupe_id',
            'id',
            'id',
            'affectation_id'
        );
    }
}
