<?php

use App\Http\Controllers\SedeController;
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
    return view('home');
})->middleware('auth');

Route::get('/sedes', [SedeController::class, "Listar"])->middleware('auth');
Route::delete('/sedes/{d}', [SedeController::class, "Borrar"])->middleware('auth');
/* viejas rutas
Route::post('/listar', [PersonaController::class, "ListarPersona"])->middleware('auth');
Route::get('/listar', [PersonaController::class, "ListarPersonas"])->middleware('auth');

Route::post('/crear', [PersonaController::class, "CrearPersona"])->middleware('auth');
Route::get('/crear', function () {
    return view("crearUsuario");

})->middleware('auth');
Route::post('/editar', [PersonaController::class, "EditarPersona"])->middleware('auth');
Route::get('/editar', function () {
    return view("editarUsuario");
})->middleware('auth');

Route::get('/verLote', [LoteController::class, "VerLote"])->middleware('auth');

Route::get('/editarLote', function () {
    return view("editarLote");
})->middleware('auth');

Route::post('/agregarPaqueteALote', [LoteController::class, "AgregarPaqueteALote"])->middleware('auth');
Route::post('/removerPaqueteALote', [LoteController::class, "RemoverPaqueteALote"])->middleware('auth');

Route::post('/borrarLote', [LoteController::class, "BorrarLote"])->middleware('auth');
Route::get('/borrarLote', function () {
    return view('borrarLote');
})->middleware('auth');

Route::get('/listarPaquetes', [PaqueteController::class, "ListarPaquetes"])->middleware('auth');

Route::post('/borrarPaquete', [PaqueteController::class, "BorrarPaquete"])->middleware('auth');
Route::get('/borrarPaquete', function () {
    return view('borrarPaquete');
})->middleware('auth');
Route::post('/crearAlojamiento', [AlojamientoController::class, "CrearAlojamiento"])->middleware('auth');
Route::get('/crearAlojamiento', function () {
    return view('crearAlojamiento');
})->middleware('auth');

Route::post('/borrarAlojamiento', [AlojamientoController::class, "BorrarAlojamiento"])->middleware('auth');
Route::get('/borrarAlojamiento', function () {
    return view('borrarAlojamiento');
})->middleware('auth');

Route::get('/listarAlojamientos', [AlojamientoController::class, "ListarSedes"])->middleware('auth');

Route::get('/asignarConductor', function () {
    return view("asignarConductor");
})->middleware('auth');
Route::post('/asignarConductor', [ConductorController::class, "AsignarVehiculo"])->middleware('auth');
*/
Route::get('/logout', [PersonaController::class, "CerrarSesion"])->middleware('auth');