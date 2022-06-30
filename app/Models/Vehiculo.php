<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $table = 'se_vehiculos';

    protected $fillable = ['identificador', 'id_tipo_vehiculo', 'id_marca_vehiculo', 'foto_vehiculo', 'id_usuario'];

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

    /**
     * Función que permite retornar la información de un vehículo en específico.
     */
    public function obtenerVehiculo($id){
        try {
            $vehiculo = Vehiculo::find($id);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $vehiculo; 
    }
}