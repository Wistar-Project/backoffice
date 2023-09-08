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

class PersonaController extends Controller
{
    private function validarDatos($request){
        return Validator::make($request->all(),[
            'email' => 'required|email|unique:users',
            'rol'=> 'required|in:administrador,funcionario,conductor',
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'password' => 'required|confirmed'
        ]);
    }

    public function CrearPersona(Request $request){
        $validacion = $this -> validarDatos($request);
        if($validacion -> errors())
            return view("crearUsuario", [
                "mensaje" => "Uno de los campos es inválido. Por favor, revise los campos."
            ]);
        DB::transaction(function() use($request){
            $usuario = $this -> registrarUsuario($request);
            $this -> registrarPersona($request, $usuario -> id);
            $this -> agregarRolAPersona($usuario -> id, $request -> post('rol'));
        });
        return view("crearUsuario", [
            "mensaje" => "El usuario ha sido creado satisfactoriamente."
        ]);
    }

    private function registrarPersona($request, $id){
        $persona = new Persona();
        $persona -> nombre = $request -> post('nombre');
        $persona -> apellido = $request -> post('apellido');
        $persona -> id = $id;
        $persona -> save();
        return $persona;
    }

    private function createConductor($id){
        $conductor = new Conductor();
        $conductor -> id = $id;
        $conductor -> save();
    }

    private function createAdministrador($id){
        $administrador = new Administrador();
        $administrador -> id = $id;
        $administrador -> save();
    }

    private function createFuncionario($id){
        $funcionario = new Funcionario();
        $funcionario -> id = $id;
        $funcionario -> save();
    }
    private function agregarRolAPersona($id, $rol){
        if($rol == 'administrador')
            return $this -> createAdministrador($id);
        if($rol == 'conductor')
            return $this -> createConductor($id);
        return $this -> createFuncionario($id);
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
        return view("listarUsuarios", [
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
}
