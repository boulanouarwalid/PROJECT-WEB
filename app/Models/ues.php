<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ues extends Model
{
    use HasFactory;
    protected $table = 'ues' ;
    protected $fillable = ['nom' , 'code' , 'heures_cm' , 'heures_td' ,'heures_tp' ,'semestre' ,'annee_universitaire','est_vacant','groupes_td' ,'groupes_tp' ,'filiere_id' , 'department_id' , 'responsable_id'];



    // Relationships
    public function filiere()
    {
        return $this->belongsTo(filieres::class);
    }
    public function niveau()
    {
        return $this->belongsTo(niveau::class);
    }

    public function departement()
    {
        return $this->belongsTo(departement::class, 'department_id');
    }

    public function responsable()
    {
        return $this->belongsTo(utilisateurs::class, 'responsable_id');
    }
    public function affectations() 
    {
    return $this->hasMany(Affectations::class , 'ue_id');
    }
    // Dans Ue.php
    public function wishes() {
        return $this->hasMany(Wishe::class);
    }
      public function notes()
    {
        return $this->hasMany(note::class , 'ue_id');
}
}
