<?php

use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\EstudianteController;
use App\Models\Asignatura;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::Group(['middleware' => 'auth'], function () {

    Route::get('/estudiantes/index', [EstudianteController::class, 'index'])->name('estudiantes.index');
    Route::get('/estudiantes', [EstudianteController::class, 'create'])->name('estudiantes.create');
    Route::post('/estudiantes-crear', [EstudianteController::class, 'store'])->name('estudiantes.stores');
    Route::get('/estudiantes/show/{id}', [EstudianteController::class, 'show'])->name('estudiantes.show');
    Route::get('/estudiantes/{id}', [EstudianteController::class, 'edit'])->name('estudiantes.edit');
    Route::put('/estudiantes', [EstudianteController::class, 'update'])->name('estudiantes.update');
    // Route::delete('/estudiantes/{id}', [EstudianteController::class, 'destroy']);
    Route::post('eliminarEstudiante/{id}', [EstudianteController::class, 'eliminarObjetivo']);

    Route::post('/estudiantes', [EstudianteController::class, 'AsignarMaterias'])->name('estudiantes.AsignarMaterias');
});

Route::Group(['middleware' => 'auth'], function () {

    Route::get('/materias/index', [AsignaturaController::class, 'index'])->name('materias.index');
    Route::get('/materias', [AsignaturaController::class, 'create'])->name('materias.create');
    Route::post('/materias', [AsignaturaController::class, 'store'])->name('materias.store');
    Route::get('/materias/show/{id}', [AsignaturaController::class, 'show'])->name('materias.show');
    Route::get('/materias/{id}', [AsignaturaController::class, 'edit'])->name('materias.edit');
    Route::put('/materias', [AsignaturaController::class, 'update'])->name('materias.update');
    // Route::delete('/materias/{id}', [AsignaturaController::class, 'destroy']);
    Route::post('eliminarMateria/{id}', [AsignaturaController::class, 'eliminarObjetivo']);
});