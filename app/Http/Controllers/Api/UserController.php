<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserPost;
use App\Http\Requests\UserPut;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('auth:api')->except('store');
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
        try{
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
        } catch (\Exception $e){
            return response()->json(
                [
                    'message' => 'Erro (Us1) Interno servidor, Contate um Administrador do Sistema!',
                    'errors' => false,
                ], 500
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        try{
            $user = User::findOrFail($request->user()->token()['user_id']);

            return response()->json(
                [
                    'message' => 'Usuario ok!',
                    'errors' => false,
                    'data' => $user
                ]
            );
        } catch (\Exception $e){
            return response()->json(
                [
                    'message' => 'Erro (Us0) Interno servidor, Contate um Administrador do Sistema!',
                    'errors' => false,
                ], 500
            );
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPut $request, $id)
    {
        try{
            $user = User::findOrFail($request->user()->token()['user_id']);

            if(isset($request['email']))
                $user->email = $request['email'];
            if(isset($request['password']))
                $user->password = Hash::make($request['password']);
            if(isset($request['name']))
                $user->name = $request['name'];
            if(isset($request['data_nascimento']))
                $user->data_nascimento = $request['data_nascimento'];
            if(isset($request['sexo']))
                $user->sexo = $request['sexo'];
            if(isset($request['cpf']))
                $user->cpf = $request['cpf'];
            if(isset($request['cartao_sus']))
                $user->cartao_sus = $request['cartao_sus'];

            $user->save();

            return response()->json(
                [
                    'message' => 'Ok!',
                    'errors' => false,
                    'data' => $user
                ]
            );

        } catch (\Exception $e){
            return response()->json(
                [
                    'message' => 'Erro (Us2) Interno servidor, Contate um Administrador do Sistema!',
                    'errors' => false
                ], 500
            );
        }
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
