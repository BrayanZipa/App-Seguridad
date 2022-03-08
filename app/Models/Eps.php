<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eps extends Model
{
    use HasFactory;
    protected $table = 'se_eps';

    protected $fillable = ['eps'];

    protected $primaryKey = 'id_eps';

    public function obtenerEps(){
        try {
            $eps = Eps::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $eps;
    }

    public function obtenerEpsIndividual($id){
        try {
            $eps = Eps::find($id);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $eps;
    }
}
