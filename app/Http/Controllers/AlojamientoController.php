<?php

namespace App\Http\Controllers;
use App\Models\Almacen;
use App\Models\Hogar;
use App\Models\Sede;
use Illuminate\Http\Request;
use App\Models\Alojamiento;
use App\Models\SedeHogar;
class AlojamientoController extends Controller
{
    public function CrearAlojamiento(Request $request){
        function crearSede($id){
            SedeHogar::create([
                'id'=> $id
            ]);
            Sede::create([
                'id'=> $id
            ]);
        }
        function crearHogar($id){
            SedeHogar::create([
                'id'=> $id
            ]);
            Hogar::create([
                'id'=> $id
            ]);
        }
        $direccion=$request->post('direccion');
        $tipo=$request->post('tipo');
        if(!isset($direccion) || !isset($tipo)){
            return view('crearAlojamiento',[
                "mensaje"=> "no se ingreso la dirección o el tipo"
            ]);
        }
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
        }
        if($tipo == 'sede') crearSede($idAlojamiento);
        if($tipo == 'hogar') crearHogar($idAlojamiento);
        return view('crearAlojamiento',[
            "mensaje"=> "Alojamiento creado satisfactoriamente"
        ]);
    }
}
