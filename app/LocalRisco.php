<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocalRisco extends Model
{
    use SoftDeletes;


    public function location(){
        return $this->belongsTo('App\Location');
    }
}
