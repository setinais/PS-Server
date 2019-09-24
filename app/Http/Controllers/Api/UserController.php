<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function __construct()
    {
//        $this->middleware([])->except('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPost $request)
    {

        $user =new User();

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->sexo = $request['sexo'];
        $user->cartao_sus = $request['cartao_sus'];
        $user->data_nascimento = $request['data_nascimento'];
        $user->cpf = $request['cpf'];

        $user->save();

        return response()->json(
            [
                'message' => 'Cadastro realizado com sucesso!',
                'errors' => false,
                'data' => $user
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
