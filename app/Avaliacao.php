<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avaliacao extends Model
{
    use SoftDeletes;

    public function informacoe(){
        return $this->hasOne('App\Informacoe');
    }
}
