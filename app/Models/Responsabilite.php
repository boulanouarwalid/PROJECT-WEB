<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Responsabilite extends Model
{
    protected $table = 'responsabilite';
    protected $fillable = ['id' ,'idProf' , 'Nomprof' , 'prenomprof' , 'CIN' , 'Responsabilite' ,'idd' ,'idf', 'created_at'];

    use HasFactory;
    public function professeur()
    {
        return $this->belongsTo(utilisateur::class, 'idProf');
    }

    public function filieres()
    {
        return $this->belongsTo(filieres::class, 'idf');
    }

    public function departement()
    {
        return $this->belongsTo(departement::class, 'idd');
    }
}
