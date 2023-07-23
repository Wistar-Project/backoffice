<?php

namespace App\Http\Controllers;
use App\Models\Almacen;
use App\Models\Hogar;
use App\Models\Sede;
use Illuminate\Http\Request;
use App\Models\Alojamiento;
use App\Models\SedeHogar;
use App\Models\AlojamientoTipo;
class AlojamientoController extends Controller
{
    private function obtenerDatos($request){
        $direccion = $request -> post('direccion');
        $tipo = $request -> post('tipo');
        return [$direccion, $tipo];
    }

    private function comprobarExistenciaDeAlojamientoConDireccion($direccion){
        $alojamientos = Alojamiento::all();
        foreach($alojamientos as $alojamiento){
            if($direccion != $alojamiento -> direccion) continue;
            return true;
        }
        return false;
    }

    private function crearSedeUHogar($tipo, $idAlojamiento){
        SedeHogar::create([
            'id' => $idAlojamiento
        ]);
        if($tipo == 'sede')
            Sede::create([
                'id' => $idAlojamiento
            ]);
        if($tipo == 'hogar')
            Hogar::create([
                'id' => $idAlojamiento
            ]);
    }

    public function CrearAlojamiento(Request $request){
        [$direccion, $tipo] = $this -> obtenerDatos($request);
        if(!isset($direccion) || !isset($tipo)){
            return view('crearAlojamiento', [
                "mensaje" => "no se ingreso la dirección o el tipo"
            ]);
        }
        $tipos = ["almacen", "sede", "hogar"];
        if(!in_array($tipo, $tipos))
            return view("crearAlojamiento", [
                "mensaje" => "Ese tipo no es válido"
            ]);
        if($this -> comprobarExistenciaDeAlojamientoConDireccion($direccion))
            return view('crearAlojamiento', [
                "mensaje" => "Ya existe un alojamiento con esa dirección"
            ]);
        $yaHayAlmacen = count(Almacen::all()) >= 1;
        if($tipo == 'almacen' && $yaHayAlmacen)
            return view('crearAlojamiento', [
                "mensaje" => "No puedes crear mas de un almacén"
            ]);
        $idAlojamiento = Alojamiento::create([
            'direccion' => $direccion
        ]) -> id;
        if($tipo == 'almacen'){
            Almacen::create([
                'id' => $idAlojamiento
            ]);
            return view('crearAlojamiento',[
                "mensaje" => "Alojamiento creado satisfactoriamente"
            ]);
        }
        $this -> crearSedeUHogar($tipo, $idAlojamiento);
        return view('crearAlojamiento',[
            "mensaje" => "Alojamiento creado satisfactoriamente"
        ]);
    }

    public function BorrarAlojamiento(Request $request){
        $id = $request -> post("id");
        if(!isset($id))
            return view("borrarAlojamiento", [
                "mensaje" => "No has ingresado un id"
            ]);
        $alojamiento = Alojamiento::find($id);
        if(!isset($alojamiento))
            return view("borrarAlojamiento", [
                "mensaje" => "El alojamiento ingresado no existe"
            ]);
        $alojamiento -> delete();
        return view("borrarAlojamiento", [
            "mensaje" => "Alojamiento borrado satisfactoriamente"
        ]);
    }

    private function obtenerAlojamientos(){
        $alojamientos = Alojamiento::all();
        foreach($alojamientos as $alojamiento){
            $tipo = AlojamientoTipo::where("id", $alojamiento -> id) -> first() -> tipo;
            $alojamiento -> tipo = $tipo;
        }
        return $alojamientos;
    }

    public function ListarAlojamientos(){
        return view("listarAlojamientos", [
            "alojamientos" => $this -> obtenerAlojamientos()
        ]);
    }
}
