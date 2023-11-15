<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paquete extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'peso_en_kg',
        'destino'
    ];
    
}
