<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;
    protected $fillable = [
        'id'
    ];

    public function alojamiento(){
        return $this -> hasOne(Alojamiento::class, "id", "id");
    }
}
