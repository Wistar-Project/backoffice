<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlojamientoTipo extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='alojamientos_tipos';
}
