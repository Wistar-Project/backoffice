<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Alojamiento;
use App\Models\AlojamientoTipo;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class AlojamientoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_crearSede()
    {
        $response = $this->post('/crearAlojamiento', [
            "tipo" => "sede",
            "direccion" => "Avenida Italia 1258"
        ]);
        $this -> assertDatabaseHas("alojamientos", [
            "direccion" => "Avenida Italia 1258"
        ]);
        $response -> assertViewHas("mensaje", "Alojamiento creado satisfactoriamente");
        $response->assertStatus(200);
    }

    public function test_crearHogar()
    {
        $response = $this->post('/crearAlojamiento', [
            "tipo" => "hogar",
            "direccion" => "Avenida Italia 1259"
        ]);
        $this -> assertDatabaseHas("alojamientos", [
            "direccion" => "Avenida Italia 1259"
        ]);
        $response -> assertViewHas("mensaje", "Alojamiento creado satisfactoriamente");
        $response->assertStatus(200);
    }

    public function test_crearAlmacenCuandoYaHayUno()
    {
        $response = $this->post('/crearAlojamiento', [
            "tipo" => "almacen",
            "direccion" => "Avenida Italia 1251"
        ]);
        $response -> assertViewHas("mensaje", "No puedes crear mas de un almacén");
        $response->assertStatus(200);
    }

    public function test_crearAlojamientoConDireccionYaUsada()
    {
        $response = $this->post('/crearAlojamiento', [
            "tipo" => "hogar",
            "direccion" => "Dirección usada"
        ]);
        $this -> assertDatabaseHas("alojamientos", [
            "direccion" => "Dirección usada"
        ]);
        $response -> assertViewHas("mensaje", "Ya existe un alojamiento con esa dirección");
        $response->assertStatus(200);
    }

    public function test_crearAlojamientoConTipoInvalido()
    {
        $response = $this->post('/crearAlojamiento', [
            "tipo" => "ihueihnqueh",
            "direccion" => "Una dirección"
        ]);
        $response -> assertViewHas("mensaje", "Ese tipo no es válido");
        $response->assertStatus(200);
    }

    public function test_listarAlojamientos()
    {
        $response = $this->get('/listarAlojamientos');
        $alojamientos = Alojamiento::all();
        foreach($alojamientos as $alojamiento){
            $tipo = AlojamientoTipo::where("id", $alojamiento -> id) -> first() -> tipo;
            $alojamiento -> tipo = $tipo;
        }
        $response -> assertViewHas("alojamientos", $alojamientos);
        $response->assertStatus(200);
    }

    public function test_borrarAlojamiento()
    {
        $response = $this->post('/borrarAlojamiento', [
            "id" => 1
        ]);
        $response -> assertViewHas("mensaje", "Alojamiento borrado satisfactoriamente");
        $response->assertStatus(200);
    }
}
