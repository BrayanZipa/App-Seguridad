<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'se_personas';

    protected $fillable = ['id_usuario', 'id_tipo_persona', 'nombre', 'apellido', 'identificacion', 'id_arl', 'id_eps', 'foto', 'tel_contacto', 'id_empresa'];

    protected $primaryKey = 'id_personas';

    /**
     * Función que permite retornar a un grupo de personas en específico (Visitantes, Colaboradores, Conductores).
     */
    public function obtenerPersonas($tipoPersona){
        try {
            $personas = Persona::where('id_tipo_persona', $tipoPersona)->orderBy('id_personas')->get();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $personas;  
    }

    /**
     * Función que permite retornar a una persona es específico.
     */
    public function obtenerPersona($id){
        try {
            $persona = Persona::find($id);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $persona; 
    }

    /**
     * Función que permite retornar los datos de las personas unidos a su correspondiente ARL y ESP donde tenga un id en común.
     */
    public function informacionPersonas($tipoPersona){
        try {
            $personas = Persona::leftjoin('se_eps AS eps', 'se_personas.id_eps', '=', 'eps.id_eps')->leftjoin('se_arl AS arl', 'se_personas.id_arl', '=', 'arl.id_arl')->leftjoin('se_usuarios AS usuarios', 'se_personas.id_usuario', '=', 'usuarios.id_usuarios')->where('id_tipo_persona', $tipoPersona)->orderBy('id_personas')->get();
            $response = ['data' => $personas->all()];
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $response;  
    }
}
