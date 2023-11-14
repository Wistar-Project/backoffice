<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoteAsignadoACamion extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'lote_asignado_a_camion';
    protected $fillable = ['id_lote', 'id_camion'];
}
