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
        return Eps::all();
    }

    public function obtenerEpsIndividual($id){
        return Eps::find($id);
    }
}
