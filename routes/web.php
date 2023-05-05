<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    return view('welcome');
});

//Rutas para buscar usuarios
Route::get('usuarios/busqueda', [UsuarioController::class, "busqueda"]);
Route::post('usuarios/buscar', [UsuarioController::class, "buscar"]);

//Rutas para el manejo de los usuarios
Route::resource('/usuarios', UsuarioController::class);
