<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    use HasFactory;
    protected $table = 'se_tipo_vehiculos';

    protected $fillable = ['tipo'];

    protected $primaryKey = 'id_tipo_vehiculos';

    /**
     * Función que permite obtener todos los tipos de vehículos creados en la tabla se_tipo_vehiculos.
     */
    public function obtenerTipoVehiculos(){
        try {
            $tipoVehiculos = TipoVehiculo::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $tipoVehiculos;
    }
}