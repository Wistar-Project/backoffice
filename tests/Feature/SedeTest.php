<?php

namespace Tests\Feature;

use App\Models\Alojamiento;
use App\Models\AlojamientoTipo;
use App\Models\Sede;
use App\Models\User;
use Tests\TestCase;

class SedeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_crear()
    {
        $response = $this->actingAs(User::findOrFail(1))->post('/sedes', [
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

    public function test_crearConDireccionUsada()
    {
        $this -> assertDatabaseHas("alojamientos", [
            "direccion" => "Dirección usada"
        ]);
        $response = $this->actingAs(User::findOrFail(1))->post('/sedes', [
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
        $response = $this->actingAs(User::findOrFail(1))->get('/sedes');
        $response->assertStatus(200);
    }

    public function test_borrar()
    {
        $response = $this->actingAs(User::findOrFail(1))->delete('/sedes/1');
        $response -> assertViewHas("mensaje", [
            "color" => "green",
            "texto" => "Sede eliminada satisfactoriamente."
        ]);
        $response->assertStatus(200);
    }

    public function test_borrarConPaquetesAsignados()
    {
        $response = $this->actingAs(User::findOrFail(1))->delete('/sedes/2');
        $response -> assertViewHas("mensaje", [
            "color" => "rgba(85, 38, 38, 0.959)",
            "texto" => "Hay paquetes/lotes con destino a esa sede. Entreguelos primero."
        ]);
        $response->assertStatus(200);
    }
    public function test_borrarInexistente()
    {
        $response = $this->actingAs(User::findOrFail(1))->delete('/sedes/99');
        $response -> assertViewHas("mensaje", [
            "color" => "rgba(85, 38, 38, 0.959)",
            "texto" => "Esa sede ya no existe. La lista ha sido recargada."
        ]);
        $response->assertStatus(200);
    }

    public function test_listarSinAutenticarse()
    {
        $response = $this->post('/sedes');
        $response->assertStatus(302);
    }

    public function test_listarSinSerAdministrador()
    {
        $response = $this->actingAs(User::findOrFail(2))->post('/sedes');
        $response->assertStatus(302);
    }
}
