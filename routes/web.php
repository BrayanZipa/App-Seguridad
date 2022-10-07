<?php

use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\UserController;
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
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth'); 
Route::get('/home/total_registros', [HomeController::class, 'totalRegistrosDiarios'])->name('registrosDiarios')->middleware('auth');

/**
 * Rutas del sistema de roles
 */
Route::get('/users', [UserController::class, 'index'])->name('mostrarUsuarios')->middleware(['auth', 'can:mostrarUsuarios']);
Route::get('/users/informacion', [UserController::class, 'obtenerUsuarios'])->name('mostrarInfoUsuarios')->middleware(['auth', 'can:mostrarUsuarios']);
Route::put('/users/editar/{id}', [UserController::class, 'update'])->name('editarUsuario')->middleware(['auth', 'can:editarUsuario']);

/**
 * Rutas del módulo de visitantes
 */
Route::get('/visitantes', [VisitanteController::class, 'index'])->name('mostrarVisitantes')->middleware('auth');
Route::get('/visitantes/informacion', [VisitanteController::class, 'informacionVisitantes'])->name('mostrarInformacion')->middleware('auth');
Route::get('/visitantes/crear', [VisitanteController::class, 'create'])->name('formCrearVisitante')->middleware(['auth', 'can:formCrearVisitante']);
Route::post('/visitantes/crear', [VisitanteController::class, 'store'])->name('crearVisitante')->middleware(['auth', 'can:crearVisitante']);
Route::put('/visitantes/editar/{id}', [VisitanteController::class, 'update'])->name('editarVisitante')->middleware(['auth', 'can:editarVisitante']);

/**
 * Rutas del módulo de colaboradores
 */
Route::get('/colaboradores/con_activo', [ColaboradorController::class, 'index'])->name('mostrarColaboradores')->middleware('auth');
Route::get('/colaboradores/sin_activo', [ColaboradorController::class, 'index2'])->name('mostrarColaboradores2')->middleware('auth');
Route::get('/colaboradores/informacion', [ColaboradorController::class, 'informacionColaboradores'])->name('mostrarInfoColaboradores')->middleware('auth');
Route::get('/colaboradores/crear', [ColaboradorController::class, 'create'])->name('formCrearColaborador')->middleware(['auth', 'can:formCrearColaborador']);
Route::get('/colaboradores/persona', [ColaboradorController::class, 'getColaborador'])->name('colaborador')->middleware(['auth', 'can:crearColaborador']);
Route::get('/colaboradores/computador', [ColaboradorController::class, 'getComputador'])->name('computador')->middleware(['auth', 'can:crearColaborador']);
Route::get('/colaboradores/computer', [ColaboradorController::class, 'getComputer'])->name('computer')->middleware(['auth', 'can:crearColaborador']);
Route::get('/colaboradores/personacreada', [ColaboradorController::class, 'getPersona'])->name('persona')->middleware(['auth', 'can:crearColaborador']);
Route::get('/colaboradores/colaboradoridentificado', [ColaboradorController::class, 'getColaboradorIdentificacion'])->name('colaboradoridentificado')->middleware(['auth', 'can:crearColaborador']);
Route::post('/colaboradores/registro_salida', [ColaboradorController::class, 'registroSalidaPersona'])->name('registroSalida')->middleware(['auth', 'can:crearColaborador']);
Route::post('/colaboradores/crear', [ColaboradorController::class, 'store'])->name('crearColaborador')->middleware(['auth', 'can:crearColaborador']);
Route::put('/colaboradores/editar/{id}', [ColaboradorController::class, 'update'])->name('editarColaborador')->middleware(['auth', 'can:editarColaborador']);
Route::delete('/colaboradores/cambiar_rol/{id}', [ColaboradorController::class, 'destroy'])->name('cambiarRol')->middleware(['auth', 'can:editarColaborador']);

/**
 * Rutas del módulo de conductores
 */
Route::get('/conductores', [ConductorController::class, 'index'])->name('mostrarConductores')->middleware('auth');
Route::get('/conductores/informacion', [ConductorController::class, 'informacionConductores'])->name('mostrarInfoConductores')->middleware('auth');
Route::get('/conductores/crear', [ConductorController::class, 'create'])->name('formCrearConductor')->middleware(['auth', 'can:formCrearConductor']);
Route::post('/conductores/crear', [ConductorController::class, 'store'])->name('crearConductor')->middleware(['auth', 'can:crearConductor']);
Route::put('/conductores/editar/{id}', [ConductorController::class, 'update'])->name('editarConductor')->middleware(['auth', 'can:editarConductor']);

/**
 * Rutas del módulo de vehículos
 */
Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('mostrarVehiculos')->middleware('auth');
Route::get('/vehiculos/informacion', [VehiculoController::class, 'informacionVehiculos'])->name('mostrarInfoVehiculos')->middleware('auth');
Route::get('/vehiculos/crear', [VehiculoController::class, 'create'])->name('formCrearVehiculo')->middleware(['auth', 'can:formCrearVehiculo']);
Route::get('/vehiculos/personas', [VehiculoController::class, 'getPersonas'])->name('personas')->middleware(['auth', 'can:crearVehiculo']);
Route::post('/vehiculos/crear', [VehiculoController::class, 'store'])->name('crearVehiculo')->middleware(['auth', 'can:crearVehiculo']);
Route::post('/vehiculos/asignar', [VehiculoController::class, 'asignarVehiculo'])->name('asignarVehiculo')->middleware(['auth', 'can:editarVehiculo']);
Route::put('/vehiculos/editar/{id}', [VehiculoController::class, 'update'])->name('editarVehiculo')->middleware(['auth', 'can:editarVehiculo']);

/**
 * Rutas del módulo de registros
 */
Route::get('/registros/completados', [RegistroController::class, 'index'])->name('mostrarRegistros')->middleware('auth');
Route::get('/registros/informacion', [RegistroController::class, 'informacionRegistros'])->name('mostrarInfoRegistros')->middleware('auth');
Route::get('/registros/listado_por_persona', [RegistroController::class, 'registrosPorPersona'])->name('registrosPorPersona')->middleware('auth');
Route::get('/registros/sin_salida', [RegistroController::class, 'registrosSinSalida'])->name('mostrarRegistrosSinSalida')->middleware('auth');
Route::get('/registros/informacion_sin_salida', [RegistroController::class, 'informacionRegistrosSinSalida'])->name('registrosSalidas')->middleware('auth');
Route::get('/registros/informacion_vehiculos', [RegistroController::class, 'informacionRegistrosVehiculos'])->name('registrosVehiculos')->middleware('auth');
Route::get('/registros/informacion_activos', [RegistroController::class, 'informacionRegistrosActivos'])->name('registrosActivos')->middleware('auth');
Route::get('/registros/crear/{tipoPersona?}', [RegistroController::class, 'create'])->name('formCrearRegistro')->middleware(['auth', 'can:formCrearRegistro']);  
Route::get('/registros/personas', [RegistroController::class, 'getPersonas'])->name('getPersonas')->middleware(['auth', 'can:registrarIngreso']); 
Route::get('/registros/persona', [RegistroController::class, 'getPersona'])->name('getPersona')->middleware(['auth', 'can:registrarIngreso']); 
Route::get('/registros/vehiculos', [RegistroController::class, 'getVehiculos'])->name('vehiculos')->middleware(['auth', 'can:registrarIngreso']); 
Route::get('/registros/vehiculo_sin_salida', [RegistroController::class, 'utimoRegistroVehiculo'])->name('utimoRegistroVehiculo')->middleware(['auth', 'can:registrarIngreso']); 
Route::get('/registros/activo_sin_salida', [RegistroController::class, 'utimoRegistroActivo'])->name('utimoRegistroActivo')->middleware(['auth', 'can:registrarIngreso']); 
Route::put('/registros/editar_persona/{id}', [RegistroController::class, 'updatePersona'])->name('editarPersona')->middleware(['auth', 'can:registrarIngreso']); 
Route::put('/registros/salida_persona/{id}', [RegistroController::class, 'registrarSalida'])->name('salidaPersona')->middleware(['auth', 'can:registrarSalida']);   

// Route::get('/prueba', [RegistroController::class, 'prueba'])->name('prueba');