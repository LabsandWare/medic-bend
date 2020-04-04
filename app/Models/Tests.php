<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_name', 'test_description'
        ,'observation', 'result_summary'
        ,'result_image', 'user_id'
    ];

    /**
     * The users that belong to the role.
     */
    public function drugs()
    {
        return $this->belongsToMany('App\Models\Drug');
    }


    /**
     * Get the user that are pharmacy.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}