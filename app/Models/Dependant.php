<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dependants extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
     'gender', 'relationship',
      'age', 'genotype',
      'blood_group'
    ];


    /**
     * Get the patient as user.
     */
    public function patient()
    {
        return $this->belongsTo('App\Models\Patients');
    }

}
