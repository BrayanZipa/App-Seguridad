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
}
