<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Stmt\Else_;

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
        // dd ($this->method());
        if($this->method() == 'POST'){
            $validacionPost = [
                'id_empresa' => 'required|integer',
                'colaborador' => 'required|string|regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/u|max:40|min:3',
                'descripcion' => 'nullable|max:255'
            ];

            return array_merge($this->validacionGeneral(), $validacionPost);

        } else if($this->method() == 'PUT'){
            return $this->validacionGeneral();
        }
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Se requiere que ingrese el nombre',
            'nombre.string' => 'El nombre debe ser de tipo texto',
            'nombre.regex' => 'El nombre solo debe contener valores alfabéticos',
            'nombre.max' => 'El nombre no puede tener más de 20 caracteres',
            'nombre.min' => 'El nombre no puede tener menos de 3 caracteres',

            'apellido.required' => 'Se requiere que ingrese el apellido',
            'apellido.string' => 'El apellido debe ser de tipo texto',
            'apellido.regex' => 'El apellido solo debe contener valores alfabéticos',
            'apellido.max' => 'El apellido no puede tener más de 20 caracteres',
            'apellido.min' => 'El apellido no puede tener menos de 3 caracteres',

            'identificacion.required' => 'Se requiere que ingrese la identificación',
            'identificacion.numeric' => 'La identificación debe ser un valor númerico',
            'identificacion.unique' => 'No puede haber dos personas con el mismo número de identificación',
            'identificacion.digits_between' => 'La identificación debe estar en un rango de 4 a 15 números',

            'tel_contacto.required' => 'Se requiere que ingrese el teléfono',
            'tel_contacto.numeric' => 'El teléfono debe ser un valor númerico',
            'tel_contacto.unique' => 'No puede haber dos personas con el mismo teléfono',
            'tel_contacto.digits_between' => 'El teléfono debe tener 7 o 10 números',

            'id_eps.required' => 'Se requiere que elija una opción en la EPS',
            'id_eps.integer' => 'La EPS debe ser de tipo entero',

            'id_arl.required' => 'Se requiere que elija una opción en la ARL',
            'id_arl.integer' => 'La ARL debe ser de tipo entero',

            'id_empresa.required' => 'Se requiere que elija una opción en la empresa',
            'id_empresa.integer' => 'La Empresa debe ser de tipo entero',

            'colaborador.required' => 'Se requiere que ingrese al colaborador a cargo',
            'colaborador.string' => 'El colaborador debe ser de tipo texto',
            'colaborador.regex' => 'El colaborador solo debe contener valores alfabéticos',
            'colaborador.max' => 'El colaborador no puede tener más de 40 caracteres',
            'colaborador.min' => 'El colaborador no puede tener menos de 3 caracteres',

            'descripcion.max' => 'La descripción solo puede tener un máximo de 255 caracteres',   

            'foto.required' => 'Se requiere que tome una foto de la persona',
            'foto.string' => 'La información de la foto debe estar en formato de texto',  
            
            
            'id_tipo_persona.integer' => 'El tipo de persona debe ser de tipo entero',
        ];
    }

    //Función que retorna las validaciones en general para las personas ya sean visitantes o conductores
    public function validacionGeneral()
    {
        return[
            'nombre' => 'required|string|regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/u|max:20|min:3',
            'apellido' => 'required|string|regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/u|max:20|min:3',   
            'identificacion' => 'required|numeric|unique:se_personas,identificacion,'.$this->id.',id_personas|digits_between:4,15',
            'id_eps' => 'required|integer',         
            'id_arl' => 'required|integer',
            'foto' => 'required|string',
            'tel_contacto' => 'required|numeric|unique:se_personas,tel_contacto,'.$this->id.',id_personas|digits_between:7,10',
            'id_tipo_persona' => 'integer',
        ];
    } 
}
