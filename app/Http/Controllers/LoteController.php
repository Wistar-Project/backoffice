<?php

namespace App\Http\Controllers;

use App\Models\Alojamiento;
use App\Models\LoteFormadoPor;
use App\Models\Lote;
use App\Models\Paquete;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    public function VerLote(Request $request){
        $id = $request -> get("id");
        if(!isset($id)){
            return view("verLote", [
                "mensaje" => "No se ha ingresado un id"
            ]);
        }
        $loteEncontrado = Lote::find($id);
        if(!isset($loteEncontrado)){
            return view("verLote", [
                "mensaje" => "El lote ingresado no ha sido encontrado"
            ]);
   
        }
        $idDePaquetes = LoteFormadoPor::where("id_lote", $id) -> pluck("id_paquete");
        $paquetes = [];
        foreach($idDePaquetes as $idPaquete){
            $paquete = Paquete::find($idPaquete);
            array_push($paquetes, $paquete);
        }
        $idDestino = $loteEncontrado["destino"];
        $destino = Alojamiento::find($idDestino)["direccion"];
        
        return view("verLote", [
            "paquetes" => $paquetes,
            "destino" => $destino
        ]);
    }

    public function AgregarPaqueteALote(Request $request){
        $idLote = $request -> post("idLote");
        $idPaquete = $request -> post("idPaquete");
        if(!isset($idLote) || !isset($idPaquete)){
            return view ("editarLote", [
                "mensajeEnAgregar" => "No se ingresó un id de lote o de paquete"
            ]);
        }
    }
}
