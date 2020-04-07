<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use  HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'email', 'password', 'lastname', 
        'username', 'uuid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the doctors as user.
     */
    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor');
    }

    /**
     * Get the patients as user.
     */
    public function patients()
    {
        return $this->hasMany('App\Models\Patient');
    }


    /**
     * Get the labs as user.
     */
    public function labs()
    {
        return $this->hasMany('App\Models\Lab');
    }


    /**
     * Get the pharmacies as user.
     */
    public function pharmacies()
    {
        return $this->hasMany('App\Models\Phamarcy');
    }

    /**
     * Get the hospitals as user.
     */
    public function hospitals()
    {
        return $this->hasMany('App\Models\Hospital');
    }


     /**
     * Get the address record associated with the user.
     */
    public function address()
    {
        return $this->hasOne('App\Models\Address');
    }

}
