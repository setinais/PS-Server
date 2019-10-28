<?php

namespace App\Http\Controllers\Api;

use App\Avaliacao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AvaliacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request){
        $request['user_id'] = $request->user()->token()['user_id'];
        Avaliacao::updateOrCreate(['informacoe_id' => $request['informacoe_id'], 'user_id' => $request['user_id']], $request->all());

        return response()->json($request->all());
    }
}
