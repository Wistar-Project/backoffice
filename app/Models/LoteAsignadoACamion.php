<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LoteAsignadoACamion extends Model
{
    use HasFactory;
    protected $table = 'lote_asignado_a_camion';
    protected $fillable = ['id_lote', 'id_camion'];
}
