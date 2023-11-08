<?php

namespace App\Http\Controllers;
use App\Models\Almacen;
use App\Models\Sede;
use Exception;
use Illuminate\Http\Request;
use App\Models\Alojamiento;
use App\Models\AlojamientoTipo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SedeController extends Controller
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
        DB::transaction(function() use($tipo, $direccion){
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
        });
    }

    public function CrearAlojamiento(Request $request){
        $validacion = $this -> validarDatos($request);
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

    public function Borrar(Request $request, $idSede){
        try{
            DB::transaction(function() use($idSede){
                Sede::findOrFail($idSede) -> delete();
                Sede::findOrFail(259);
                Alojamiento::findOrFail($idSede) -> delete();
            });
            return $this -> Listar();
        }catch(Exception $e){
            return view("sedes", [
                "sedes" => Sede::all(),
                "errorOcurrido" => "Hay paquetes/lotes con destino a esa sede. Entregue estos primero."
            ]);
        }
    
    }

    public function Listar(){
        return view("sedes", [
            "sedes" => Sede::all()
        ]);
    }
}
