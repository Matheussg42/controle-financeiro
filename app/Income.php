<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['user_id','month_id','value','name','comment'];

    public function month(){
        return $this->belongsTo('App\User');
    }
}
