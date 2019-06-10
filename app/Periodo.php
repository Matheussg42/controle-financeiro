<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    
    protected $fillable = ['user_id','ano_mes','refeicao','lucro','despesa', 'total', 'status'];

    /**
     * Get the user that owns the vehicle.
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
