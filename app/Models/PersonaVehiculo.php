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

    /**
     * Función que permite retornar los datos de los vehículos unidos a su correspondiente marca y tipo de vehículo asignados, dependiendo del caso también retorna a los propietarios de los vehículos, esto donde tengan un id en común.
     */
    public function informacionVehiculos($id = null){
        try { 
            $consulta = PersonaVehiculo::select('vehiculos.*', 'tipo.tipo', 'marca.marca')
            ->leftjoin('se_vehiculos AS vehiculos', 'se_per_vehi.id_vehiculo', '=', 'vehiculos.id_vehiculos')
            ->leftjoin('se_tipo_vehiculos AS tipo', 'vehiculos.id_tipo_vehiculo', '=', 'tipo.id_tipo_vehiculos')
            ->leftjoin('se_marca_vehiculos AS marca', 'vehiculos.id_marca_vehiculo', '=', 'marca.id_marca_vehiculos')->orderBy('tipo', 'desc');

            if($id != null){
                $vehiculos = $consulta->where('id_persona', $id)->get();
            } else {
                $vehiculos = $consulta->get();  
            }  
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $vehiculos;
    }
}