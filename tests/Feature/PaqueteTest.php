<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Alojamiento;
use Tests\TestCase;
use App\Models\Paquete;

class PaqueteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_borrarPaquete()
    {
        $response = $this->post('/borrarPaquete', [
            "id" => 1
        ]);
        $response->assertStatus(200);
        $response -> assertViewHas("mensaje", "El paquete ha sido borrado satisfactoriamente");
    }

    public function test_borrarPaqueteQueNoExiste()
    {
        $response = $this->post('/borrarPaquete', [
            "id" => 521952185
        ]);
        $response->assertStatus(200);
        $response -> assertViewHas("mensaje", "El paquete ingresado no existe");
    }

    public function test_listarPaquetes()
    {
        $response = $this->get('/listarPaquetes');
        $response->assertStatus(200);
        $paquetes=Paquete::all();
        foreach($paquetes as $paquete){
            $idDestino=$paquete->destino;
            $destino=Alojamiento::find($idDestino)->direccion;
            $paquete->destino=$destino;
        }
        $response -> assertViewHas("paquetes", $paquetes);
    }
}
