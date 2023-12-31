<?php

use App\Http\Controllers\SedeController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\TransporteController;
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
Route::post('/sedes', [SedeController::class, "Crear"])->middleware('auth');
Route::get('/usuarios', [PersonaController::class,"ListarPersonas"])->middleware('auth');
Route::post('/usuarios',[PersonaController::class,"CrearPersona"])->middleware('auth');
Route::get('/usuarios/{id}',[PersonaController::class,"VerInformacionDePersona"])->middleware('auth');
Route::delete('/usuarios/{id}',[PersonaController::class,"BorrarUsuario"])->middleware('auth');
Route::put('/usuarios/{id}',[PersonaController::class,"editar"])->middleware('auth');
Route::get('/paqueteria',function(){
    return view("paqueteria");
})->middleware('auth');

Route::get('/paqueteria/lotes',[LoteController::class,"ListarLotes"])->middleware('auth');
Route::get('/paqueteria/lotes/{id}',[LoteController::class,"VerInformacionDeLote"])->middleware('auth');
Route::delete('/paqueteria/lotes/{id}',[LoteController::class,"EliminarLotes"])->middleware('auth');
Route::get('/paqueteria/lotes/{idLote}/asignar/{idCamion}',[LoteController::class,"Asignar"])->middleware('auth');
Route::get('/paqueteria/paquetes',[PaqueteController::class,"ListarPaquetes"])-> middleware('auth');
Route::get('/paqueteria/paquetes/{id}',[PaqueteController::class,"VerInformacionDelPaquete"])->middleware('auth');
Route::delete('/paqueteria/paquetes/{id}',[PaqueteController::class,"EliminarPaquete"])-> middleware('auth');

Route::get('/transporte', [ TransporteController::class, "Listar" ]) -> middleware('auth');
Route::get('/transporte/{d}', [ TransporteController::class, "VerUno" ]) -> middleware('auth');
Route::delete('/transporte/{d}', [ TransporteController::class, "Eliminar" ]) -> middleware('auth');
Route::post('/transporte', [ TransporteController::class, "Crear" ]) -> middleware('auth');
Route::get('/transporteCamiones', [ TransporteController::class, "ListarCamiones" ]) -> middleware('auth');
Route::get('/transportePickups', [ TransporteController::class, "ListarPickups" ]) -> middleware('auth');
Route::get('/transporte/desasignar/{d}', [ TransporteController::class, "Desasignar" ]) -> middleware('auth');

Route::get('/logout', [PersonaController::class, "CerrarSesion"])->middleware('auth');