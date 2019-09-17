<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    public function month(){
        return $this->hasMany('App\Month');
    }
    
    public function bill(){
        return $this->hasMany('App\Bill');
    }

    public function paymentType(){
        return $this->hasMany('App\PaymentType');
    }

    public function paymentInstallments(){
        return $this->hasMany('App\PaymentInstallments');
    }

    public function payment(){
        return $this->hasMany('App\Payment');
    }

    public function incomeInstallments(){
        return $this->hasMany('App\IncomeInstallments');
    }

    public function income(){
        return $this->hasMany('App\Income');
    }
}
