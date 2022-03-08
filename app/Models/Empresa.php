<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'se_empresas';

    protected $fillable  = ['empresa'];

    protected $primaryKey = 'id_empresas';

    /**
     * Función que permite retornar el nombre de las empresas que conforman la organización.
     */
    public function obtenerEmpresas(){
        try {
            $empresas =  Empresa::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $empresas;
    }
}