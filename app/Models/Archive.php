<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $table='archives';
    protected $fillable = ['id', 'Nomfile', 'Objectif', 'pathfile', 'service', 'type' , 'tail'];
}
