<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    
    protected $fillable = ['user_id','name','expireDate','value','installments'];

    /**
     * Get the user that owns the vehicle.
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
