<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestColaborador extends FormRequest
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
        // $dato = $this->all();
        // dd( $dato);

        $datos = $this->all();

        if($this->method() == 'POST'){
            if(array_key_exists('casoIngreso', $datos)){
                if($datos['casoIngreso'] == 'conActivoVehiculo'){
                    return array_merge($this->validacionGeneral(), $this->validacionFaltante(), $this->validacionVehiculo()); 
    
                } else {  
                    return array_merge($this->validacionGeneral(), $this->validacionFaltante());
                }   
            } else if(array_key_exists('casoIngreso2', $datos)){
                if($datos['casoIngreso2'] == 'colaboradorSinActivo'){
                    return array_merge($this->validacionGeneral(), ['descripcion' => 'nullable|max:255']);
    
                } else if($datos['casoIngreso2'] == 'sinActivoVehiculo') {  
                    return array_merge($this->validacionGeneral(), $this->validacionVehiculo(), ['descripcion' => 'nullable|max:255']);
                } 
            }
        } else if($this->method() == 'PUT'){
            return $this->validacionGeneral();
        }
    }

    public function messages()
    {
        return [
            'codigo.required' => 'Se requiere que ingrese el código del activo',
            'codigo.string' => 'El código del activo debe ser de tipo texto',
            'codigo.alpha_num' => 'El código del activo solo debe contener valores alfanuméricos',
            // 'codigo.unique' => 'No puede haber más de un activo con el mismo código',
            'codigo.max' => 'El código del activo no puede tener más de 5 caracteres',
            'codigo.min' => 'El código del activo no puede tener menos de 4 caracteres',

            'nombre.required' => 'Se requiere que ingrese el nombre',
            'nombre.string' => 'El nombre debe ser de tipo texto',
            'nombre.regex' => 'El nombre solo debe contener valores alfabéticos',
            'nombre.max' => 'El nombre no puede tener más de 25 caracteres',
            'nombre.min' => 'El nombre no puede tener menos de 3 caracteres',

            'apellido.required' => 'Se requiere que ingrese el apellido',
            'apellido.string' => 'El apellido debe ser de tipo texto',
            'apellido.regex' => 'El apellido solo debe contener valores alfabéticos',
            'apellido.max' => 'El apellido no puede tener más de 25 caracteres',
            'apellido.min' => 'El apellido no puede tener menos de 3 caracteres',

            'identificacion.required' => 'Se requiere que ingrese la identificación',
            'identificacion.numeric' => 'La identificación debe ser un valor númerico y no debe contener espacios',
            // 'identificacion.unique' => 'No puede haber dos personas con el mismo número de identificación',
            'identificacion.digits_between' => 'La identificación debe estar en un rango de 4 a 15 números',

            // 'email.required' => 'Se requiere que ingrese el correo empresarial',
            'email.email' => 'El correo empresarial debe tener un formato correcto',
            // 'email.unique' => 'No puede haber dos personas con el mismo correo empresarial',
            'email.max' => 'El correo empresarial no puede tener más de 50 caracteres',

            'tel_contacto.required' => 'Se requiere que ingrese el teléfono',
            'tel_contacto.numeric' => 'El teléfono debe ser un valor númerico y no debe contener espacios',
            // 'tel_contacto.unique' => 'No puede haber dos personas con el mismo teléfono',
            'tel_contacto.digits_between' => 'El teléfono debe tener 7 o 10 números',

            'id_eps.required' => 'Se requiere que elija una opción en la EPS',
            'id_eps.integer' => 'La EPS debe ser de tipo entero',

            'id_arl.required' => 'Se requiere que elija una opción en la ARL',
            'id_arl.integer' => 'La ARL debe ser de tipo entero',

            'id_empresa.required' => 'Se requiere que elija una opción en la empresa',
            'id_empresa.integer' => 'La Empresa debe ser de tipo entero',

            'descripcion.max' => 'La descripción solo puede tener un máximo de 255 caracteres',  

            
            'identificador.required' => 'Se requiere que ingrese el número identificador del vehículo',
            'identificador.string' => 'El número identificador debe ser de tipo texto',
            'identificador.unique' => 'No puede haber dos vehículos con el mismo número identificador',
            'identificador.alpha_num' => 'El identificador solo debe contener valores alfanuméricos y no debe contener espacios',
            'identificador.max' => 'El identificador del vehículo no puede tener más de 15 caracteres',
            'identificador.min' => 'El identificador del vehículo no puede tener menos de 6 caracteres',

            'id_tipo_vehiculo.required' => 'Se requiere que elija una opción en el tipo de vehículo',
            'id_tipo_vehiculo.integer' => 'El tipo de vehículo debe ser de tipo entero',

            'id_marca_vehiculo.integer' => 'La marca del vehículo debe ser de tipo entero',

            'foto_vehiculo.required' => 'Se requiere que tome una foto del vehículo',
            'foto_vehiculo.string' => 'La información de la foto del vehículo debe estar en formato de texto',
        ];
    }

    /**
     * Función que retorna las validaciones en general para el ingreso de datos de los colaboradores
     */
    public function validacionGeneral()
    {
        return[
            'nombre' => 'required|string|regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/u|max:25|min:3',
            'apellido' => 'required|string|regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/u|max:25|min:3',   
            'identificacion' => 'required|numeric|digits_between:4,15',
            'email' => 'nullable|email:rfc,dns|max:50',
            'tel_contacto' => 'required|numeric|digits_between:7,10',
            'id_eps' => 'required|integer',         
            'id_arl' => 'required|integer',
            'id_empresa' => 'required|integer',
        ];

        // |unique:se_personas,identificacion,'.$this->id.',id_personas
        // |unique:se_personas,email,'.$this->id.',id_personas
        // |unique:se_personas,tel_contacto,'.$this->id.',id_personas
    } 

    /**
     * Función que retorna las validaciones faltantes del ingreso de datos de los colaboradores
     */
    public function validacionFaltante()
    {
        return[
            'codigo' => 'required|string|alpha_num|max:5|min:4', 
            'descripcion' => 'nullable|max:255'
        ];

        // |unique:se_activos,codigo
    } 

    /**
     * Función que retorna las validaciones para el ingreso de vehículos pertenecientes a los colaboradores
     */
    public function validacionVehiculo()
    {
        return[
            'identificador' => 'required|string|unique:se_vehiculos,identificador|alpha_num|max:15|min:6',
            'id_tipo_vehiculo' => 'required|integer',   
            'id_marca_vehiculo' => 'integer|nullable',
            'foto_vehiculo'  => 'required|string',
        ];
    } 
}
