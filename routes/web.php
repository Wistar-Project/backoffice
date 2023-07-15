<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
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
});

Route::post('/listar', [PersonaController::class, "ListarPersona"]);
Route::get('/listar', [PersonaController::class, "ListarPersonas"]);

Route::post('/crear', [PersonaController::class, "CrearPersona"]);
Route::get('/crear', function() {
    return view("crearUsuario");
});
