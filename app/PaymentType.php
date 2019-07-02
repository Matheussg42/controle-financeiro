<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    
    protected $fillable = ['name','limit','user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
