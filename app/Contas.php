<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    
    protected $fillable = ['user_id','nome','vencimento','valor','variacao'];

    /**
     * Get the user that owns the vehicle.
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
