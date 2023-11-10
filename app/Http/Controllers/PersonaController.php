<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\PersonaRol;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Administrador;
use App\Models\Conductor;
use App\Models\Funcionario;
use Auth;

class PersonaController extends Controller
{
    private function validarDatos($request){
        return Validator::make($request->all(),[
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'email' => 'required|email|unique:users',
            'rol'=> 'required|in:administrador,funcionario,conductor',
            'password' => 'required|confirmed'
        ]);
    }

    public function CrearPersona(Request $request){
      
    }

    private function obtenerDatos(Request $request){
        $nombre = $request -> post('nombre');
        $apellido = $request -> post('apellido');
        $email = $request -> post('email');
        $rol = $request -> post('rol');
        $password = Hash::make( $request -> post('password') );
        return [
            "nombre" => $nombre,
            "apellido" => $apellido,
            "email" => $email,
            "rol" => $rol,
            "password" => $password
        ];
    }
    private function registrarUsuario(Request $request){
        
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
        return view("usuarios", [
            "personas" => $this -> obtenerPersonas()
        ]);
    }

    public function ListarPersona(Request $request){
        $emailPersona = $request -> post("email");
        $personas = $this -> obtenerPersonas();
        if(!isset($emailPersona)) 
            return view("listarUsuarios", [
                "personas" => $personas,
                "personaNoEncontrada" => true
            ]);
        $usuario = User::where("email", $emailPersona) -> get() -> first();
        if(!isset($usuario)) 
            return view("listarUsuarios", [
                "personas" => $personas,
                "personaNoEncontrada" => true
            ]);
        $id = $usuario -> id;
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

    private function obtenerDatosEnEditarPersona($request){
        $email = $request -> post("email");
        $nombre = $request -> post("nombre");
        $apellido = $request -> post("apellido");
        $contrasenia = $request -> post("contraseña");
        return [
            $email,
            $nombre,
            $apellido,
            $contrasenia
        ];
    }

    private function editarUsuarioYPersona($usuario, $nombre, $apellido, $contrasenia){
        $usuario -> password = Hash::make($contrasenia);
        $usuario -> save();
        $id = $usuario -> id;
        $persona = Persona::find($id);
        $persona -> nombre = $nombre;
        $persona -> apellido = $apellido;
        $persona -> save();
    }

    public function EditarPersona(Request $request){
        [
            $email,
            $nombre,
            $apellido,
            $contrasenia
        ] = $this -> obtenerDatosEnEditarPersona($request);
        if(!isset($nombre))
            return view("editarUsuario", [
                "mensaje" => "Debes ingresar un nombre."
            ]);
        if(!isset($apellido))
            return view("editarUsuario", [
                "mensaje" => "Debes ingresar un apellido."
            ]);
        if(!isset($contrasenia))
            return view("editarUsuario", [
                "mensaje" => "Debes ingresar una contraseña."
            ]);
        $usuario = User::where("email", $email) -> get() -> first();
        if($usuario == null)
            return view("editarUsuario", [
                "mensaje" => "La persona ingresada no existe."
            ]);
        $this -> editarUsuarioYPersona($usuario, $nombre, $apellido, $contrasenia);
        return view("editarUsuario", [
            "mensaje" => "La persona ha sido modificada satisfactoriamente.",
        ]);
    }

    public function CerrarSesion(){
        Auth::logout();
        return redirect("http://localhost:5500");
    }
}
