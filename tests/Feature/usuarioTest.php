<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Persona;
use App\Models\User;
use App\Models\Administrador;
use App\Models\Gerente;
use App\Models\PersonaRol;

class usuarioTest extends TestCase
{
    public function crearAdministrador(){
        $user = User::factory() -> create();
        Persona::create([ "id" => $user -> id, "nombre" => "a", "apellido" => "a" ]);
        Administrador::create([ "id" => $user -> id ]);
        return $user;
    }

    public function test_mostrarUsuariosSinAutenticarse()
    {
        $response = $this -> get('/usuarios', [
            "Accept" => "application/json"
        ]);
        $response -> assertStatus(401);
    }

    public function test_ver_informacion_de_persona(){
        User::create([ "id" => 10, "email" => "hola@gmail.com", "password" => "1234" ]);
        Persona::create([ "id" => 10, "nombre" => "Fabri", "apellido" => "Cobucci" ]);
        Administrador::create([ "id" => 10 ]);
        $response = $this -> actingAs($this -> crearAdministrador()) -> get('/usuarios/10');
        $response -> assertStatus(200);
        $response -> assertExactJson([
            "nombre" => "Fabri",
            "apellido" => "Cobucci",
            "email" => "hola@gmail.com",
            "rol" => "administrador"
        ]);
    }

    public function test_ver_informacion_de_persona_sin_autenticarse(){
        $response = $this -> get('/usuarios/10');
        $response -> assertStatus(302);
    }

    public function test_borrar_usuario_sin_autenticarse(){
        $response = $this -> delete('/usuarios/10');
        $response -> assertStatus(302);
    }

    public function test_borrar_usuario(){
        $response = $this -> actingAs($this -> crearAdministrador()) -> delete('/usuarios/10');
        $response -> assertStatus(200);
        $this -> assertEquals(null, User::find(10));
        $this -> assertEquals(null, Persona::find(10));
        $this -> assertEquals(null, Administrador::find(10));
        $response -> assertViewHas("mensaje", [
            "texto" => "El usuario ha sido eliminado",
            "color" => "green"
        ]);
    }

    public function test_borrar_gerente(){
        User::create([ "id" => 15, "email" => "gerente@elmail.com", "password" => "1234" ]);
        Persona::create([ "id" => 15, "nombre" => "Fabri", "apellido" => "Cobucci" ]);
        Gerente::create(["id" => 15]);
        $response = $this -> actingAs($this -> crearAdministrador()) -> delete('/usuarios/15');
        $response -> assertStatus(200);
        $response -> assertViewHas("mensaje", [
            "texto" => "No puedes eliminar un usuario gerente",
            "color" => "rgba(85, 38, 38, 0.959)"
        ]);
    }
}
