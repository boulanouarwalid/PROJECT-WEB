<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'ue_id',
        'session_type',
        'academic_year',
        'file_path',
        'professor_id'
    ];

    public function ue()
    {
        return $this->belongsTo(Ues::class , 'ue_id');
    }

    public function professor()
    {
        return $this->belongsTo(utilisateurs::class, 'professor_id');
    }

}
