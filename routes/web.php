<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\EventohcController;
use App\Http\Controllers\AntecedentepatologicoController;
use App\Http\Controllers\HcVacunaController;
use App\Http\Controllers\HcAplicacionVacunaController;
use App\Http\Controllers\InformedeestudioController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/calendar', [DashboardController::class, 'calendar'])
    ->middleware(['auth', 'verified'])
    ->name('calendar');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Datos de pacientes / historia clínica: SIEMPRE protegidos por auth.
    Route::resource('patients', PersonaController::class)->only(['index', 'show']);
    // Detalle de paciente (header + tabs + accesos rápidos)
    Route::get('/patients/{id}/detail', [PersonaController::class, 'detail'])
        ->whereNumber('id')
        ->name('patients.detail');
    Route::resource('consultas', ConsultaController::class)->only(['index', 'show']);
    Route::resource('diagnosticos', DiagnosticoController::class)->only(['index', 'show']);
    Route::resource('eventos', EventohcController::class)->only(['index', 'show']);
    Route::resource('antecedentes-patologicos', AntecedentepatologicoController::class)->only(['index', 'show']);
    Route::resource('vacunas', HcVacunaController::class)->only(['index', 'show']);
    Route::resource('aplicaciones-vacuna', HcAplicacionVacunaController::class)->only(['index', 'show']);
    Route::prefix('informes-de-estudio')->name('informes-de-estudio.')->group(function () {
        Route::get('/pendientes', [InformedeestudioController::class, 'pendientes'])->name('pendientes');
        Route::get('/urgentes', [InformedeestudioController::class, 'urgentes'])->name('urgentes');
    });
    Route::resource('informes-de-estudio', InformedeestudioController::class)->only(['index', 'show']);
});

require __DIR__ . '/auth.php';
