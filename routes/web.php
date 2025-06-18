<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AcudienteController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\TipoPlanController;
use App\Http\Controllers\TipoJornadaController;
use App\Http\Controllers\TipoDescuentoController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


Route::get('/probar-mail', function () {
    Mail::raw('Esto es una prueba de correo desde Laravel 🚀', function ($message) {
        $message->to('miiguelfabra0309@gmail.com')
                ->subject('Correo de prueba');
    });

    return 'Correo enviado. Revisa tu inbox o Mailtrap.';
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
Route::view('/acudientes', 'acudientes.index')->name('acudientes');
Route::view('/alumnos', 'alumnos.index')->name('alumnos');
Route::view('/matriculas', 'matriculas.index')->name('matriculas');
Route::view('/tipo-jornadas', 'tipo-jornadas.index')->name('tipo-jornadas');
Route::view('/tipo-descuentos', 'tipo-descuentos.index')->name('tipo-descuentos');


    

Route::resource('acudientes', AcudienteController::class);
Route::resource('alumnos', AlumnoController::class);
Route::resource('matriculas', MatriculaController::class);
Route::resource('pagos', PagoController::class)->only(['index', 'create', 'store']);Route::resource('facturas', FacturaController::class);
Route::resource('tipo-planes', TipoPlanController::class)->parameters([
    'tipo-planes' => 'tipoPlanes',
]);
Route::resource('tipo-jornadas', TipoJornadaController::class);
Route::resource('tipo-descuentos', TipoDescuentoController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


