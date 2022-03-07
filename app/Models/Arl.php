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
        return Arl::all();
    }

    public function obtenerArlIndividual($id){
        return Arl::find($id);
    }
}