<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Spatial;

class LocalRisco extends Model
{
    use SoftDeletes, Spatial;

    protected $spatial = ['localizacao'];
    protected $dates = ['deleted_at'];


    public function location(){
        return $this->belongsTo('App\Location');
    }
}
