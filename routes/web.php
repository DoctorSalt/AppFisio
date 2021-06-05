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
Route::get('/Fisioterapeuta/MisCitas', [App\Http\Controllers\FisioController::class,'routeMisCitas'])->name('citaFisio');

Route::get('/PruebasCalendario',[App\Http\Controllers\HomeController::class,'paginaCalendario']);

Route::post('/ActualizacionDatosCliente',[App\Http\Controllers\ClienteController::class,'actualizarCliente']);

Route::get('/DiasDisponible',[App\Http\Controllers\ClienteController::class,'devolverFechasDisponibles']);

Route::get('/BuscarPorProvinciaFisioterapeutas',[App\Http\Controllers\ClienteController::class,'fisioterapeutasDeUnaProvincia']);

Route::get('/HorasEnDia',[App\Http\Controllers\ClienteController::class,'devolverCitasPosiblesFechaFisio']);
//Route::post('/InsertarCita',[App\Http\Controllers\ClienteController::class,'crearCita']);
Route::get('/Cliente/RealizarCitas',[App\Http\Controllers\ClienteController::class,'realizarCitas']);



Route::get('/BuscarDisponibilidadFisio',[App\Http\Controllers\ClienteController::class,'buscarDisponibles']);
Route::get('/BuscarDisposEnFecha',[App\Http\Controllers\ClienteController::class,'buscarDisponiblesPorFecha']);


Route::get('/VerCitasSinfirmadasCliente',[App\Http\Controllers\ClienteController::class,'busquedaSinCita']); //OK
Route::get('/VerCitasSinfirmadasFisio',[App\Http\Controllers\FisioController::class,'busquedaSinCita']); //OK
Route::get('/VerCitasConfirmadasCliente',[App\Http\Controllers\ClienteController::class,'busquedaConfirmadaCita']); //OK
Route::get('/VerCitasConfirmadasFisio',[App\Http\Controllers\FisioController::class,'busquedaConfirmadaCita']); //OK

Route::get('/InsertarCitaUsuario',[App\Http\Controllers\ClienteController::class,'aniadirCita']);
Route::get('/ConfirmarCita',[App\Http\Controllers\FisioController::class,'confirmarCita']);
Route::get('/RealizadaCita',[App\Http\Controllers\FisioController::class,'realizadoCita']);
