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
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AccionesController;
use App\Http\Controllers\ImpresoraController;
use App\Http\Controllers\SalidaEquipoController;
use App\Models\AsignacionEquipo;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Http\Controllers\TipoEquipoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MarcaAccesorioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\PagoLicenciaController;

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


Route::get('/', function () {
    return redirect('/login');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/perfil', [UserController::class, 'showProfile'])->name('perfil')->middleware('auth');
Route::put('/perfil', [UserController::class, 'updateProfile'])->name('perfil.update')->middleware('auth');



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

//Desasignacion de equipos ruta para desasignar equipos 
Route::delete('empleados/desasignar-equipo/{id}', [EmpleadoController::class, 'desasignarEquipo'])->name('empleados.desasignarEquipo');



//----------------------------------------------------------------------------------------------------------------------------//

// Ruta para listar todos los equipos
Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos.index');

Route::get('/equipos/baja', [EquipoController::class, 'baja'])->name('equipos.baja');

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

Route::get('/api/equipos/{id}/estado', function ($id) {
    $equipo = Equipo::findOrFail($id);
    return response()->json(['estado' => $equipo->estado]);
});


//Rutas para salidas de equipo
Route::resource('salidas', SalidaEquipoController::class);
Route::get('/salidas/{id}', [SalidaEquipoController::class, 'show'])->name('salidas.show');
Route::get('/salidas/{id}/generar-pdf', [SalidaEquipoController::class, 'generarPDF'])->name('ruta.generarPDF');


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

Route::resource('prestamos', PrestamoController::class);
Route::get('prestamos/{id}/pdf', [PrestamoController::class, 'generarPDF'])->name('prestamos.pdf');
Route::post('prestamos/pdf-multiple', [PrestamoController::class, 'generarPDFMultiple'])->name('prestamos.pdfMultiple');





Route::get('/acciones', [AccionesController::class, 'index'])->name('acciones.index');


Route::get('/asignacionesequipos/{id}/pdf', [AsignacionEquipoController::class, 'generatePdf'])->name('asignacionesequipos.pdf');


Auth::routes();



// Ruta para mostrar la lista de tipos de equipo
Route::get('tiposequipos', [TipoEquipoController::class, 'index'])->name('tiposequipos.index');

// Ruta para mostrar el formulario de creación de un nuevo tipo de equipo
Route::get('tiposequipos/create', [TipoEquipoController::class, 'create'])->name('tiposequipos.create');

// Ruta para almacenar un nuevo tipo de equipo
Route::post('tiposequipos', [TipoEquipoController::class, 'store'])->name('tiposequipos.store');

// Ruta para mostrar el formulario de edición de un tipo de equipo existente
Route::get('tiposequipos/{tipoEquipo}/edit', [TipoEquipoController::class, 'edit'])->name('tiposequipos.edit');

// Ruta para actualizar un tipo de equipo existente
Route::put('tiposequipos/{tipoEquipo}', [TipoEquipoController::class, 'update'])->name('tiposequipos.update');

// Ruta para eliminar un tipo de equipo existente
Route::delete('tiposequipos/{tipoEquipo}', [TipoEquipoController::class, 'destroy'])->name('tiposequipos.destroy');


// Ruta para mostrar la lista de marcas
Route::get('marcas', [MarcaController::class, 'index'])->name('marcas.index');

// Ruta para mostrar el formulario de creación de una nueva marca
Route::get('marcas/create', [MarcaController::class, 'create'])->name('marcas.create');

// Ruta para almacenar una nueva marca
Route::post('marcas', [MarcaController::class, 'store'])->name('marcas.store');

// Ruta para mostrar el formulario de edición de una marca existente
Route::get('marcas/{marca}/edit', [MarcaController::class, 'edit'])->name('marcas.edit');

// Ruta para actualizar una marca existente
Route::put('marcas/{marca}', [MarcaController::class, 'update'])->name('marcas.update');

// Ruta para eliminar una marca existente
Route::delete('marcas/{marca}', [MarcaController::class, 'destroy'])->name('marcas.destroy');


// Ruta para mostrar la lista de marcas de accesorios
Route::get('marcasaccesorios', [MarcaAccesorioController::class, 'index'])->name('marcasaccesorios.index');

// Ruta para mostrar el formulario de creación de una nueva marca de accesorio
Route::get('marcasaccesorios/create', [MarcaAccesorioController::class, 'create'])->name('marcasaccesorios.create');

// Ruta para almacenar una nueva marca de accesorio
Route::post('marcasaccesorios', [MarcaAccesorioController::class, 'store'])->name('marcasaccesorios.store');

// Ruta para mostrar el formulario de edición de una marca de accesorio existente
Route::get('marcasaccesorios/{marcaAccesorio}/edit', [MarcaAccesorioController::class, 'edit'])->name('marcasaccesorios.edit');

// Ruta para actualizar una marca de accesorio existente
Route::put('marcasaccesorios/{marcaAccesorio}', [MarcaAccesorioController::class, 'update'])->name('marcasaccesorios.update');

// Ruta para eliminar una marca de accesorio existente
Route::delete('marcasaccesorios/{marcaAccesorio}', [MarcaAccesorioController::class, 'destroy'])->name('marcasaccesorios.destroy');



// Rutas para las licencias

// Listar todas las licencias
Route::get('licencias', [LicenciaController::class, 'index'])->name('licencias.index');

// Mostrar el formulario para crear una nueva licencia
Route::get('licencias/create', [LicenciaController::class, 'create'])->name('licencias.create');

// Guardar la nueva licencia
Route::post('licencias', [LicenciaController::class, 'store'])->name('licencias.store');

// Mostrar una licencia en específico
Route::get('licencias/{licencia}', [LicenciaController::class, 'show'])->name('licencias.show');

// Mostrar el formulario para editar una licencia existente
Route::get('licencias/{licencia}/edit', [LicenciaController::class, 'edit'])->name('licencias.edit');

// Actualizar una licencia existente
Route::put('licencias/{licencia}', [LicenciaController::class, 'update'])->name('licencias.update');

// Eliminar una licencia
Route::delete('licencias/{licencia}', [LicenciaController::class, 'destroy'])->name('licencias.destroy');


// Rutas para los pagos asociados a las licencias
Route::get('licencias/{licencia}/pagos', [PagoLicenciaController::class, 'index'])->name('licencias.pagos.index');
Route::get('licencias/{licencia}/pagos/create', [PagoLicenciaController::class, 'create'])->name('licencias.pagos.create');
Route::post('licencias/{licencia}/pagos', [PagoLicenciaController::class, 'store'])->name('licencias.pagos.store');

Route::get('/licencias/{id}/enviar-notificacion', [LicenciaController::class, 'sendLicenciaNotification'])->name('licencias.sendNotification');

Route::resource('impresoras', ImpresoraController::class);
Route::get('/impresoras/estados', [ImpresoraController::class, 'getEstados'])->name('impresoras.estados');
Route::get('/impresoras/{id}/imprimir-prueba', [ImpresoraController::class, 'imprimirPrueba'])->name('impresoras.imprimirPrueba');
