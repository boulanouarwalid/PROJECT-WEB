<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupeEnseignement extends Model
{
    protected $fillable = [
        'groupe_id','affectation_id'
    ];
        public function affectation()
         {
             return $this->belongsTo(affectation::class, 'affectation_id');
         }
          public function groupe()
         {
             return $this->belongsTo(groupe::class, 'groupe_id');
         }
         
}
