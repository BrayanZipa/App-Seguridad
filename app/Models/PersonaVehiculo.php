<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaVehiculo extends Model
{
    use HasFactory;
    protected $table = 'se_per_vehi';

    protected $fillable = ['id_persona', 'id_vehiculo'];

    // protected $primaryKey = '';

    /**
     * Función que permite retornar un registro en la tabla se_per_vehi donde se específica un vehículo con su correspondiente propietario.
     */
    public function obtenerRegistro($id){
        try {
            $registro = PersonaVehiculo::where('id_vehiculo', $id)->first();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $registro; 
    }
}