<?php

namespace App\Http\Controllers;

use App\Models\Alojamiento;
use App\Models\LoteFormadoPor;
use App\Models\Lote;
use App\Models\Paquete;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    private function listarConError($error){
        return view("lotes",[
            "personas"=> $this-> obtenerPersonas(),
            "mensaje"=>[
                "color" => "rgba(85, 38, 38, 0.959)",
                "texto"=> $error
            ]
        ]);
    }
    private function ListarConmensaje($mensaje){
        return view("lotes",[
            "personas"=> $this-> obtenerPersonas(),
            "mensaje"=> [
                "color"=> "green",
                "texto"=>$mensaje
            ]
        ]);
    }
    

}

