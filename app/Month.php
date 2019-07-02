<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    
    protected $fillable = ['user_id','yearMonth','ticket','received','paid', 'total', 'status'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
