<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;
    protected $table = 'se_registros';

    protected $fillable = ['id_persona', 'ingreso_persona', 'salida_persona', 'ingreso_vehiculo', 'salida_vehiculo', 'id_vehiculo', 'ingreso_activo', 'salida_activo', 'codigo_activo', 'descripcion', 'empresa_visitada', 'colaborador', 'id_usuario'];

    protected $primaryKey = 'id_registros';

    /**
     * Función que permite obtener todos los registros de personas que ingresaron a la organización creados en la tabla se_registros.
     */
    public function obtenerRegistros(){
        try {
            $registros = Registro::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $registros;
    }

    /**
     * Función que permite retornar la información de un registro en específico.
     */
    public function obtenerRegistro($id){
        try {
            $registro = Registro::find($id);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $registro; 
    }

    /**
     * Función que permite retornar los datos de los registros de la tabla se_registros unidos la información de las personas, vehículos y activos que se hayan registrado teniendo un id en común.
     */
    public function informacionRegistros(){
        try {
            $registros = Registro::select('se_registros.*', 'tpersona.tipo AS tipopersona', 'personas.nombre', 'personas.apellido', 'personas.identificacion', 'personas.tel_contacto', 'personas.email', 'personas.foto', 'eps.eps', 'arl.arl', 'c_empresa.nombre AS empresa', 'activos.activo', 'activos.codigo', 'vehiculos.identificador', 'vehiculos.foto_vehiculo', 'tipo.tipo', 'marca.marca', 'v_empresa.nombre AS empresavisitada', 'usuarios.name')
            ->leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
            ->leftjoin('se_tipo_personas AS tpersona', 'personas.id_tipo_persona', '=', 'tpersona.id_tipo_personas')
            ->leftjoin('se_eps AS eps', 'personas.id_eps', '=', 'eps.id_eps')
            ->leftjoin('se_arl AS arl', 'personas.id_arl', '=', 'arl.id_arl')
            ->leftjoin('se_empresas AS c_empresa', 'personas.id_empresa', '=', 'c_empresa.id_empresas')
            ->leftjoin('se_activos AS activos', 'personas.id_personas', '=', 'activos.id_persona')
            ->leftjoin('se_vehiculos AS vehiculos', 'se_registros.id_vehiculo', '=', 'vehiculos.id_vehiculos')
            ->leftjoin('se_tipo_vehiculos AS tipo', 'vehiculos.id_tipo_vehiculo', '=', 'tipo.id_tipo_vehiculos')
            ->leftjoin('se_marca_vehiculos AS marca', 'vehiculos.id_marca_vehiculo', '=', 'marca.id_marca_vehiculos')
            ->leftjoin('se_empresas AS v_empresa', 'se_registros.empresa_visitada', '=', 'v_empresa.id_empresas')
            ->leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')    
            ->orderBy('id_registros')->get();
            // $response = ['data' => $registros->all()];
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $registros;  
    }

    // Función que permite una relación de uno a muchos inversa, en un registro solo puede estar una persona, se usa el modelo de Persona, la llave foránea del tabla se_registros (id_persona) y la llave primaria (id_personas) con la que tiene conexión en la tabla padre (tabla se_personas).
    public function persona(){
        return $this->belongsTo(Persona::class, 'id_persona', 'id_personas');
    }

    // Función que permite una relación de uno a muchos inversa, un registro solo puede tener un usuario que lo haya creado.
    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuarios');
    }
}
