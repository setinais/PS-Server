<?php

namespace App\Http\Requests;

use App\Rules\CPFValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPut extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users|max:255',
            'password' => 'sometimes|string|min:8',
            'sexo' => ['sometimes',Rule::in(['Masculino','Feminino'])],
            'cartao_sus' => 'sometimes|integer|unique:users',
            'data_nascimento' => 'sometimes|date',
            'cpf' => ['sometimes','numeric', new CPFValidator]
        ];
    }

    public function messages()
    {
        return [


            'cpf.numeric' => 'O :attribute deve conter somente numeros!',
            'cpf.size'    => 'O :attribute tem que ter :size numeros!',

            'name.required' => 'Nome é obrigatorio!',
            'name.string'   => 'O nome deve conter somente caracteries!',
            'name.max'      => 'O nome deve conter no maximo :max caracteries!',

            'email.email'    => 'Este :attribute não é valido!',
            'email.max'      => 'O :attribute deve conter no maximo :max caracteries!',
            'email.unique'   => 'Já existe um :attribute cadastrado!',

            'password.string'    => 'A nome deve ser uma String!',
            'password.min'       => 'A nome deve ter no minimo :min caracteries!',

            'sexo.in' => 'Valor do :attribute invalido!',

            'data_nascimento.date'      => 'A data de nacimento esta Invalida!',

            'cartao_sus.integer' => 'O numero do cartâo SUS deve conter somente numeros!',
            'cartao_sus.unique' => 'Já existe um cartao sus com este numero!',

        ];
    }
}
