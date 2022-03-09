<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaVehiculo extends Model
{
    use HasFactory;
    protected $table = 'se_marca_vehiculos';

    protected $fillable = ['marca'];

    protected $primaryKey = 'id_marca_vehiculos';

    /**
     * Función que permite obtener todos las marcas de vehículos creadas en la tabla se_marca_vehiculos.
     */
    public function obtenerMarcaVehiculos(){
        try {
            $marcaVehiculos = MarcaVehiculo::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $marcaVehiculos;
    }
}
