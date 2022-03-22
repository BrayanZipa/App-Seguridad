<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPersona extends Model
{
    use HasFactory;
    protected $table = 'se_tipo_personas';

    protected $fillable = ['tipo'];

    protected $primaryKey = 'id_tipo_personas';

    /**
     * Función que permite obtener todas los tipos de personas creadas de la tabla se_tipo_personas.
     */
    public function obtenerTipoPersona(){
        try {
            $tipoPersona = TipoPersona::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $tipoPersona;
    }
}
