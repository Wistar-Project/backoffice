<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculoTipo extends Model
{
    use HasFactory;
    protected $table = "vehiculos_tipos";
    protected $primaryKey = "id_vehiculo";
}
