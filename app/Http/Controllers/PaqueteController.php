<?php

namespace App\Http\Controllers;
use App\Models\Paquete;
use App\Models\Alojamiento;
use Illuminate\Http\Request;
use App\Models\LoteFormadoPor;
use App\Models\PaqueteAsignadoPickup;

class PaqueteController extends Controller
{
    private function obtenerPaquetes(){
        $paquetes=Paquete::all();
        return $paquetes;
    }

    public function ListarPaquetes(){
        return view('paquetes', [
            "paquetes" => $this -> obtenerPaquetes()
        ]);
    }

    public function VerInformacionDelPaquete($id){
        $paquete = Paquete::find($id);
        $destino = Alojamiento::find($paquete['destino']) -> direccion;
        $loteAsignado = LoteFormadoPor::where('id_paquete',$id) -> get() ->pluck('id_lote');
        $vehiculo = PaqueteAsignadoPickup::where('id_paquete',$id) -> get() ->pluck('id_pickup');
        return [
            "peso" => $paquete -> peso_en_kg,
            "destino" => $destino,
            "fechaDeCreacion" => $paquete -> created_at,
            "loteAsignado" => $loteAsignado ?? 'No asignado',
            "vehiculoAsignado" => $vehiculo ?? 'No asignado',
            "email" => $paquete -> email
        ];
    }
    public function EliminarPaquete($id){
        $paquete = Paquete::find($id);
        $paquete -> delete();
    }
}
 
