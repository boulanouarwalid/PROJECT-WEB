<?php
     namespace App\Models;

     use Illuminate\Database\Eloquent\Model;

     class ChargeHoraire extends Model
     {
         protected $fillable = [
             'affectation_id',
             'volume_horaire',
             'commentaires',
             'completed_hours',
             'is_completed',
            'heures_semaine',
            'groupe_id',
            'date_debut','date_fin'
         ];

         public function affectation()
         {
             return $this->belongsTo(Affectation::class, 'affectation_id');
         }
          public function groupe()
        {
            return $this->belongsTo(Groupe::class);
        }
     }