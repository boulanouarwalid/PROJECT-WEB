<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wishe extends Model
{
    protected $fillable=[
        'user_id','ue_id','type','message','status','response',
        'responded_by','responded_at'
    ];
public function user() {
    return $this->belongsTo(Utilisateurs::class,'user_id');
}

public function ue() {
    return $this->belongsTo(ues::class,'ue_id');
}
}
