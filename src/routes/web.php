<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TallerMiddleware;
use App\Http\Middleware\ClienteMiddleware;

//login

Route::get('/', function () {
    return view('/auth/login');
});




Route::get('/index', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');



    
//profile

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/users', UserController::class)->middleware(TallerMiddleware::class);
});
   
   

//solo permisos de taller
Route::middleware(['auth', TallerMiddleware::class])->group(function () {

    //cuidado con repetir rutas tuveu n problema cuando filte use la misma ruta para obtener nas citas que para filtrar que fue /citas
   //filtrar
   Route::get('/citas/filtrar', [CitaController::class, 'filtrar'])->name('citas.filtrar');

    // ruta actualizar update
    Route::get('/citas/{id}', [CitaController::class, 'edit'])
        ->name('citas.modificar-cita');

      // Guardar los cambios (PUT)
      Route::put('/citas/{id}', [CitaController::class, 'update'])
      ->name('citas.update');

    // ruta eliminar destroy
    Route::delete('/citas/{id}', [CitaController::class, 'destroy'])
        ->name('citas.eliminar-cita');
});


//solo los clientes crear citas

Route::middleware(['auth',ClienteMiddleware::class])->group(function () {
    Route::get('/nueva-cita', [CitaController::class, 'create'])
    ->name('citas.create');
    
    Route::post('/citas', [CitaController::class, 'store'])
    ->name('citas.store');
});

//ver las citas 

Route::get('/citas', [CitaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('citas.index');

//asigno un nombre a la ruta para referenciarlo en las vitas

require __DIR__ . '/auth.php';
