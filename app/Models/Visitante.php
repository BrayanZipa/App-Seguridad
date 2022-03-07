<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory;
    protected $table = 'se_personas';

    protected $fillable = ['id_usuario', 'id_tipo_persona', 'nombre', 'apellido', 'identificacion', 'id_arl', 'id_eps', 'foto', 'tel_contacto', 'id_empresa'];

    protected $primaryKey = 'id_personas';

    public function obtenerVisitantes(){
        return Visitante::where('id_tipo_persona', 1)->orderBy('id_personas')->get();
    }

    public function obtenerVisitante($id){
        return Visitante::find($id);
    }
}
