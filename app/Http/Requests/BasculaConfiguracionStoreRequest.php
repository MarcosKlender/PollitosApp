<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasculaConfiguracionStoreRequest extends FormRequest
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
            'nom_bascula' => ['required', 'unique:bascula_configuracion'],
            'ipx_bascula' => ['required','unique:bascula_configuracion'],
        ];
    }

    public function messages()
    {
        return [
            'nom_bascula.unique' => 'Ya existe nombre de bascula',
            'ipx_bascula.unique' => 'Ya existe báscula con la misma IP'
        ];

    }

}
