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
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/calendar', [DashboardController::class, 'calendar'])
    ->middleware(['auth'])
    ->name('calendar');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Datos de pacientes / historia clínica: SIEMPRE protegidos por auth.
    Route::resource('patients', PersonaController::class)->only(['index', 'show']);

    // Detalle de paciente — header liviano
    Route::get('/patients/{id}/detail', [PersonaController::class, 'detail'])
        ->whereNumber('id')
        ->name('patients.detail');

    // Paneles lazy — cada acordeón fetchea su HTML por separado
    Route::get('/patients/{id}/panel/resumen', [PersonaController::class, 'panelResumen'])
        ->whereNumber('id')
        ->name('patients.panel.resumen');
    Route::get('/patients/{id}/panel/antecedentes', [PersonaController::class, 'panelAntecedentes'])
        ->whereNumber('id')
        ->name('patients.panel.antecedentes');
    Route::get('/patients/{id}/panel/vacunacion', [PersonaController::class, 'panelVacunacion'])
        ->whereNumber('id')
        ->name('patients.panel.vacunacion');
    Route::get('/patients/{id}/panel/crecimiento', [PersonaController::class, 'panelCrecimiento'])
        ->whereNumber('id')
        ->name('patients.panel.crecimiento');

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
    Route::get('/{id}/export-pdf', [PersonaController::class, 'exportHistorialPDF'])->name('patients.export-pdf');

});

require __DIR__ . '/auth.php';
