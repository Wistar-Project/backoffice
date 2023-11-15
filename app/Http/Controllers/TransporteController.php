<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use App\Models\Pickup;
use Illuminate\Http\Request;

class TransporteController extends Controller
{
    public function Listar(){
        return view('transporte', [
            "camiones" => Camion::all()->pluck('id_vehiculo'),
            "pickups" => Pickup::all()->pluck('id_vehiculo')
        ]);
    }

    public function VerUno(Request $request, $id){
        return view('transporte', [
            "camiones" => Camion::all()->pluck('id_vehiculo'),
            "pickups" => Pickup::all()->pluck('id_vehiculo')
        ]);
    }
}
