<?php

use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\VisitanteController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

/**
 * Ruta del home
 */
Route::get('/home', [HomeController::class, 'index'])->name('home');

/**
 * Rutas del modulo de visitantes
 */
Route::get('/visitantes', [VisitanteController::class, 'index'])->name('mostrarVisitantes');
Route::get('/visitantes/crear', [VisitanteController::class, 'create'])->name('formCrearVisitante');
Route::post('/visitantes/crear', [VisitanteController::class, 'store'])->name('crearVisitante');
Route::get('/visitantes/informacion', [VisitanteController::class, 'informacionVisitantes'])->name('mostrarInformacion');
Route::put('/visitantes/editar/{id}', [VisitanteController::class, 'update'])->name('editarVisitante');

/**
 * Rutas del modulo de colaboradores
 */
Route::get('/colaboradores', [ColaboradorController::class, 'index'])->name('mostrarColaboradores');
Route::get('/colaboradores/crear', [ColaboradorController::class, 'create'])->name('formCrearColaborador');
Route::post('/colaboradores/crear', [ColaboradorController::class, 'existeRegistro'])->name('crearColaborador');
Route::get('/colaboradores/informacion', [ColaboradorController::class, 'informacionColaboradores'])->name('mostrarInfoColaboradores');
Route::get('/colaboradores/persona', [ColaboradorController::class, 'getColaborador'])->name('colaborador');
Route::put('/colaboradores/editar/{id}', [ColaboradorController::class, 'update'])->name('editarColaborador');

/**
 * Rutas del modulo de conductores
 */
Route::get('/conductores', [ConductorController::class, 'index'])->name('mostrarConductores');
Route::get('/conductores/crear', [ConductorController::class, 'create'])->name('formCrearConductor');
Route::post('/conductores/crear', [ConductorController::class, 'store'])->name('crearConductor');
Route::get('/conductores/informacion', [ConductorController::class, 'informacionConductores'])->name('mostrarInfoConductores');
Route::put('/conductores/editar/{id}', [ConductorController::class, 'update'])->name('editarConductor');

/**
 * Rutas del modulo de vehículos
 */
Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('mostrarVehiculos');
Route::get('/vehiculos/crear', [VehiculoController::class, 'create'])->name('formCrearVehiculo');
Route::post('/vehiculos/crear', [VehiculoController::class, 'store'])->name('crearVehiculo');
Route::get('/vehiculos/informacion', [VehiculoController::class, 'informacionVehiculos'])->name('mostrarInfoVehiculos');
Route::put('/vehiculos/editar/{id}', [VehiculoController::class, 'update'])->name('editarVehiculo');
Route::get('/vehiculos/personas', [VehiculoController::class, 'getPersonas'])->name('personas');

/**
 * Rutas del modulo de registros
 */
Route::get('/registros', [RegistroController::class, 'index'])->name('mostrarRegistros');


