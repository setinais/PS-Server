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


            'cpf.numeric' => 'O :attribute deve conter somente números',
            'cpf.size'    => 'Insira um número com 11 dígitos',

            'name.required' => 'Digite o nome',
            'name.string'   => 'Digite somente letras',
            'name.max'      => 'Digite até :max letras no nome',

            'email.email'    => 'Este :attribute não é válido',
            'email.max'      => 'Digite até :max caracteres no email',
            'email.unique'   => 'Já existe este :attribute cadastrado',

            'password.string'    => 'Insira letras, números e caracteres especiais',
            'password.min'       => ':min ou mais caracteres',

            'sexo.in' => 'O sexo não é válido',

            'data_nascimento.date'      => 'A data de nascimento não é válida',

            'cartao_sus.integer' => 'Insira somente números',
            'cartao_sus.unique' => 'Já existe este Cartão SUS cadastrado',

        ];
    }
}
