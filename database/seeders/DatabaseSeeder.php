<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alojamiento;
use App\Models\Almacen;
use App\Models\Sede;
use App\Models\Paquete;
use App\Models\Lote;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Alojamiento::create([
            "id" => 1,
            "direccion" => "Dirección del almacén"
        ]);
        Almacen::create([
            "id" => 1
        ]);

        Alojamiento::create([
            "id" => 2,
            "direccion" => "Dirección usada"
        ]);
        Sede::create([
            "id" => 2
        ]);
        Paquete::create([
            "id" => 1,
            "peso_en_kg" => 5,
            "destino" => 2,
            "email" => "abcd@gmail.com"
        ]);

        Lote::create([
            "id" => 2,
            "destino" => 2,
        ]);
        Lote::create([
            "id" => 1,
            "destino" => 2,
        ]);
    }
}
