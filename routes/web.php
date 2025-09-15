<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordatorioController;
use App\Http\Controllers\SaludController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DoctorController;
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

Route::middleware(['auth', 'doctor'])->prefix('home')->name('home.')->group(function () {
    // Ruta principal del doctor, cargando la vista doctor.blade.php
    Route::get('/', [DoctorController::class, 'index'])->name('doctor'); // Esta es la ruta 'home.doctor'

    // Asignar pacientes
    Route::get('asignar-paciente', [DoctorController::class, 'asignarPaciente'])->name('asignar-paciente');
    Route::post('asignar-paciente', [DoctorController::class, 'storePaciente'])->name('store-paciente');

    // Asignar medicamentos
    Route::get('asignar-medicamento', [DoctorController::class, 'asignarMedicamento'])->name('asignar-medicamento');
    Route::post('asignar-medicamento', [DoctorController::class, 'storeMedicamento'])->name('store-medicamento');

    // Ver pacientes asignados
    Route::get('pacientes', [DoctorController::class, 'verPacientes'])->name('pacientes');

    // Ver detalles de un paciente
    Route::get('pacientes/{id}', [DoctorController::class, 'showPaciente'])->name('paciente.show');

    Route::get('medicamentos', [DoctorController::class, 'gestionarMedicamentos'])->name('medicamentos');
    Route::get('medicamento/{id}/edit', [DoctorController::class, 'editarMedicamento'])->name('medicamento.edit');
    Route::put('medicamento/{id}', [DoctorController::class, 'actualizarMedicamento'])->name('medicamento.update');
    Route::delete('medicamento/{id}', [DoctorController::class, 'eliminarMedicamento'])->name('medicamento.destroy');

    Route::get('pacientes/{id}/asignar-salud', [DoctorController::class, 'asignarSalud'])->name('asignar-salud');
    Route::post('pacientes/{id}/asignar-salud', [DoctorController::class, 'storeSalud'])->name('store-salud');
});

// Home invocable (si llaman index por error, también está implementado)
Route::get('/home', HomeController::class)
    ->middleware('auth')
    ->name('home');

// Citas (doctor CRUD / paciente solo lectura de sus citas)
Route::middleware(['auth'])->group(function () {
    Route::resource('citas', CitaController::class);
});





Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : redirect()->route('login');
})->name('root');