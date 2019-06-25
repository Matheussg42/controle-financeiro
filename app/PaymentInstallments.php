<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentInstallments extends Model
{
    protected $fillable = ['name','type_id','value','comment','installments','begin','user_id'];

    /**
     * Get the user that owns the vehicle.
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
