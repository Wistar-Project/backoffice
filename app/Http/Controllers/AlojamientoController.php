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
    public function CrearAlojamiento(Request $request){
        $direccion=$request->post('direccion');
        $tipo=$request->post('tipo');
        if(!isset($direccion) || !isset($tipo)){
            return view('crearAlojamiento',[
                "mensaje"=> "no se ingreso la dirección o el tipo"
            ]);
        }
        if($tipo != "almacen" && $tipo != "sede" && $tipo != "hogar")
            return view("crearAlojamiento", [
                "mensaje" => "Ese tipo no es válido"
            ]);
        $alojamientos=Alojamiento::all();
        foreach($alojamientos as $alojamiento){
            if($direccion != $alojamiento->direccion) continue;
            return view('crearAlojamiento',[
                "mensaje"=> "Ya existe un alojamiento con esa dirección"
            ]);
        }
        if($tipo == 'almacen' && count(Almacen::all())==1)
            return view('crearAlojamiento',[
                "mensaje"=> "No puedes crear mas de un almacén"
            ]);
        $idAlojamiento=Alojamiento::create([
            'direccion'=> $direccion
        ])->id;
        if($tipo == 'almacen'){
            Almacen::create([
                'id'=> $idAlojamiento
            ]);
            return view('crearAlojamiento',[
                "mensaje"=> "Alojamiento creado satisfactoriamente"
            ]);
        }
        SedeHogar::create([
            'id'=> $idAlojamiento
        ]);
        if($tipo == 'sede') {
            Sede::create([
                'id'=> $idAlojamiento
            ]);
        }
        if($tipo == 'hogar') {
            Hogar::create([
                'id'=> $idAlojamiento
            ]);
        }
        return view('crearAlojamiento',[
            "mensaje"=> "Alojamiento creado satisfactoriamente"
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

    public function ListarAlojamientos(){
        $alojamientos = Alojamiento::all();
        foreach($alojamientos as $alojamiento){
            $tipo = AlojamientoTipo::where("id", $alojamiento -> id) -> first() -> tipo;
            $alojamiento -> tipo = $tipo;
        }
        return view("listarAlojamientos", [
            "alojamientos" => $alojamientos
        ]);
    }
}
