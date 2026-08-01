<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\View\View;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function __construct(protected DashboardService $dashboardService)
    {
    }

    public function index(): View
    {
        try {
            $turnos = $this->dashboardService->turnosDelDia();
            $stats  = $this->dashboardService->estadisticasDelDia($turnos);

            $turnosMapeados = $turnos->map(fn ($turno) => [
                'id'      => optional($turno->persona)->id,
                'name'    => optional($turno->persona)->nombre_completo ?? '—',
                'dni'     => optional($turno->persona)->documento,
                'control' => $turno->fecha?->toDateString(),
            ])->values()->toArray();

        } catch (\Illuminate\Database\QueryException $e) {
            // La tabla turno_programado (u otra de Alephoo) todavía no existe.
            // Mostramos el dashboard vacío sin romper la aplicación.
            $turnosMapeados = [];
            $stats = ['total' => 0, 'atendidos' => 0, 'pendientes' => 0];
        }

        return view('dashboard.index', [
            'turnos' => $turnosMapeados,
            'stats'  => $stats,
        ]);
    }
}