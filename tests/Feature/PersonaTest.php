<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\PersonaRol;
use App\Models\Persona;
use Tests\TestCase;

class PersonaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

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

    public function test_ListarPersonas()
    {
        $response = $this -> get('/listar');
        $response -> assertStatus(200);
        $response -> assertViewHas("personas", $this -> obtenerPersonas());
    }

    public function test_ListarUsuario()
    {
        $response = $this -> post('/listar', [
            "email" => "usuario@usuario"
        ]);
        $response -> assertStatus(200);
        $response -> assertViewHas("personas", $this -> obtenerPersonas());
        $response -> assertViewHas("personaEncontrada", [
            "id" => 1,
            "email" => "usuario@usuario",
            "rol" => "administrador",
            "nombre" => "pepe",
            "apellido" => "hola"
        ]);
    }

    public function test_ListarUsuarioQueNoExiste()
    {
        $response = $this -> post('/listar', [
            "email" => "usuarsdadasfasfwqrqrio@sdad"
        ]);
        $response -> assertStatus(200);
        $response -> assertViewHas("personas", $this -> obtenerPersonas());
        $response -> assertViewHas("personaNoEncontrada", true);
    }

    public function test_CrearAdministrador()
    {
        $response = $this -> post('/crear', [
            "nombre" => "pepito",
            "apellido" => "cobucci",
            "email" => "pepito329061129582@gmail.com",
            "password" => "soypepe19",
            "password_confirmation" => "soypepe19",
            "rol" => "administrador"
        ]);
        $response -> assertStatus(200);
        $response -> assertViewHas("mensaje", "El usuario ha sido creado satisfactoriamente.");
    }

    public function test_CrearFuncionario()
    {
        $response = $this -> post('/crear', [
            "nombre" => "martin",
            "apellido" => "cazeneuve",
            "email" => "elkc1928@outlook.es",
            "password" => "soypepe19",
            "password_confirmation" => "soypepe19",
            "rol" => "funcionario"
        ]);
        $response -> assertStatus(200);
        $response -> assertViewHas("mensaje", "El usuario ha sido creado satisfactoriamente.");
    }

    public function test_CrearConductor()
    {
        $response = $this -> post('/crear', [
            "nombre" => "gabriel",
            "apellido" => "pereira",
            "email" => "gabu1762@hotmail.com",
            "password" => "soypepe19",
            "password_confirmation" => "soypepe19",
            "rol" => "conductor"
        ]);
        $response -> assertStatus(200);
        $response -> assertViewHas("mensaje", "El usuario ha sido creado satisfactoriamente.");
    }

    public function test_CrearConductorSinApellido()
    {
        $response = $this -> post('/crear', [
            "nombre" => "gabriel",
            "email" => "gabu1762@hotmail.com",
            "password" => "soypepe19",
            "password_confirmation" => "soypepe19",
            "rol" => "conductor"
        ]);
        $response -> assertStatus(200);
        $response -> assertViewHas("mensaje", "Ha ocurrido un error al crear el usuario.");
    }

    public function test_EditarUsuario()
    {
        $response = $this -> post('/editar', [
            "nombre" => "Pepito",
            "apellido" => "Grande",
            "email" => "usuario@usuario",
            "contraseña" => "nuevacontra"
        ]);
        $response -> assertStatus(200);
        $response -> assertViewHas("mensaje", "La persona ha sido modificada satisfactoriamente.");
    }

    public function test_EditarUsuarioSinNombre()
    {
        $response = $this -> post('/editar', [
            "apellido" => "Grande",
            "email" => "usuario@usuario",
            "contraseña" => "nuevacontra"
        ]);
        $response -> assertStatus(200);
        $response -> assertViewHas("mensaje", "Debes ingresar un nombre.");
    }
}
