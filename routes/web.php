<?php

use App\Http\Controllers\AlojamientoController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\LoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PaqueteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
}) -> middleware('auth');

Route::post('/listar', [PersonaController::class, "ListarPersona"]);
Route::get('/listar', [PersonaController::class, "ListarPersonas"]);

Route::post('/crear', [PersonaController::class, "CrearPersona"]);
Route::get('/crear', function() {
    return view("crearUsuario");
    
});
Route::post('/editar', [PersonaController::class, "EditarPersona"]);
Route::get('/editar', function() {
    return view("editarUsuario");
});

Route::get('/verLote', [LoteController::class, "VerLote"]); 

Route::get('/editarLote', function() {
        return view("editarLote");
});
    
Route::post('/agregarPaqueteALote', [LoteController::class, "AgregarPaqueteALote"]);
Route::post('/removerPaqueteALote', [LoteController::class, "RemoverPaqueteALote"]);

Route::post('/borrarLote',[LoteController::class, "BorrarLote"]);
Route::get('/borrarLote',function(){
    return view('borrarLote');
});

Route::get('/listarPaquetes', [PaqueteController::class,"ListarPaquetes"]);

Route::post('/borrarPaquete',[PaqueteController::class, "BorrarPaquete"]);
Route::get('/borrarPaquete',function(){
    return view('borrarPaquete');
});
Route::post('/crearAlojamiento',[AlojamientoController::class, "CrearAlojamiento"]);
Route::get('/crearAlojamiento',function(){
    return view('crearAlojamiento');
});

Route::post('/borrarAlojamiento',[AlojamientoController::class, "BorrarAlojamiento"]);
Route::get('/borrarAlojamiento',function(){
    return view('borrarAlojamiento');
});

Route::get('/listarAlojamientos',[AlojamientoController::class, "ListarAlojamientos"]);

Route::get('/asignarConductor', function(){
    return view("asignarConductor");
});
Route::post('/asignarConductor', [ ConductorController::class, "AsignarVehiculo" ]);

Route::get('/logout', [ PersonaController::class, "CerrarSesion" ]);