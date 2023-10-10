<?php

namespace App\Http\Controllers;

use App\Models\ConductorManeja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConductorController extends Controller
{
    public function AsignarVehiculo(Request $request){
        $validacion = Validator::make($request -> all(), [
            'id_conductor' => 'required|exists:conductores,id|unique:conductor_maneja',
            'id_vehiculo'=> 'required|exists:vehiculos,id|unique:conductor_maneja'
        ]);
        if($validacion -> fails())
            return view("asignarConductor", [
                "mensaje" => "Hay campos incorrectos. Por favor revisar."
            ]);
        $this -> asignar($request);
        return view('asignarConductor', [
            "mensaje" => "Conductor asignado a vehículo satisfactoriamente."
        ]);
    }

    private function asignar(Request $request){
        $conductorManeja = new ConductorManeja();
        $conductorManeja -> id_conductor = $request -> post('id_conductor');
        $conductorManeja -> id_vehiculo = $request -> post('id_vehiculo');
        $conductorManeja -> save();
    }
}
