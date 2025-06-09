<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class affectations extends Model
{
    use HasFactory;
    protected $table = 'affectations' ;
    protected $fillable = ['id' ,'annee_universitaire' ,'status','prof_id' ,'ue_id' ,'affecter_par' ,'type'];
    

    public function professeur()
    {
        return $this->belongsTo(Utilisateurs::class, 'prof_id');
    }

    

    public function utilisateuraffect()
    {
        return $this->belongsTo(utilisateurs::class, 'affecter_par');

    }


    public function getChargeTotaleAttribute()
    {
        return $this->chargeHoraires()->sum('volume_horaire');

    }
   
     public function ue()
    {
        return $this->belongsTo(Ues::class, 'ue_id');
    }

    

    

    public function chargeHoraires()
    {
        return $this->hasMany(ChargeHoraire::class , "affectation_id");
    }

    public function groupeEnseignements()
    {
        return $this->hasMany(GroupeEnseignement::class);
}
}
