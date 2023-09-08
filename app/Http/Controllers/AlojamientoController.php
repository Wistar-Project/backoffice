<?php

namespace App\Http\Controllers;
use App\Models\Almacen;
use App\Models\Sede;
use Illuminate\Http\Request;
use App\Models\Alojamiento;
use App\Models\AlojamientoTipo;
use Illuminate\Support\Facades\DB;
class AlojamientoController extends Controller
{
    private function validarDatos($request){
        return Validator::make($request -> all(), [
            'direccion' => 'required|unique:alojamientos',
            'tipo'=> 'required|in:sede,almacen'
        ]);
    }

    private function obtenerDatos($request){
        $direccion = $request -> post('direccion');
        $tipo = $request -> post('tipo');
        return [$direccion, $tipo];
    }

    private function agregarAlojamiento($tipo, $direccion){
        DB::transaction(function use($tipo, $direccion){
            $idAlojamiento = Alojamiento::create([
                'direccion' => $direccion
            ]) -> id;
            if($tipo == 'almacen')
                return Almacen::create([
                    'id' => $idAlojamiento
                ]);
            Sede::create([
                'id' => $idAlojamiento
            ]);
        })
    }

    public function CrearAlojamiento(Request $request){
        $validacion = $this -> validarDatos();
        if($validacion -> fails())
            return view('crearAlojamiento', [
                "mensaje" => "Ha ocurrido un error. Por favor, revise los campos."
            ]);
        [ $direccion, $tipo ] = $this -> obtenerDatos($request);
        $yaHayAlmacen = count(Almacen::all()) >= 1;
        if($tipo == 'almacen' && $yaHayAlmacen)
            return view('crearAlojamiento', [
                "mensaje" => "No puedes crear mas de un almacén"
            ]);
        $this -> agregarAlojamiento($tipo, $direccion);
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
