<?php

namespace App\Http\Controllers;

use App\Models\PersonaRol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Persona;
use App\Models\User;

class PersonaController extends Controller
{
    public function CrearPersona(Request $request){
        $OK_HTTP_CODE = 200;
        $datos = [
            "nombre" => $request -> post("nombre"),
            "apellido" => $request -> post("apellido"),
            "email" => $request -> post("email"),
            "rol" => $request -> post("rol"),
            "password" => $request -> post("contraseña"),
            "password_confirmation" => $request -> post("confirmarContraseña")
        ];
        $response = Http::post("localhost:8000/api/v1/user", $datos);
        if($response -> status() == $OK_HTTP_CODE){
            return view("crearUsuario", [
                "mensaje" => "El usuario ha sido creado satisfactoriamente."
            ]);
        }
        return view("crearUsuario", [
            "mensaje" => "Ha ocurrido un error al crear el usuario."
        ]);
    }

    private function obtenerPersonas(){
        $personas = Persona::all();
        $personasCompleto = [];
        foreach($personas as $persona){
            $email = User::find($persona -> id) -> email;
            $rol = PersonaRol::find($persona -> id) -> rol;
            array_push($personasCompleto, [
                "id" => $persona -> id,
                "nombre" => $persona -> nombre,
                "apellido" => $persona -> apellido,
                "email" => $email,
                "rol" => $rol
            ]);
        }
        return $personasCompleto;
    }

    public function ListarPersonas(Request $request){
        $personas = $this -> obtenerPersonas();
        return view("listarUsuarios", [
            "personas" => $personas,
        ]);
    }

    public function ListarPersona(Request $request){
        $emailPersona = $request -> post("email");
        $personas = $this -> obtenerPersonas();
        if(!isset($emailPersona)) 
            return view("listarUsuarios", [
                "personas" => $personas
            ]);
        $id = User::where("email", $emailPersona) -> get() -> first() -> id;
        $rol = PersonaRol::find($id) -> rol;
        $datosRestantes = Persona::find($id);
        return view("listarUsuarios", [
            "personaEncontrada" => [
                "id" => $id,
                "email" => $emailPersona,
                "rol" => $rol,
                "apellido" => $datosRestantes["apellido"],
                "nombre" => $datosRestantes["nombre"],
            ],
            "personas" => $personas
        ]);
    }
}
