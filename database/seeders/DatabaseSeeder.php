<?php

namespace Database\Seeders;

use App\Models\Administrador;
use Illuminate\Database\Seeder;
use App\Models\Alojamiento;
use App\Models\Almacen;
use App\Models\Camion;
use App\Models\Conductor;
use App\Models\Sede;
use App\Models\Paquete;
use App\Models\Lote;
use App\Models\User;
use App\Models\Persona;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $idUsuario = User::create([
            "email" => "usuario@usuario",
            "password" => Hash::make("1234")
        ]) -> id;
        Persona::create([
            "id" => $idUsuario,
            "nombre" => "Rodrigo",
            "apellido" => "Dominguez"
        ]);
        Administrador::create([
            "id" => $idUsuario
        ]);
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

        User::create([
            "id" => 5,
            "email" => "conductor@usuario",
            "password" => Hash::make("1234")
        ]) -> id;
        Persona::create([
            "id" => 5,
            "nombre" => "Una",
            "apellido" => "Persona"
        ]);
        Conductor::create([
            "id" => 5
        ]);
        Vehiculo::create([
            "id" => 3,
            "capacidad_en_toneladas" => 5
        ]);
        Camion::create([
            "id_vehiculo" => 3
        ]);
    }
}
