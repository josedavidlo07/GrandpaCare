<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordatorioController;
use App\Http\Controllers\SaludController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;





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
    return Auth::check() ? redirect()->route('home') : redirect()->route('login');
})->name('root');

// Home invocable (si llaman index por error, también está implementado)
Route::get('/home', HomeController::class)
    ->middleware('auth')
    ->name('home');

// Citas (doctor CRUD / paciente solo lectura de sus citas)
Route::middleware(['auth'])->group(function () {
    Route::resource('citas', CitaController::class);
});

Route::middleware('auth')->group(function () {
    // Rutas para las vistas
    Route::get('/recordatorios', [RecordatorioController::class, 'indexView']);
    Route::get('/recordatorios/{id}', [RecordatorioController::class, 'showView']);
    Route::get('/salud', [SaludController::class, 'indexView']);
    Route::get('/salud/{id}', [SaludController::class, 'showView']);
});

Route::middleware('auth')->group(function () {
    // Mostrar todos los recordatorios
    Route::get('/recordatorios', [RecordatorioController::class, 'indexView'])->name('recordatorios.index');
    
    // Ver un recordatorio específico
    Route::get('/recordatorios/{id}', [RecordatorioController::class, 'showView'])->name('recordatorios.show');
    
    // Crear un nuevo recordatorio (muestra el formulario)
    Route::get('/recordatorios/create', [RecordatorioController::class, 'createView'])->name('recordatorios.create');
    
    // Guardar el nuevo recordatorio
    Route::post('/recordatorios', [RecordatorioController::class, 'store'])->name('recordatorios.store');
    
    // Eliminar un recordatorio
    Route::delete('/recordatorios/{id}', [RecordatorioController::class, 'destroy'])->name('recordatorios.destroy');
    
    // Actualizar un recordatorio (muestra el formulario de edición)
    Route::get('/recordatorios/{id}/edit', [RecordatorioController::class, 'editView'])->name('recordatorios.edit');
    
    // Actualizar el recordatorio
    Route::put('/recordatorios/{id}', [RecordatorioController::class, 'update'])->name('recordatorios.update');
});

Route::middleware('auth')->group(function () {
    // Mostrar todos los registros de salud
    Route::get('/salud', [SaludController::class, 'indexView'])->name('salud.index');
    
    // Ver un registro de salud específico
    Route::get('/salud/{id}', [SaludController::class, 'showView'])->name('salud.show');
    
    // Crear un nuevo registro de salud (muestra el formulario)
    Route::get('/salud/create', [SaludController::class, 'createView'])->name('salud.create');
    
    // Guardar el nuevo registro de salud
    Route::post('/salud', [SaludController::class, 'store'])->name('salud.store');
    
    // Eliminar un registro de salud
    Route::delete('/salud/{id}', [SaludController::class, 'destroy'])->name('salud.destroy');
    
    // Actualizar un registro de salud (muestra el formulario de edición)
    Route::get('/salud/{id}/edit', [SaludController::class, 'editView'])->name('salud.edit');
    
    // Actualizar el registro de salud
    Route::put('/salud/{id}', [SaludController::class, 'update'])->name('salud.update');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : redirect()->route('login');
})->name('root');