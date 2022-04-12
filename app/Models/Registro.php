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

    // Función que permite una relación de uno a muchos inversa, en un registro solo puede estar una persona, se usa el modelo de Persona, la llave foránea del tabla se_registros (id_persona) y la llave primaria (id_personas) con la que tiene conexión en la tabla padre (tabla se_personas).
    public function persona(){
        return $this->belongsTo(Persona::class, 'id_persona', 'id_personas');
    }

    // Función que permite una relación de uno a muchos inversa, un registro solo puede tener un usuario que lo haya creado.
    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuarios');
    }
}
