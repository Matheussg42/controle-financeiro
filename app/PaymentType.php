<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    
    protected $fillable = ['name','limit','user_id'];

    /**
     * Get the user that owns the vehicle.
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
