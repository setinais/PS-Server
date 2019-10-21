<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    protected $fillable = [
        'latitude', 'longitude'
    ];

    public function localrisco(){
        return $this->hasOne('App\LocalRisco');
    }
}
