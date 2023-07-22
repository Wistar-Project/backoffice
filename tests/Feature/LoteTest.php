<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paquete;
use App\Models\LoteFormadoPor;

class LoteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_borrarLote()
    {
        $response = $this->get('/borrarLote?id=1');
        $response->assertStatus(200);
    }

    public function test_borrarLoteQueNoExiste()
    {
        $response = $this->get('/borrarLote?id=5219518');
        $response->assertStatus(200);
    }

    public function test_verLote()
    {
        $response = $this->get('/verLote?id=2');
        $response->assertStatus(200);
        $idDePaquetes = LoteFormadoPor::where("id_lote", 2) -> pluck("id_paquete");
        $paquetes = [];
        foreach($idDePaquetes as $idPaquete){
            $paquete = Paquete::find($idPaquete);
            array_push($paquetes, $paquete);
        }
        $response -> assertViewHas("paquetes", $paquetes);
    }

    public function test_verLoteQueNoExiste()
    {
        $response = $this->get('/verLote?id=58215');
        $response -> assertViewHas("mensaje", "El lote ingresado no ha sido encontrado");
    }
}
