<?php

namespace App\Http\Controllers;
use App\Models\Almacen;
use App\Models\Lote;
use App\Models\Paquete;
use App\Models\Sede;
use Exception;
use Illuminate\Http\Request;
use App\Models\Alojamiento;
use App\Models\AlojamientoTipo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SedeController extends Controller
{

    private function agregarSede($direccion){
        DB::transaction(function() use($direccion){
            $idAlojamiento = Alojamiento::create(['direccion' => $direccion])->id;
            Sede::create(['id' => $idAlojamiento]);
        });
    }

    public function Crear(Request $request){
        $validacion = Validator::make($request -> all(), [
            'direccion' => 'required|unique:alojamientos|max:100|min:10',
        ]);
        if($validacion -> fails())
            return $this -> listarConError("Ya hay una sede con esa dirección.");
        $this -> agregarSede($request -> input('direccion'));
        return $this -> listarConMensaje("Sede creada satisfactoriamente.");
    }

    public function Borrar(Request $request, $idSede){
        $lotesConMismoDestino = Lote::where('destino', $idSede)->get();
        $paquetesConMismoDestino = Paquete::where('destino', $idSede)->get();
        if($lotesConMismoDestino->count() != 0 || $paquetesConMismoDestino->count() != 0)
            return $this -> listarConError("Hay paquetes/lotes con destino a esa sede. Entreguelos primero.");
        try{
            DB::transaction(function() use($idSede){
                Sede::findOrFail($idSede) -> delete();
                Alojamiento::findOrFail($idSede) -> delete();
            });
            return $this -> listarConMensaje("Sede eliminada satisfactoriamente.");
        }catch(Exception $e){
            return $this -> listarConError("Esa sede ya no existe. La lista ha sido recargada.");
        }
    }

    public function Listar(){
        return view("sedes", [
            "sedes" => Sede::all()
        ]);
    }

    private function listarConError($errorOcurrido){
        return view("sedes", [
            "sedes" => Sede::all(),
            "mensaje" => [
                "color" => "rgba(85, 38, 38, 0.959)",
                "texto" => $errorOcurrido
            ]
        ]);
    }

    private function listarConMensaje($mensaje){
        return view("sedes", [
            "sedes" => Sede::all(),
            "mensaje" => [
                "color" => "green",
                "texto" => $mensaje
            ]
        ]);
    }
}
