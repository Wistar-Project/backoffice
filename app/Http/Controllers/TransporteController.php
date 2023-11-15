<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use App\Models\ConductorManeja;
use App\Models\LoteAsignadoACamion;
use App\Models\PaqueteAsignadoAPickup;
use App\Models\Persona;
use App\Models\Pickup;
use App\Models\Vehiculo;
use App\Models\VehiculoTipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransporteController extends Controller
{
    public function Listar(){
        return view('transporte/listar', [
            "camiones" => Camion::all()->pluck('id_vehiculo'),
            "pickups" => Pickup::all()->pluck('id_vehiculo')
        ]);
    }

    public function VerUno(Request $request, $id){
        return view('transporte/ver-uno', [
            "camiones" => Camion::all()->pluck('id_vehiculo'),
            "pickups" => Pickup::all()->pluck('id_vehiculo'),
            "tipo" => VehiculoTipo::findOrFail($id) -> tipo,
            "capacidad" => Vehiculo::findOrFail($id) -> capacidad_en_toneladas,
            "conductor" => $this -> conductorAsignado($id),
            "paquetesOLotesAsignados" => $this -> paquetesOLotesAsignados($id),
            "id" => $id
        ]);
    }

    private function paquetesOLotesAsignados($id){
        $tipo = VehiculoTipo::findOrFail($id) -> tipo;
        if($tipo == "camión")
            return LoteAsignadoACamion::where('id_camion', $id) -> get() -> pluck('id_lote');
        return PaqueteAsignadoAPickup::where('id_pickup', $id) -> get() -> pluck('id_paquete');
    }

    private function conductorAsignado($id){
        $conductor = ConductorManeja::where('id_vehiculo', $id) -> first();
        if($conductor){

            $persona = Persona::withTrashed()->findOrFail($conductor -> pluck('id_conductor'))->first();
            return $persona -> nombre . " " . $persona -> apellido;
        }
        return "No asignado";
    }

    public function Eliminar($id){
        if($this -> tieneLotesOPaquetesAsignados($id))
            return $this -> listarConError("El vehículo tiene lotes/paquetes asignados. Desasigne estos primero");
        $excepcion = DB::transaction(function() use($id){
            Vehiculo::findOrFail($id) -> delete();
            $this -> eliminarTipoVehiculo($id);
        });
        if(isset($excepcion))
            return $this -> listarConError("Ocurrió un error al intentar eliminar el vehículo");
        return $this -> listarConMensaje("Vehículo eliminado satisfactoriamente");
    }

    private function tieneLotesOPaquetesAsignados($id){
        $tipo = VehiculoTipo::findOrFail($id) -> tipo;
        if($tipo == "camión")
            return count(LoteAsignadoACamion::where("id_camion", $id) -> get()) > 0;
        return count(PaqueteAsignadoAPickup::where("id_pickup", $id) -> get()) > 0;
    }

    private function eliminarTipoVehiculo($id){
        $tipo = VehiculoTipo::findOrFail($id) -> tipo;
        if($tipo == "camión")
            return Camion::findOrFail($id) -> delete();
        Pickup::findOrFail($id) -> delete();
    }

    private function listarConError($error){
        return view("transporte/listar",[
            "camiones" => Camion::all()->pluck('id_vehiculo'),
            "pickups" => Pickup::all()->pluck('id_vehiculo'),
            "mensaje"=>[
                "color" => "rgba(85, 38, 38, 0.959)",
                "texto"=> $error
            ]
        ]);
    }
    private function listarConMensaje($mensaje){
        return view("transporte/listar",[
            "camiones" => Camion::all()->pluck('id_vehiculo'),
            "pickups" => Pickup::all()->pluck('id_vehiculo'),
            "mensaje"=> [
                "color"=> "green",
                "texto"=>$mensaje
            ]
        ]);
    }

    public function Crear(Request $request){
        $validacion = Validator::make($request->all(), [
            "peso" => "numeric|min:1",
            "tipo" => "in:camion,pickup"
        ]);
        if($validacion -> fails())
            return $this -> listarConError("Ingrese un peso real por favor");
        $excepcion = DB::transaction(function() use($request){
            $id = Vehiculo::create([ 
                "capacidad_en_toneladas" => $request -> input("peso") 
            ]) -> id;
            $this -> asignarTipoVehiculo($id, $request -> input("tipo"));
        });
        if(isset($excepcion))
            return $this -> listarConError("Ha ocurrido un error al intentar crear el vehículo");
        return $this -> listarConMensaje("Vehículo creado satisfactoriamente");
    }

    private function asignarTipoVehiculo($idVehiculo, $tipo){
        if($tipo == "camion")
            return Camion::create([ "id_vehiculo" => $idVehiculo ]);
        return Pickup::create([ "id_vehiculo" => $idVehiculo ]);
    }

    public function ListarCamiones(){
        return view('transporte/listar-camiones', [
            "camiones" => Camion::all()->pluck('id_vehiculo'),
        ]);
    }

    public function ListarPickups(){
        return view('transporte/listar-pickups', [
            "pickups" => Pickup::all()->pluck('id_vehiculo'),
        ]);
    }

    public function Desasignar(Request $request, $id){
        LoteAsignadoACamion::where('id_lote', $id) -> delete();
        PaqueteAsignadoAPickup::where('id_paquete', $id) -> delete();
        return $this -> listarConMensaje("Desasignado del vehículo satisfactoriamente");
    }
}
