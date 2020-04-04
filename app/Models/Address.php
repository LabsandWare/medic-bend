<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'address','city'
      ,'state', 'country'
      ,'phone'
    ];

    /**
     * Get the doctors as user.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
