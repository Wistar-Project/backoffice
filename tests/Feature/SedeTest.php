<?php

namespace Tests\Feature;

use App\Models\Administrador;
use App\Models\Alojamiento;
use App\Models\AlojamientoTipo;
use App\Models\Funcionario;
use App\Models\Paquete;
use App\Models\Persona;
use App\Models\Sede;
use App\Models\User;
use Tests\TestCase;

class SedeTest extends TestCase
{
    public function crearAdministrador(){
        $user = User::factory() -> create();
        Persona::create([ "id" => $user -> id, "nombre" => "a", "apellido" => "a" ]);
        Administrador::create([ "id" => $user -> id ]);
        return $user;
    }

    public function crearFuncionario(){
        $user = User::factory() -> create();
        Persona::create([ "id" => $user -> id, "nombre" => "a", "apellido" => "a" ]);
        Funcionario::create([ "id" => $user -> id ]);
        return $user;
    }

    public function test_crear()
    {
        $response = $this->actingAs($this -> crearAdministrador())->post('/sedes', [
            "direccion" => "Avenida Italia 1258"
        ]);
        $this -> assertDatabaseHas("alojamientos", [
            "direccion" => "Avenida Italia 1258"
        ]);
        $response -> assertViewHas("mensaje", [
            "color" => "green",
            "texto" => "Sede creada satisfactoriamente."
        ]);
        $response->assertStatus(200);
    }

    public function test_crear_con_direccion_usada()
    {
        $response = $this->actingAs($this -> crearAdministrador())->post('/sedes', [
            "direccion" => "Dirección usada"
        ]);
        $this -> assertDatabaseHas("alojamientos", [
            "direccion" => "Dirección usada"
        ]);
        $response = $this->actingAs($this -> crearAdministrador())->post('/sedes', [
            "direccion" => "Dirección usada"
        ]);
        $response -> assertViewHas("mensaje", [
            "color" => "rgba(85, 38, 38, 0.959)",
            "texto" => "Ya hay una sede con esa dirección."
        ]);
        $response->assertStatus(200);
    }

    public function test_listar()
    {
        $response = $this->actingAs($this->crearAdministrador())->get('/sedes');
        $response->assertStatus(200);
    }

    public function test_borrar()
    {
        $response = $this->actingAs($this->crearAdministrador())->delete('/sedes/1');
        $response -> assertViewHas("mensaje", [
            "color" => "green",
            "texto" => "Sede eliminada satisfactoriamente."
        ]);
        $response->assertStatus(200);
    }

    public function test_borrar_con_paquetes_asignados()
    {
        Alojamiento::create(["id" => 10, "direccion" => "Dirección 10"]);
        Sede::create(["id" => 10]);
        Paquete::create(["id" => 1, "peso_en_kg" => 5, "email" => "a@gmail.com", "destino" => 10]);
        $response = $this->actingAs($this->crearAdministrador())->delete('/sedes/10');
        $response -> assertViewHas("mensaje", [
            "color" => "rgba(85, 38, 38, 0.959)",
            "texto" => "Hay paquetes/lotes con destino a esa sede. Entreguelos primero."
        ]);
        $response->assertStatus(200);
    }
    public function test_borrar_inexistente()
    {
        $response = $this->actingAs($this->crearAdministrador())->delete('/sedes/99');
        $response -> assertViewHas("mensaje", [
            "color" => "rgba(85, 38, 38, 0.959)",
            "texto" => "Esa sede ya no existe. La lista ha sido recargada."
        ]);
        $response->assertStatus(200);
    }

    public function test_listar_sin_autenticarse()
    {
        $response = $this->post('/sedes');
        $response->assertStatus(302);
    }
}
