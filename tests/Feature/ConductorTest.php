<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConductorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_asignarConductorQueNoExiste()
    {
        $response = $this->post('/asignarConductor', [
            "id_conductor" => 1512,
            "id_vehiculo" => 2525
        ]);
        $response->assertStatus(200);
        $response -> assertViewHas("mensaje", "Hay campos incorrectos. Por favor revisar.");
    }

    public function test_asignarConductor()
    {
        $response = $this->post('/asignarConductor', [
            "id_conductor" => 5,
            "id_vehiculo" => 3
        ]);
        $response->assertStatus(200);
        $response -> assertViewHas("mensaje", "Conductor asignado a vehículo satisfactoriamente.");
    }
}
