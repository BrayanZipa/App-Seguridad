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
}
