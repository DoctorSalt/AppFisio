<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', [App\Http\Controllers\HomeController::class,'paginaLogin'])->name('inicioLogin');
Route::get('/login', [App\Http\Controllers\HomeController::class,'verificacionLogin']);
Route::get('/registrarse/Cliente', [App\Http\Controllers\HomeController::class,'paginaRegistroCliente'])->name('registroCliente');
Route::get('/registrarse/Fisioterapeuta', [App\Http\Controllers\HomeController::class,'paginaRegistroFisio'])->name('registroFisio');
Route::get('/registrarseProceso', [App\Http\Controllers\HomeController::class,'registrarseInsert']);
Route::get('/Fisio/Horario', [App\Http\Controllers\HomeController::class,'horarioModificar']);
Route::get('/Fisio/InsertarHorario', [App\Http\Controllers\FisioController::class,'asignarHorario']);
Route::get('/Deslogarse', [App\Http\Controllers\HomeController::class,'deslogarse']);
Route::get('/Cliente/Inicio', [App\Http\Controllers\ClienteController::class,'rutaCliente'])->name('clienteInicio');
Route::get('/Cliente/Datos', [App\Http\Controllers\ClienteController::class,'misDatosCliente'])->name('clienteDatos');
Route::get('/Cliente/MisCitas', [App\Http\Controllers\ClienteController::class,'rutaCitasClientes'])->name('clienteCitas');

Route::get('/Fisioterapeuta/Inicio', [App\Http\Controllers\FisioController::class,'rutaFisioterapeuta'])->name('fisioInicio');
Route::get('/Fisioterapeuta/Datos', [App\Http\Controllers\FisioController::class,'misDatosFisioterapeuta'])->name('fisioDatos');
Route::get('/Fisioterapeuta/MisClientes', [App\Http\Controllers\FisioController::class,'routeMisClientes'])->name('fisioClientes');

Route::get('/PruebasCalendario',[App\Http\Controllers\HomeController::class,'paginaCalendario']);
