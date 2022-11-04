<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    use HasFactory;
    protected $table = 'se_activos';

    protected $fillable = ['activo', 'codigo', 'id_persona', 'id_usuario'];

    protected $primaryKey = 'id_activos';

    /**
     * Función que permite obtener todos los activos creados de la tabla se_activos.
     */
    public function obtenerActivos(){
        try {
            $activos = Activo::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $activos;
    }

    /**
     * Función que permite saber si ya existe un activo con un código en específico, si es el caso el campo del código del activo quedará nulo en la base de datos
     */
    public function verificarActivo($codigo){
        try {
            if (Activo::where('codigo', $codigo)->exists()){
                Activo::where('codigo', $codigo)->update(['codigo' => null]);
            } 
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al consultar la información de la base de datos'], 500);
        }
    }

    /**
     * Función que permite saber si existe un activo en la base de datos con un determinado código y asigando a un determinado colaborador, retorna true o false.
     */
    public function existeActivo($codigo, $idColaborador){
        try {
            $response = Activo::where('codigo', $codigo)->where('id_persona', $idColaborador)->exists();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al consultar la información de la base de datos'], 500);
        }
        return $response;
    }

    /**
     * Función que permite saber si un activo existe en la base de datos por medio del id del propietario y si es el caso lo elimina.
     */
    public function existeActivoEliminar($idColaborador){
        try {
            if (Activo::where('id_persona', $idColaborador)->exists()){
                Activo::where('id_persona', $idColaborador)->delete();
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al eliminar el registro del activo de la base de datos'], 500);
        }
    }
}