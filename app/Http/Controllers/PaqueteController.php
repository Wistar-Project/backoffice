<?php

namespace App\Http\Controllers;
use App\Models\Paquete;
use App\Models\Alojamiento;
use Illuminate\Http\Request;

class PaqueteController extends Controller
{
    public function ListarPaquetes(){
        $paquetes=Paquete::all();
        foreach($paquetes as $paquete){
            $idDestino=$paquete->destino;
            $destino=Alojamiento::find($idDestino)->direccion;
            $paquete->destino=$destino;
        }
        return view('listarPaquetes',[
            "paquetes"=>$paquetes
        ]);
    }

    public function BorrarPaquete(Request $request){
        $id=$request->post('id');
        if(!isset($id))
            return view ("borrarPaquete", [
                "mensaje" => "No se ingresó un id del paquete"
            ]);
        $paqueteEncontrado= Paquete::find($id);
        if(!isset($paqueteEncontrado))
            return view ("borrarPaquete", [
                "mensaje" => "El paquete ingresado no existe"
            ]);
        $paqueteEncontrado->delete();
        return view('borrarPaquete', [
            "mensaje"=> "El paquete ha sido borrado satisfactoriamente"
        ]);
    }
}
