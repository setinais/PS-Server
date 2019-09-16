<?php

namespace App\Http\Requests;

use App\Rules\CPFValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPost extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'sexo' => ['sometimes',Rule::in(['Masculino','Feminino'])],
            'cartao_sus' => 'required|integer|unique:users',
            'data_nascimento' => 'required|date',
            'cpf' => ['required','numeric', new CPFValidator]
        ];
    }

    public function messages()
    {
        return [

            'cpf.required'=> 'O :attribute é obrigatorio!',
            'cpf.numeric' => 'O :attribute deve conter somente numeros!',
            'cpf.size'    => 'O :attribute tem que ter :size numeros!',

            'name.required' => 'O :attribute é um campo Obrigatorio!',
            'name.string'   => 'O :attribute deve conter somente caracteries!',
            'name.max'      => 'O :attribute deve conter no maximo :max caracteries!',

            'email.required' => 'O :attribute é um campo Obrigatorio!',
            'email.email'    => 'Este :attribute não é valido!',
            'email.max'      => 'O :attribute deve conter no maximo :max caracteries!',
            'email.unique'   => 'Já existe um :attribute cadastrado!',

            'password.required'  => 'A :attribute é obrigatoria',
            'password.string'    => 'A :attribute deve ser uma String!',
            'password.min'       => 'A :attribute deve ter no minimo :min caracteries!',

            'sexo.in' => 'Valor do :attribute invalido!',

            'data_nascimento.required'  => 'A data de nacimento esta invalida!',
            'data_nascimento.date'      => 'A data de nacimento é Obrigatoria!',

            'cartao_sus.required'=> 'O :attribute é obrigatorio!',
            'cartao_sus.integer' => 'O :attribute deve conter somente numeros!',
            'cartao_sus.unique' => 'Já existe um cartao sus com este numero!',

        ];
    }
}
