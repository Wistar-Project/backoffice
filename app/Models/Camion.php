<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camion extends Model
{
    use HasFactory;
    protected $table = "camiones";
    public $timestamps = false;
    protected $fillable = [ "id_vehiculo" ];
}
