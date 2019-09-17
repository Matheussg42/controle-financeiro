<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeInstallments extends Model
{
    protected $fillable = ['user_id','name','value','comment','installments','begin'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
