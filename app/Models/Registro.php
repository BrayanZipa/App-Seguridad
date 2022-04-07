<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;
    protected $table = 'se_registros';

    protected $fillable = ['id_persona', 'ingreso_persona', 'salida_persona', 'ingreso_vehiculo', 'salida_vehiculo', 'id_vehiculo', 'ingreso_activo', 'salida_activo', 'descripcion', 'id_empresa', 'colaborador', 'id_usuario'];

    protected $primaryKey = 'id_registros';

    /**
     * Función que permite obtener todos los registros de personas que ingresaron a la organización creados de la tabla se_registros.
     */
    public function obtenerRegistros(){
        try {
            $registros = Registro::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $registros;
    }
}
