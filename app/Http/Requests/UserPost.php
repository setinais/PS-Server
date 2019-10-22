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
//            'sexo' => ['sometimes',Rule::in(['Masculino','Feminino'])],
            'cartao_sus' => 'required|unique:users',
//            'data_nascimento' => 'required|date',
            'cpf' => ['required','numeric', new CPFValidator, 'unique:users']
        ];
    }

    public function messages()
    {
        return [

            'cpf.required'=> 'Digite o :attribute',
            'cpf.numeric' => 'O :attribute deve conter somente números',
            'cpf.size'    => 'Insira um número com 11 dígitos',
            'cpf.unique'   => 'Já existe este :attribute cadastrado',

            'name.required' => 'Digite o nome',
            'name.string'   => 'Digite somente letras',
            'name.max'      => 'Digite até :max letras no nome',

            'email.required' => 'Digite o :attribute',
            'email.email'    => 'Este :attribute não é válido',
            'email.max'      => 'Digite até :max caracteres no email',
            'email.unique'   => 'Já existe este :attribute cadastrado',

            'password.required'  => 'Digite a senha',
            'password.string'    => 'Insira letras, números e caracteres especiais',
            'password.min'       => ':min ou mais caracteres',

//            'sexo.in' => 'O sexo não é válido',

//            'data_nascimento.required'  => 'A data de nascimento não é válida',
//            'data_nascimento.date'      => 'A data de nascimento não é válida',

            'cartao_sus.required'=> 'Digite os números do Cartão SUS',
            'cartao_sus.integer' => 'Insira somente números',
            'cartao_sus.unique' => 'Já existe este Cartão SUS cadastrado',

        ];
    }
}
