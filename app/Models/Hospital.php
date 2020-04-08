<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drugs extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_name', 'medication'
        ,'dosage', 'quantity'
        ,'provider_name', 'action'
    ];


    /**
     * Get the patients for doctor.
     */
    public function patients()
    {
        return $this->hasMany('App\Models\Patient');
    }

    /**
     * Get the user that are doctors.
     */
    public function doctors()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    /**
     * Get the user that are pharmacies.
     */
    public function pharmacy()
    {
        return $this->belongsTo('App\Models\Pharmacy');
    }

    /**
     * Get the user that are doctor.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'foreign_key');
    }

}
