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
            'identificacion' => 'required|numeric|digits_between:6,15',
            'id_eps' => 'required|integer',         
            'id_arl' => 'required|integer',
            // // 'foto' => 'required',
            'tel_contacto' => 'required|numeric|unique:se_personas,tel_contacto|digits_between:7,10',
            'id_empresa' => 'integer|nullable',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Se requiere que ingrese el nombre',
            'nombre.string' => 'El nombre debe ser de tipo texto',
            'nombre.alpha' => 'El nombre solo debe contener valores alfabéticos',
            'nombre.max' => 'El nombre no puede tener más de 20 caracteres',
            'nombre.min' => 'El nombre no puede tener menos de 3 caracteres',

            'apellido.required' => 'Se requiere que ingrese el apellido',
            'apellido.string' => 'El apellido debe ser de tipo texto',
            'apellido.alpha' => 'El apellido solo debe contener valores alfabéticos',
            'apellido.max' => 'El apellido no puede tener más de 20 caracteres',
            'apellido.min' => 'El apellido no puede tener menos de 3 caracteres',

            'identificacion.required' => 'Se requiere que ingrese la identificación',
            'identificacion.numeric' => 'La identificación debe ser un valor númerico',
            'identificacion.digits_between' => 'La identificación debe estar en un rago de 6 a 15 caracteres',

            'id_eps.required' => 'Se requiere que elija una opción en la EPS',
            'id_eps.integer' => 'La EPS debe ser de tipo entero',

            'id_arl.required' => 'Se requiere que elija una opción en la ARL',
            'id_arl.integer' => 'La ARL debe ser de tipo entero',

            'tel_contacto.required' => 'Se requiere que ingrese el teléfono',
            'tel_contacto.numeric' => 'El teléfono debe ser un valor númerico',
            'tel_contacto.unique' => 'No puede haber dos personas con el mismo teléfono',
            'tel_contacto.digits_between' => 'El teléfono debe tener 7 o 10 caracteres',

            'id_empresa.integer' => 'La Empresa debe ser de tipo entero',
        ];
    }
}
