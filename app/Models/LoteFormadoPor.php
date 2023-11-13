<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoteFormadoPor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "lote_formado_por";

    protected $fillable = [
        'id_paquete',
        'id_lote'
    ];
}
