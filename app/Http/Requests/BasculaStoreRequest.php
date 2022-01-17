<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasculaStoreRequest extends FormRequest
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
           // 'id' => ['required','unique:bascula'],
            //'nom_user' => ['required','unique:bascula'],
            'nom_menu' => ['required', 'unique:bascula'],
        ];
    }

    public function messages()
    {
        return[
            //'id.unique' => 'Báscula en uso',
            //'nom_user.unique' => 'El usuario ya tiene una báscula asignada'
            'nom_menu.unique' => 'Ya existe un usuario asignado al mismo menu'
        ];
    }
}