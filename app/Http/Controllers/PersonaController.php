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
    private function listarConError($error){
        return view("usuarios",[
            "personas"=> $this-> obtenerPersonas(),
            "mensaje"=>[
                "color" => "rgba(85, 38, 38, 0.959)",
                "texto"=> $error
            ]
        ]);
    }
    private function ListarConmensaje($mensaje){
        return view("usuarios",[
            "personas"=> $this-> obtenerPersonas(),
            "mensaje"=> [
                "color"=> "green",
                "texto"=>$mensaje
            ]
        ]);
    }
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
      $validar = $this-> validarDatos($request);
      if($validar -> fails())
            return $this-> listarConError("Faltan datos para ingresar");
            DB::transaction(function() use($request){
                $usuario = $this -> registrarUsuario($request);
                $this -> registrarPersona($request, $usuario -> id);
                $this -> agregarRolAPersona($usuario -> id, $this-> obtenerDatos($request)["rol"]);
            });
            return $this-> ListarConmensaje("Usuario creado satisfactoriamente");
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
        $user = new User();
        $user -> email = $this-> obtenerDatos($request)["email"];
        $user -> password = $this-> obtenerDatos($request)["password"];
        $user -> save();
        return $user;
    }
    private function registrarPersona(Request $request,$id){
        $persona = new Persona();
        $persona -> nombre = $this-> obtenerDatos($request)["nombre"];
        $persona -> apellido = $this-> obtenerDatos($request)["apellido"];
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

    public function ListarPersonas(){
        return view("usuarios", [
            "personas" => $this -> obtenerPersonas()
        ]);
    }
    public function VerInformacionDePersona($id)
    {
        $user = User::findOrFail($id);
        $persona = Persona::findOrFail($id);
        $rol = PersonaRol::find($id) -> rol;
        return [
            "nombre" => $persona -> nombre,
            "apellido" => $persona -> apellido,
            "email" => $user -> email,
            "rol" => $rol 
        ];
    }
    private function borrarRol($id){
        $rol = PersonaRol::findOrFail($id)->rol;
        if($rol == 'administrador')
            Administrador::findOrFail($id)->delete();
        if($rol == 'funcionario')
            Funcionario::findOrFail($id)->delete();
        if($rol == 'conductor')
            Conductor::findOrFail($id)->delete();
        if($rol == 'gerente')
            return $this-> listarConError("No puedes eliminar un usuario Gerente");
    
    }
    public function BorrarUsuario($id){
        $this->borrarRol($id);
        Persona::findOrFail($id)->delete();
        User::findOrFail($id)->delete();
        return $this-> ListarConmensaje("El usuario ha sido eliminado");
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

    private function editarUsuario($request,$id){
        $usuario = User::find($id);
        $datos = $this-> obtenerDatosEnEditarPersona();
        $usuario -> password = Hash::make($datos -> contrasenia);
        $usuario -> save(); 
    }

    public function CerrarSesion(){
        Auth::logout();
        return redirect("http://localhost:5500");
    }
}
