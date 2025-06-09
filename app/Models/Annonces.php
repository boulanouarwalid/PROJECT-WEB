<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonces extends Model
{
    protected $table = 'annonces';
    protected $fillable = ['id' ,'titre' , 'Description' , 'service' , 'file' , 'name' , 'type' ,'tail'];
    use HasFactory;
}
