<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialite extends Model
{
    use HasFactory;
    protected $table = 'specialites' ;
    protected $fillable = ['id' , 'Nom' ,'idDepartement' , 'description'];

}
