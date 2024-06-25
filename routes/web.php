<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\AccesorioController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\AsignacionEquipoController;
use App\Http\Controllers\AsignacionAccesoriosController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

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



Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Ruta para listar empleados
Route::get('empleados', [EmpleadoController::class, 'index'])->name('empleados.index');

// Ruta para mostrar el formulario de creación de un empleado
Route::get('empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');

// Ruta para almacenar un nuevo empleado
Route::post('empleados', [EmpleadoController::class, 'store'])->name('empleados.store');

// Ruta para mostrar un empleado específico
Route::get('empleados/{id}', [EmpleadoController::class, 'show'])->name('empleados.show');

// Ruta para mostrar el formulario de edición de un empleado
Route::get('empleados/{id}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');

// Ruta para actualizar un empleado específico
Route::put('empleados/{id}', [EmpleadoController::class, 'update'])->name('empleados.update');

// Ruta para eliminar un empleado específico
Route::delete('empleados/{id}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');


//----------------------------------------------------------------------------------------------------------------------------//

// Ruta para listar todos los equipos
Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos.index');

// Ruta para mostrar el formulario de creación de un nuevo equipo
Route::get('/equipos/create', [EquipoController::class, 'create'])->name('equipos.create');

// Ruta para almacenar un nuevo equipo
Route::post('/equipos', [EquipoController::class, 'store'])->name('equipos.store');

// Ruta para mostrar un equipo específico
Route::get('/equipos/{equipo}', [EquipoController::class, 'show'])->name('equipos.show');

// Ruta para mostrar el formulario de edición de un equipo específico
Route::get('/equipos/{equipo}/edit', [EquipoController::class, 'edit'])->name('equipos.edit');

// Ruta para actualizar un equipo específico
Route::put('/equipos/{equipo}', [EquipoController::class, 'update'])->name('equipos.update');

// Ruta para eliminar un equipo específico
Route::delete('/equipos/{equipo}', [EquipoController::class, 'destroy'])->name('equipos.destroy');

//-------------------------------------------------------------------------------------------------------------------------------------//

// Ruta para listar todos los accesorios
Route::get('/accesorios', [AccesorioController::class, 'index'])->name('accesorios.index');

// Ruta para mostrar el formulario de creación de un nuevo accesorio
Route::get('/accesorios/create', [AccesorioController::class, 'create'])->name('accesorios.create');

// Ruta para almacenar un nuevo accesorio
Route::post('/accesorios', [AccesorioController::class, 'store'])->name('accesorios.store');

// Ruta para mostrar un accesorio específico
Route::get('/accesorios/{accesorio}', [AccesorioController::class, 'show'])->name('accesorios.show');

// Ruta para mostrar el formulario de edición de un accesorio específico
Route::get('/accesorios/{accesorio}/edit', [AccesorioController::class, 'edit'])->name('accesorios.edit');

// Ruta para actualizar un accesorio específico
Route::put('/accesorios/{accesorio}', [AccesorioController::class, 'update'])->name('accesorios.update');

// Ruta para eliminar un accesorio específico
Route::delete('/accesorios/{accesorio}', [AccesorioController::class, 'destroy'])->name('accesorios.destroy');

//--------------------------------------------------------------------------------------------------------------------------------------------//

// Ruta para listar todas las empresas
Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas.index');

// Ruta para mostrar el formulario de creación de una nueva empresa
Route::get('/empresas/create', [EmpresaController::class, 'create'])->name('empresas.create');

// Ruta para almacenar una nueva empresa
Route::post('/empresas', [EmpresaController::class, 'store'])->name('empresas.store');

// Ruta para mostrar una empresa específica
Route::get('/empresas/{empresa}', [EmpresaController::class, 'show'])->name('empresas.show');

// Ruta para mostrar el formulario de edición de una empresa específica
Route::get('/empresas/{empresa}/edit', [EmpresaController::class, 'edit'])->name('empresas.edit');

// Ruta para actualizar una empresa específica
Route::put('/empresas/{empresa}', [EmpresaController::class, 'update'])->name('empresas.update');

// Ruta para eliminar una empresa específica
Route::delete('/empresas/{empresa}', [EmpresaController::class, 'destroy'])->name('empresas.destroy');

//----------------------------------------------------------------------------------------------------------------------------------------//

//Ruta para listar todas las asignaciones de equipos
Route::get('asignacionesequipos', [AsignacionEquipoController::class, 'index'])->name('asignacionesequipos.index');

//Ruta para mostrar el formulario de creacion de una nueva asignacionde equipo
Route::get('asignacionesequipos/create', [AsignacionEquipoController::class, 'create'])->name('asignacionesequipos.create');

// Ruta para almacenar una nueva asignación de equipo
Route::post('asignacionesequipos', [AsignacionEquipoController::class, 'store'])->name('asignacionesequipos.store');

// Ruta para mostrar una asignación de equipo específica
Route::get('asignacionesequipos/{asignacion}', [AsignacionEquipoController::class, 'show'])->name('asignacionesequipos.show');

// Ruta para mostrar el formulario de edición de una asignación de equipo específica
Route::get('asignacionesequipos/{asignacion}/edit', [AsignacionEquipoController::class, 'edit'])->name('asignacionesequipos.edit');

// Ruta para actualizar una asignación de equipo específica
Route::put('asignacionesequipos/{asignacion}', [AsignacionEquipoController::class, 'update'])->name('asignacionesequipos.update');

// Ruta para eliminar una asignación de equipo específica
Route::delete('asignacionesequipos/{asignacion}', [AsignacionEquipoController::class, 'destroy'])->name('asignacionesequipos.destroy');


//-----------------------------------------------------------------------------------------------------------------------------------//

// Ruta para listar todas las asignaciones de accesorios
Route::get('/asignacionaccesorios', [AsignacionAccesoriosController::class, 'index'])->name('asignacionaccesorios.index');

// Ruta para mostrar el formulario de creación de una nueva asignación de accesorio
Route::get('/asignacionaccesorios/create', [AsignacionAccesoriosController::class, 'create'])->name('asignacionaccesorios.create');

// Ruta para almacenar una nueva asignación de accesorio
Route::post('/asignacionaccesorios', [AsignacionAccesoriosController::class, 'store'])->name('asignacionaccesorios.store');

// Ruta para mostrar una asignación de accesorio específica
Route::get('/asignacionaccesorios/{asignacion}', [AsignacionAccesoriosController::class, 'show'])->name('asignacionaccesorios.show');

// Ruta para mostrar el formulario de edición de una asignación de accesorio específica
Route::get('/asignacionaccesorios/{asignacion}/edit', [AsignacionAccesoriosController::class, 'edit'])->name('asignacionaccesorios.edit');

// Ruta para actualizar una asignación de accesorio específica
Route::put('/asignacionaccesorios/{asignacion}', [AsignacionAccesoriosController::class, 'update'])->name('asignacionaccesorios.update');

// Ruta para eliminar una asignación de accesorio específica
Route::delete('/asignacionaccesorios/{asignacion}', [AsignacionAccesoriosController::class, 'destroy'])->name('asignacionaccesorios.destroy');

Auth::routes();

