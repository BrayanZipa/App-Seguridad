<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arl extends Model
{
    use HasFactory;
    protected $table = 'se_arl';

    protected $fillable = ['arl'];

    protected $primaryKey = 'id_arl';

    public function obtenerArl(){
        try {
            $arl = Arl::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $arl;
    }

    public function obtenerArlIndividual($id){
        try {
            $arl = Arl::find($id);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $arl;
    }
}