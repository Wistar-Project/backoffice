<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConductorManeja extends Model
{
    use HasFactory;
    protected $table = "conductor_maneja";
    public $timestamps = false;
}
