<?php

use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProfesorController;
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

    Route::get('/estudiantes-index', [EstudianteController::class, 'index'])->name('estudiantes.index');
    Route::get('/estudiantes', [EstudianteController::class, 'create'])->name('estudiantes.create');
    Route::post('/estudiantes-crear', [EstudianteController::class, 'store'])->name('estudiantes.stores');
    Route::get('/estudiantes/show/{id}', [EstudianteController::class, 'show'])->name('estudiantes.show');
    Route::get('/estudiantes/edit/{id}', [EstudianteController::class, 'edit'])->name('estudiantes.edit');
    Route::put('/estudiantes/{id}', [EstudianteController::class, 'update'])->name('estudiantes.update');
    Route::post('eliminarEstudiante/{id}', [EstudianteController::class, 'eliminarObjetivo']);

    Route::post('/estudiantes', [EstudianteController::class, 'AsignarMaterias'])->name('estudiantes.AsignarMaterias');
});

Route::Group(['middleware' => 'auth'], function () {

    Route::get('/materias-index', [AsignaturaController::class, 'index'])->name('materias.index');
    Route::get('/materias', [AsignaturaController::class, 'create'])->name('materias.create');
    Route::post('/materias-crear', [AsignaturaController::class, 'store'])->name('materias.stores');
    Route::get('/materias/show/{id}', [AsignaturaController::class, 'show'])->name('materias.show');
    Route::get('/materias/edit/{id}', [AsignaturaController::class, 'edit'])->name('materias.edit');
    Route::put('/materias/{id}', [AsignaturaController::class, 'update'])->name('materias.update');

    Route::post('eliminarMateria/{id}', [AsignaturaController::class, 'eliminarObjetivo']);
});

Route::Group(['middleware' => 'auth'], function () {

    Route::get('/profesores-index', [ProfesorController::class, 'index'])->name('profesores.index');
    Route::get('/profesores', [ProfesorController::class, 'create'])->name('profesores.create');
    Route::post('/profesores-crear', [ProfesorController::class, 'store'])->name('profesores.stores');
    Route::get('/profesores/show/{id}', [ProfesorController::class, 'show'])->name('profesores.show');
    Route::get('/profesores/edit/{id}', [ProfesorController::class, 'edit'])->name('profesores.edit');
    Route::put('/profesores/{id}', [ProfesorController::class, 'update'])->name('profesores.update');
    Route::post('eliminarProfesor/{id}', [ProfesorController::class, 'eliminarObjetivo']);

    Route::post('/profesores', [ProfesorController::class, 'AsignarMaterias'])->name('profesores.AsignarMaterias');
});