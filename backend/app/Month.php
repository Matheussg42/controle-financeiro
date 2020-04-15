<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    
    protected $fillable = ['user_id','yearMonth','ticket','received','paid', 'total', 'status'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function payment(){
        return $this->hasMany('App\Payment');
    }
    
    public function income(){
        return $this->hasMany('App\Income');
    }
}
