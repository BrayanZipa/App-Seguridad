<?php

use App\Http\Controllers\HomeController;
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
// Route::get('/visitantes/ver/{id}', [VisitanteController::class, 'show'])->name('mostrarVisitante');
Route::get('/visitantes/editar/{id}', [VisitanteController::class, 'edit'])->name('formEditarVisitante');
Route::put('/visitantes/editar/{id}', [VisitanteController::class, 'update'])->name('editarVisitante');



Route::get('/visitante', [VisitanteController::class, 'visitantes'])->name('mostrar');



