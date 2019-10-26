<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Spatial;

class Informacoe extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function avaliacaos(){
        return $this->hasMany('App\Avaliacao');
    }
}
