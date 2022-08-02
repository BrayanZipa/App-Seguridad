<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRegistros extends FormRequest
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
        $datos = $this->all();

        if($this->method() == 'PUT'){
            $validacion =[];
            if(isset($datos['id_vehiculo'])){
                $validacion['id_vehiculo'] = 'required|integer';   
            }
            
            if($datos['casoRegistro'] == 'visitante' || $datos['casoRegistro'] == 'visitanteActivo'){
                $validacion += array_merge($this->validacionGeneral(), $this->validacionVisitanteConductor());
                $validacion['id_eps'] = 'nullable|integer';
                $validacion['id_arl'] = 'nullable|integer';

                if($datos['casoRegistro'] == 'visitanteActivo'){
                    $validacion['activo'] = 'required|string|alpha|max:20|min:3';
                    $validacion['codigo'] = 'required|string|alpha_num|unique:se_activos,codigo,'.$this->id.',id_persona|max:5|min:4';  
                    return $validacion;
                }
                return $validacion;
                
            } else if($datos['casoRegistro'] == 'colaboradorSinActivo' || $datos['casoRegistro'] == 'colaboradorSinActivo2' || $datos['casoRegistro'] == 'colaboradorConActivo'){
                $validacion += array_merge($this->validacionGeneral(), $this->validacionColaborador(), $this->validacion_EPS_ARL());
                if($datos['casoRegistro'] == 'colaboradorConActivo'){
                    $validacion['codigo'] = 'required|string|alpha_num|max:5|min:4';
                    return $validacion;
                }
                return $validacion;

            } else if($datos['casoRegistro'] == 'conductor'){
                $validacion += array_merge($this->validacionGeneral(), $this->validacionVisitanteConductor(), $this->validacion_EPS_ARL());
                return $validacion;
            }
        }
    }

    public function messages()
    {
        return [
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
            'identificacion.unique' => 'No puede haber dos personas con el mismo número de identificación',
            'identificacion.digits_between' => 'La identificación debe estar en un rango de 4 a 15 números',

            'tel_contacto.required' => 'Se requiere que ingrese el teléfono',
            'tel_contacto.numeric' => 'El teléfono debe ser un valor númerico y no debe contener espacios',
            // 'tel_contacto.unique' => 'No puede haber dos personas con el mismo teléfono',
            'tel_contacto.digits_between' => 'El teléfono debe tener 7 o 10 números',

            'id_eps.required' => 'Se requiere que elija una opción en la EPS',
            'id_eps.integer' => 'La EPS debe ser de tipo entero',

            'id_arl.required' => 'Se requiere que elija una opción en la ARL',
            'id_arl.integer' => 'La ARL debe ser de tipo entero',

            'empresa_visitada.required' => 'Se requiere que elija una opción en la empresa',
            'empresa_visitada.integer' => 'La Empresa debe ser de tipo entero',

            'email.email' => 'El correo empresarial debe tener un formato correcto',
            // 'email.unique' => 'No puede haber dos personas con el mismo correo empresarial',
            'email.max' => 'El correo empresarial no puede tener más de 50 caracteres',

            'id_empresa.required' => 'Se requiere que elija una opción en la empresa',
            'id_empresa.integer' => 'La Empresa debe ser de tipo entero',

            'id_vehiculo.required' => 'Se requiere que elija una opción en el vehículo',
            'id_vehiculo.integer' => 'El Vehículo debe ser de tipo entero',

            'colaborador.required' => 'Se requiere que ingrese al colaborador a cargo',
            'colaborador.string' => 'El colaborador debe ser de tipo texto',
            'colaborador.regex' => 'El colaborador solo debe contener valores alfabéticos',
            'colaborador.max' => 'El colaborador no puede tener más de 50 caracteres',
            'colaborador.min' => 'El colaborador no puede tener menos de 3 caracteres',

            'descripcion.max' => 'La descripción solo puede tener un máximo de 255 caracteres',   

            'foto.required' => 'Se requiere que tome una foto de la persona',
            'foto.string' => 'La información de la foto debe estar en formato de texto',  

            'activo.required' => 'Se requiere que ingrese el nombre del activo',
            'activo.string' => 'El nombre del activo debe ser de tipo texto',
            'activo.alpha' => 'El nombre del activo solo debe contener valores alfabéticos y sin espacios',
            'activo.max' => 'El nombre del activo no puede tener más de 20 caracteres',
            'activo.min' => 'El nombre del activo no puede tener menos de 3 caracteres',

            'codigo.required' => 'Se requiere que ingrese el código del activo',
            'codigo.string' => 'El código del activo debe ser de tipo texto',
            'codigo.alpha_num' => 'El código del activo solo debe contener valores alfanuméricos y sin espacios',
            'codigo.unique' => 'No puede haber más de un activo con el mismo código',
            'codigo.max' => 'El código del activo no puede tener más de 5 caracteres',
            'codigo.min' => 'El código del activo no puede tener menos de 4 caracteres',
        ];
    }

    /**
     * Función que retorna las validaciones en general para el ingreso de datos de todos los tipos de persona (visitante, colaborador sin activo, colaborador con activo, conductor)
     */
    public function validacionGeneral()
    {
        return[
            'nombre' => 'required|string|regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/u|max:25|min:3',
            'apellido' => 'required|string|regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/u|max:25|min:3',   
            'identificacion' => 'required|numeric|unique:se_personas,identificacion,'.$this->id.',id_personas|digits_between:4,15',
            'tel_contacto' => 'required|numeric|digits_between:7,10',
            'descripcion' => 'nullable|max:255',  
        ];
    }

    /**
     * Función que retorna las validaciones faltantes que tienen en común el tipo de persona visitante y conductor
     */
    public function validacionVisitanteConductor()
    {
        return[
            'empresa_visitada' => 'required|integer',
            'colaborador' => 'required|string|regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/u|max:50|min:3',
            'foto' => 'required|string',
        ];
    } 

    /**
     * Función que retorna las validaciones faltantes que tienen en común el tipo de persona colaborador sin activo y colaborador con activo
     */
    public function validacionColaborador()
    {
        return[
            'id_empresa' => 'required|integer',
            'email' => 'nullable|email:rfc,dns|max:50',
        ];
    } 

    /**
     * Función que retorna las validaciones de la EPS y ARL requeridas
     */
    public function validacion_EPS_ARL()
    {
        return[
            'id_eps' => 'required|integer',         
            'id_arl' => 'required|integer', 
        ];
    } 
}