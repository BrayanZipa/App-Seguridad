<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $table = 'se_vehiculos';

    protected $fillable = ['identificador', 'id_tipo_vehiculo', 'id_marca_vehiculo', 'foto', 'id_usuario'];

    protected $primaryKey = 'id_vehiculos';

    /**
     * Función que permite obtener todos los vehículos creados de la tabla se_vehiculos.
     */
    public function obtenerVehiculos(){
        try {
            $vehiculos = Vehiculo::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $vehiculos;
    }
}