<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avaliacao extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tempo_de_espera', 'estrutura', 'servidor_publico', 'informacoe_id', 'user_id'
    ];

    public function informacoe(){
        return $this->hasOne('App\Informacoe');
    }
}
