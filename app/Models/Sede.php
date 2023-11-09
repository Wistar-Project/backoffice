<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sede extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id'
    ];

    public function alojamiento(){
        return $this -> hasOne(Alojamiento::class, "id", "id");
    }
}
