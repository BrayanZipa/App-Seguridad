<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'se_personas';

    protected $fillable = ['id_usuario', 'id_tipo_persona', 'nombre', 'apellido', 'identificacion', 'id_arl', 'id_eps', 'foto', 'tel_contacto', 'email', 'id_empresa'];

    protected $primaryKey = 'id_personas';

    /**
     * Función que permite retornar la información de un grupo de personas en específico (Visitantes, Colaboradores, Colaboradores con activo, Conductores).
     */
    public function obtenerPersonas($tipoPersona){
        try {
            $personas = Persona::where('id_tipo_persona', $tipoPersona)->orderBy('identificacion')->get();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $personas;  
    }

    /**
     * Función que permite retornar la información a una persona en específico.
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
     * Función que permite retornar la información a una persona en específico unido a la información del activo que tenga asiganado
     */
    public function obtenerInformacionPersona($id){
        try {
            $persona = Persona::select('se_personas.*', 'activos.activo', 'activos.codigo')
            ->leftjoin('se_activos AS activos', 'se_personas.id_personas', '=', 'activos.id_persona')
            ->where('id_personas', $id)->get();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $persona[0]; 
    }

    /**
     * Función que permite retornar los datos de las personas unidos a su correspondiente ARL, ESP, Empresa, Activo asignado y Usuario que las crea, esto donde tengan un id en común.
     */
    public function informacionPersonas($tipoPersona){
        try {
            $personas = Persona::select('se_personas.*', 'eps.eps', 'arl.arl', 'usuarios.name', 'empresas.nombre AS empresa', 'activos.activo', 'activos.codigo')
            ->leftjoin('se_eps AS eps', 'se_personas.id_eps', '=', 'eps.id_eps')
            ->leftjoin('se_arl AS arl', 'se_personas.id_arl', '=', 'arl.id_arl')
            ->leftjoin('se_usuarios AS usuarios', 'se_personas.id_usuario', '=', 'usuarios.id_usuarios')
            ->leftjoin('se_empresas AS empresas', 'se_personas.id_empresa', '=', 'empresas.id_empresas')
            ->leftjoin('se_activos AS activos', 'se_personas.id_personas', '=', 'activos.id_persona')
            ->where('id_tipo_persona', $tipoPersona)->orderBy('id_personas')->get();
            $response = ['data' => $personas->all()];
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $response;  
    }

    /**
     * Función que permite traer el Token de autorización para poder iniciar sesión y conectarse al API de GLPI.
     */
    public function initSesionGlpi(){
        try {
            $session_token = Http::withHeaders([
                'Authorization' => 'user_token '.env('API_KEY', 'No hay Token')
            ])->get(env('API_URL', 'No hay URL').'initSession/');
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al iniciar sesión en GLPI'], 500);
        }
        return $session_token['session_token'];
    }

    /**
     * Función que permite destruir una sesión identificada por un token de sesión en GLPI.
     */
    public function killSesionGlpi($sesion){
        try {
            Http::withHeaders([
                'Session-Token' => $sesion
            ])->get(env('API_URL', 'No hay URL').'killSession/');
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al cerrar sesión en GLPI'], 500);
        }   
    }

    /**
     * Función que permite una relación de uno a muchos, una persona puede tener muchos registros, se usa el modelo de Registro, la llave foránea del tabla se_registros (id_persona) y la llave primaria (id_personas) con la que tiene conexión en la tabla padre (tabla se_personas).
     */
    public function registros(){
        return $this->hasMany(Registro::class, 'id_persona', 'id_personas'); 
    }

    /**
     * Función que permite una relación de uno a muchos inversa, una persona solo puede tener un usuario que la haya creado.
     */
    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuarios');
    }
}