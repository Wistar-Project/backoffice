<?php

namespace Tests\Feature;

use App\Models\Alojamiento;
use App\Models\AlojamientoTipo;
use App\Models\Sede;
use Tests\TestCase;

class AlojamientoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_crear()
    {
        $response = $this->post('/sedes', [
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
        $response = $this->post('/sedes', [
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
        $response = $this->get('/sedes');
        $response -> assertViewHas("alojamientos", Sede::all());
        $response->assertStatus(200);
    }

    public function test_borrar()
    {
        $response = $this->delete('/sedes/1');
        $response -> assertViewHas("mensaje", [
            "color" => "green",
            "texto" => "Sede eliminada satisfactoriamente."
        ]);
        $response->assertStatus(200);
    }

    public function test_borrarConPaquetesAsignados()
    {
        $response = $this->post('/sedes/2');
        $response -> assertViewHas("mensaje", [
            "color" => "rgba(85, 38, 38, 0.959)",
            "texto" => "Hay paquetes/lotes con destino a esa sede. Entreguelos primero."
        ]);
        $response->assertStatus(200);
    }
    public function test_borrarInexistente()
    {
        $response = $this->post('/sedes/99');
        $response -> assertViewHas("mensaje", [
            "color" => "rgba(85, 38, 38, 0.959)",
            "texto" => "Esa sede ya no existe. La lista ha sido recargada."
        ]);
        $response->assertStatus(200);
    }

    public function test_listarSinAutenticarse()
    {
        $response = $this->post('/sedes');
        $response -> assertViewHas("mensaje", [
            "color" => "rgba(85, 38, 38, 0.959)",
            "texto" => "Esa sede ya no existe. La lista ha sido recargada."
        ]);
        $response->assertStatus(200);
    }

    public function test_listarSinSerAdministrador()
    {
        $response = $this->post('/sedes');
        $response -> assertViewHas("mensaje", [
            "color" => "rgba(85, 38, 38, 0.959)",
            "texto" => "Esa sede ya no existe. La lista ha sido recargada."
        ]);
        $response->assertStatus(200);
    }
}
