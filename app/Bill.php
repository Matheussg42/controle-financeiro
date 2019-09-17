<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    
    protected $fillable = ['user_id','name','expireDate','value','installments'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
