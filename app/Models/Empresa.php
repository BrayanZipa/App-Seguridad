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

    public function obtenerEmpresas(){
        return Empresa::all();
    }
}
