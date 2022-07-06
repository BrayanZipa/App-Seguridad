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
 * Rutas del módulo de visitantes
 */
Route::get('/visitantes', [VisitanteController::class, 'index'])->name('mostrarVisitantes')->middleware('auth');
Route::get('/visitantes/crear', [VisitanteController::class, 'create'])->name('formCrearVisitante')->middleware('auth');
Route::post('/visitantes/crear', [VisitanteController::class, 'store'])->name('crearVisitante')->middleware('auth');
Route::get('/visitantes/informacion', [VisitanteController::class, 'informacionVisitantes'])->name('mostrarInformacion')->middleware('auth');
Route::put('/visitantes/editar/{id}', [VisitanteController::class, 'update'])->name('editarVisitante')->middleware('auth');

/**
 * Rutas del módulo de colaboradores
 */
Route::get('/colaboradores_con_activo', [ColaboradorController::class, 'index'])->name('mostrarColaboradores')->middleware('auth');
Route::get('/colaboradores_sin_activo', [ColaboradorController::class, 'index2'])->name('mostrarColaboradores2')->middleware('auth');
Route::get('/colaboradores/crear', [ColaboradorController::class, 'create'])->name('formCrearColaborador')->middleware('auth');
Route::post('/colaboradores/crear', [ColaboradorController::class, 'store'])->name('crearColaborador')->middleware('auth');
Route::get('/colaboradores/informacion', [ColaboradorController::class, 'informacionColaboradores'])->name('mostrarInfoColaboradores')->middleware('auth'); 
Route::put('/colaboradores/editar/{id}', [ColaboradorController::class, 'update'])->name('editarColaborador')->middleware('auth');
Route::delete('/colaboradores/cambiar_rol/{id}', [ColaboradorController::class, 'destroy'])->name('cambiarRol')->middleware('auth');

Route::get('/colaboradores/persona', [ColaboradorController::class, 'getColaborador'])->name('colaborador')->middleware('auth');
Route::get('/colaboradores/computadores', [ColaboradorController::class, 'getComputadores'])->name('computadores')->middleware('auth');
Route::get('/colaboradores/computador', [ColaboradorController::class, 'getComputador'])->name('computador')->middleware('auth');
Route::get('/colaboradores/personacreada', [ColaboradorController::class, 'getPersona'])->name('persona')->middleware('auth');
Route::get('/colaboradores/colaboradoridentificado', [ColaboradorController::class, 'getColaboradorIdentificacion'])->name('colaboradoridentificado')->middleware('auth');

/**
 * Rutas del módulo de conductores
 */
Route::get('/conductores', [ConductorController::class, 'index'])->name('mostrarConductores')->middleware('auth');
Route::get('/conductores/crear', [ConductorController::class, 'create'])->name('formCrearConductor')->middleware('auth');
Route::post('/conductores/crear', [ConductorController::class, 'store'])->name('crearConductor')->middleware('auth');
Route::get('/conductores/informacion', [ConductorController::class, 'informacionConductores'])->name('mostrarInfoConductores')->middleware('auth');
Route::put('/conductores/editar/{id}', [ConductorController::class, 'update'])->name('editarConductor')->middleware('auth');

/**
 * Rutas del módulo de vehículos
 */
Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('mostrarVehiculos')->middleware('auth');
Route::get('/vehiculos/crear', [VehiculoController::class, 'create'])->name('formCrearVehiculo')->middleware('auth');
Route::post('/vehiculos/crear', [VehiculoController::class, 'store'])->name('crearVehiculo')->middleware('auth');
Route::get('/vehiculos/informacion', [VehiculoController::class, 'informacionVehiculos'])->name('mostrarInfoVehiculos')->middleware('auth');
Route::put('/vehiculos/editar/{id}', [VehiculoController::class, 'update'])->name('editarVehiculo')->middleware('auth');
Route::get('/vehiculos/personas', [VehiculoController::class, 'getPersonas'])->name('personas')->middleware('auth');

/**
 * Rutas del módulo de registros
 */
Route::get('/registros', [RegistroController::class, 'index'])->name('mostrarRegistros')->middleware('auth');
Route::get('/registros/crear', [RegistroController::class, 'create'])->name('formCrearRegistro')->middleware('auth');
Route::post('/registros/crear', [RegistroController::class, 'store'])->name('crearRegistro')->middleware('auth');
Route::get('/registros/informacion', [RegistroController::class, 'informacionRegistros'])->name('mostrarInfoRegistros')->middleware('auth');
Route::get('/registros/personas', [RegistroController::class, 'getPersonas'])->name('getPersonas')->middleware('auth');
Route::get('/registros/persona', [RegistroController::class, 'getPersona'])->name('getPersona')->middleware('auth');
Route::get('/registros/vehiculos', [RegistroController::class, 'getVehiculos'])->name('vehiculos')->middleware('auth');
Route::put('/registros/editar_persona/{id}', [RegistroController::class, 'updatePersona'])->name('editarPersona')->middleware('auth');
Route::put('/registros/salida_persona/{id}', [RegistroController::class, 'registrarSalida'])->name('salidaPersona')->middleware('auth');


// Route::get('/prueba', [RegistroController::class, 'prueba'])->name('prueba');