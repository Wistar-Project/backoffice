<?php

namespace App\Http\Controllers;

use App\Models\Alojamiento;
use App\Models\LoteFormadoPor;
use App\Models\Lote;
use App\Models\Camion;
use App\Models\LoteAsignadoACamion;
use App\Models\Paquete;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    private function listarConError($error){
        return view("lotes",[
            "personas"=> $this-> obtenerLotes(),
            "mensaje"=>[
                "color" => "rgba(85, 38, 38, 0.959)",
                "texto"=> $error
            ]
        ]);
    }
    private function ListarConmensaje($mensaje){
        return view("lotes",[
            "lotes"=> $this-> obtenerLotes(),
            "mensaje"=> [
                "color"=> "green",
                "texto"=>$mensaje
            ]
        ]);
    }
    private function obtenerLotes(){
        return Lote::all();
    }
    public function ListarLotes(){
        return view("lotes",[
            "lotes"=> $this-> obtenerLotes(),
            "camiones" => Camion::all()
        ]);
    }
    public function VerInformacionDeLote($id){
        $lote = Lote::find($id);
        $paquetes = LoteFormadoPor::where("id_lote",$id )->get()->pluck("id_paquete");
        $pesoLote = 0;
        foreach( $paquetes as $paquete){
            $peso = Paquete::find($paquete) -> peso_en_kg;
            $pesoLote += $peso;
        }
        return [
            "peso" => $pesoLote,
            "destino" => Alojamiento::find($lote -> destino,) -> direccion, 
            "fechaDeModificacion" => $lote -> updated_at,
            "paquetes" => $paquetes
        ];
    }
    public function EliminarLotes($id){
            $lote = Lote::find($id);
            $lote -> delete();
            return $this-> ListarConmensaje("El lote ha sido borrado existosamente");
    }
    
    public function Asignar($idLote,$idCamion){
            $asignado = LoteAsignadoACamion();
            $asignado -> id_lote = $idLote;
            $asignado -> id_camion = $idCamion;
            $asignado -> save();
            return $this-> ListarConmensaje("Lote asignado correctamente");
    }

}

