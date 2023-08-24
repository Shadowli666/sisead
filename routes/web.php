<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\ParamsController;
use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\ProcedenciaController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\NotaEstudiantesController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\InscripcionEstudiantesController;
use App\Http\Controllers\SeccionController;

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
//Auth::routes(['register'=>false, 'reset'=>false]);
Route::group(['middleware' => 'auth'], function(){
    Route::resource('params', ParamsController::class, ['except' => ['create', 'edit','store','update','show','destroy']]);
    Route::resource('carreras', CarrerasController::class);
    Route::resource('profesor', ProfesorController::class);
    Route::get('/profesor/edit/subject', [ProfesorController::class, 'editSubject'])->name('profesor.editSubject');
    Route::put('/profesor/store/subject/{id}', [ProfesorController::class, 'storeSubject'])->name('profesor.storeSubject');// Quizas esta bien?
    Route::resource('periodo', PeriodoController::class);
    Route::resource('seccion', SeccionController::class);
    Route::resource('procedencia', ProcedenciaController::class);
    Route::resource('materias', MateriasController::class);
    Route::resource('estudiante', EstudianteController::class);
    Route::post('/inscripcion/planilla','App\Http\Controllers\InscripcionEstudiantesController@planillaInscripcion');
    Route::resource('inscripcion', InscripcionEstudiantesController::class, ['except' => ['create']]);
    Route::post('notas/notas-aprobadas', 'App\Http\Controllers\NotaEstudiantesController@notasAprobadas');
    Route::resource('notas', NotaEstudiantesController::class);
    Route::get('/home', [ProfesorController::class, 'index'])->name('home');
    Route::get('/',[ProfesorController::class,'index'])->name('home');
    Route::get('/inscripcion/create/{cedula}','App\Http\Controllers\InscripcionEstudiantesController@create');
    Route::get('/inscripcion/{cedula}/{periodo_id}/edit','App\Http\Controllers\InscripcionEstudiantesController@edit');
    Route::get('/notas/create/{cedula}/{periodo_id}','App\Http\Controllers\NotaEstudiantesController@create');    
});
/*
    Route::get('/profesor', function () {
        return view('profesor.index');
    });
    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::get('profesor/create', [ProfesorController::class,'create']);
*/