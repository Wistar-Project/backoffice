<?php

namespace App\Http\Controllers;

use App\Models\Alojamiento;
use App\Models\LoteFormadoPor;
use App\Models\Lote;
use App\Models\Paquete;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    private function buscarPaqueteEnLote($idPaquete, $idLote){
        return LoteFormadoPor::where([
             ["id_lote", $idLote],
             ["id_paquete", $idPaquete]
        ]);
    }

    public function VerLote(Request $request){    
        function obtenerPaquetes($id){
            $idDePaquetes = LoteFormadoPor::where("id_lote", $id) -> pluck("id_paquete");
            $paquetes = [];
            foreach($idDePaquetes as $idPaquete){
                $paquete = Paquete::find($idPaquete);
                array_push($paquetes, $paquete);
            }
            return $paquetes;
        }
        function obtenerDestinoDeLote($idLote){
            $loteEncontrado = Lote::find($idLote);
            $idDestino = $loteEncontrado["destino"];
            return Alojamiento::find($idDestino)["direccion"];
        }
        $id = $request -> get("id");
        if(!isset($id))
            return view("verLote", [
                "mensaje" => "No se ha ingresado un id"
            ]);
        $loteEncontrado = Lote::find($id);
        if(!isset($loteEncontrado))
            return view("verLote", [
                "mensaje" => "El lote ingresado no ha sido encontrado"
            ]);
        $paquetes = obtenerPaquetes($id);
        $destino = obtenerDestinoDeLote($id);
        return view("verLote", [
            "paquetes" => $paquetes,
            "destino" => $destino
        ]); 
    }

    public function AgregarPaqueteALote(Request $request){
        $idLote = $request -> post("idLote");
        $idPaquete = $request -> post("idPaquete");
        if(!isset($idLote) || !isset($idPaquete))
            return view ("editarLote", [
                "mensajeEnAgregar" => "No se ingresó un id de lote o de paquete"
            ]);
        $loteEncontrado = Lote::find($idLote);
        $paqueteEncontrado = Paquete::find($idPaquete);
        if(!isset($loteEncontrado) || !isset($paqueteEncontrado))
            return view ("editarLote", [
                "mensajeEnAgregar" => "El paquete o lote ingresado no existe"
            ]);
        $paqueteEnLoteEncontrado = $this -> buscarPaqueteEnLote($idPaquete, $idLote) -> first();
        if(isset($paqueteEnLoteEncontrado))
            return view ("editarLote", [
                "mensajeEnAgregar" => "El paquete ingresado ya forma parte del lote"
            ]);
        LoteFormadoPor::create([
            "id_paquete" => $idPaquete,
            "id_lote" => $idLote
        ]);
        return view ("editarLote",[
            "mensajeEnAgregar" => "El paquete fue añadido al lote con éxito"
        ]);
    }

    public function RemoverPaqueteALote(Request $request){
        $idLote = $request -> post("idLote");
        $idPaquete = $request -> post("idPaquete");
        if(!isset($idLote) || !isset($idPaquete))
            return view ("editarLote", [
                "mensajeEnRemover" => "No se ingresó un id de lote o de paquete"
            ]);
        $loteEncontrado = Lote::find($idLote);
        $paqueteEncontrado = Paquete::find($idPaquete);
        if(!isset($loteEncontrado) || !isset($paqueteEncontrado))
            return view ("editarLote", [
                "mensajeEnRemover" => "El paquete o lote ingresado no existe"
            ]);
        $paqueteEnLoteEncontrado = $this -> buscarPaqueteEnLote($idPaquete, $idLote);
        if(null == $paqueteEnLoteEncontrado -> first())
            return view ("editarLote", [
                "mensajeEnRemover" => "El paquete ingresado no forma parte del lote"
            ]);
        $paqueteEnLoteEncontrado -> delete(); 
        return view ("editarLote",[
            "mensajeEnRemover" => "El paquete fue removido del lote con éxito"
        ]);
    }
}

