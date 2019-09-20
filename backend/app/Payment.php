<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['user_id','yearMonth','type_id','value','name', 'comment'];

    public function month(){
        return $this->belongsTo('App\User');
    }
}
