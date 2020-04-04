<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /**
     * The users that belong to the role.
     */
    public function drugs()
    {
        return $this->belongsToMany('App\Models\Drug');
    }

    /**
     * Get the user that are patient.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}