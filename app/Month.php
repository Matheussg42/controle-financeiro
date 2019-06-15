<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    
    protected $fillable = ['user_id','yearMonth','ticket','received','paid', 'total', 'status'];

    /**
     * Get the user that owns the vehicle.
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
