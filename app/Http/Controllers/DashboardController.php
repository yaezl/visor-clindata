<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

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

            $turnosMapeados = $turnos->map(function ($turno) {
                $badge = DashboardService::etiquetaEstado($turno);

                return [
                    'id'           => optional($turno->persona)->id,
                    'name'         => optional($turno->persona)->nombre_completo ?? '—',
                    'dni'          => optional($turno->persona)->documento,
                    'control'      => $turno->fecha?->toDateString(),
                    'hora'         => Carbon::parse($turno->hora)->format('H:i'),
                    'estado_label' => $badge['label'],
                    'estado_css'   => $badge['css'],
                ];
            })->values()->toArray();

        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Dashboard QueryException: ' . $e->getMessage());
            $turnosMapeados = [];
            $stats = [
                'total'      => 0,
                'atendidos'  => 0,
                'arribados'  => 0,
                'pendientes' => 0,
            ];
        }

        return view('dashboard.index', [
            'turnos' => $turnosMapeados,
            'stats'  => $stats,
        ]);
    }

    /**
     * Vista de calendario mensual.
     * Por ahora muestra el mes actual con los turnos del día marcados.
     * Se puede expandir para traer todos los días del mes con contadores.
     */
    public function calendar(): View
    {
        $hoy        = Carbon::today();
        $inicioMes  = $hoy->copy()->startOfMonth();
        $finMes     = $hoy->copy()->endOfMonth();

        try {
            // Traemos los turnos del mes completo para marcar los días con actividad
            $turnosMes = \App\Models\TurnoProgramado::query()
                ->whereBetween('fecha', [$inicioMes->toDateString(), $finMes->toDateString()])
                ->selectRaw('fecha, COUNT(*) as total')
                ->groupBy('fecha')
                ->pluck('total', 'fecha')
                ->toArray();
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Calendario QueryException: ' . $e->getMessage());
            $turnosMes = [];
        }

        return view('dashboard.calendar', [
            'hoy'       => $hoy,
            'inicioMes' => $inicioMes,
            'finMes'    => $finMes,
            'turnosMes' => $turnosMes,
        ]);
    }
}