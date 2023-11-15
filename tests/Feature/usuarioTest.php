<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Persona;

class usuarioTest extends TestCase
{
    public function crearAdministrador(){
        $user = User::factory() -> create();
        Persona::create([ "id" => $user -> id, "nombre" => "a", "apellido" => "a" ]);
        Administrador::create([ "id" => $user -> id ]);
        return $user;
    }
    public function test_mostrarUsuarios()
    {
        $response = $this->get('/usuarios');
        $response->assertStatus(200);
        $response -> assertViewHas("personas",$this -> obtenerLasPersonas(Persona::all()));
    }
    public function test_crearPersona(){
        $response -> actingAs($this-> crearAdministrador()) -> $this->post('/usuarios');
    }
    private function convertirPersonas($personas){
        $personasConvertido = [];
        foreach($personas as $persona){
            $email = User::withTrashed()->find($persona -> id) -> email;
            $rol = PersonaRol::find($persona -> id) -> rol;
            array_push($personasConvertido, [
                "id" => $persona -> id,
                "nombre" => $persona -> nombre,
                "apellido" => $persona -> apellido,
                "email" => $email,
                "rol" => $rol
            ]);
        }
        return $personasConvertido;
    }

    private function obtenerLasPersonas(Request $request){
        $nombre = $request->get('nombre');
        $email = $request->get('email');
        if($request -> get("todos"))
            return DB::table("users") -> join("personas", function(JoinClause $join) use($nombre, $email){
                $join -> on("users.id", "=", "personas.id")
                        -> where("personas.nombre", "like", "%{$nombre}%")
                        -> where("users.email", "like", "%{$email}%");
            }) -> get();
        return DB::table("users") -> join("personas", function(JoinClause $join) use($nombre, $email){
            $join -> on("users.id", "=", "personas.id")
                    -> where("personas.nombre", "like", "%{$nombre}%")
                    -> where("users.email", "like", "%{$email}%")
                    -> where("users.deleted_at", null);
        }) -> get();
    }

}
