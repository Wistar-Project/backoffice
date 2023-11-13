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
            "lotes"=> $this-> obtenerLotes()
        ]);
    }
    

}

