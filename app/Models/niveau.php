<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class niveau extends Model
{
     protected $fillable = [
             'nom',
             'filiere_id',
         ];

         public function filiere()
         {
             return $this->belongsTo(filiere::class, 'filiere_id');
         }
        

    public function groupes()
    {
        return $this->hasMany(Groupe::class);
    }

    public function ues()
    {
        return $this->hasMany(Ue::class);
    }

}
