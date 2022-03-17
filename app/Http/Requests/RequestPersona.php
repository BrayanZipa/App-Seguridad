<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPersona extends FormRequest
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
            'nombre' => 'required|string|alpha|max:20|min:3',
            'apellido' => 'required|string|alpha|max:20|min:3',   
            // 'identificacion' => 'required|numeric|max:15|min:6',
            // 'id_eps' => 'required|integer',         
            // 'id_arl' => 'required|integer',
            // // 'foto' => 'required',
            // 'tel_contact' => 'required|max:10|min:7|unique:se_personas,tel_contact',
            // 'id_empresa' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Se requiere que escriba el nombre',
            'nombre.string' => 'El nombre debe ser texto',
            'nombre.alpha' => 'El nombre solo debe contener valores alfabéticos',
            'nombre.max' => 'El nombre no puede tener más de 20 caracteres',
            'nombre.min' => 'El nombre no puede tener menos de 3 caracteres',

            'apellido.required' => 'Se requiere que escriba el apellido',
            'apellido.string' => 'El apellido debe ser texto',
            'apellido.alpha' => 'El apellido solo debe contener valores alfabéticos',
            'apellido.max' => 'El apellido no puede tener más de 20 caracteres',
            'apellido.min' => 'El apellido no puede tener menos de 3 caracteres',
        ];
    }
}
