<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;

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
                    'id' => optional($turno->persona)->id,
                    'name' => optional($turno->persona)->nombre_completo ?? '—',
                    'dni' => optional($turno->persona)->documento,
                    'control' => $turno->fecha?->toDateString(),
                    'hora' => Carbon::parse($turno->hora)->format('H:i'),
                    'estado_label' => $badge['label'],
                    'estado_css' => $badge['css'],
                ];
            })->values()->toArray();

        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Dashboard QueryException: ' . $e->getMessage());
            $turnosMapeados = [];
            $stats = [
                'total' => 0,
                'atendidos' => 0,
                'arribados' => 0,
                'pendientes' => 0,
            ];
        }

        return view('dashboard.index', [
            'turnos' => $turnosMapeados,
            'stats'  => $stats,
        ]);
    }

    /**
     * Vista de calendario mensual y turnos correspondientes al día seleccionado.
     */
    public function calendar(Request $request): View
    {
        $request->validate([
            'mes' => ['nullable', 'date_format:Y-m'],
            'fecha' => ['nullable', 'date_format:Y-m-d'],
        ]);

        $hoy = Carbon::today();
        $mesParam = $request->query('mes');

        $inicioMes = $mesParam
            ? Carbon::createFromFormat('!Y-m', $mesParam)->startOfMonth()
            : $hoy->copy()->startOfMonth();

        $finMes = $inicioMes->copy()->endOfMonth();

        $fechaSeleccionada = $request->query('fecha')
            ? Carbon::createFromFormat('!Y-m-d', $request->query('fecha'))
            : ($inicioMes->isSameMonth($hoy) ? $hoy->copy() : $inicioMes->copy());

        // La fecha seleccionada siempre debe pertenecer al mes que se está viendo.
        if (!$fechaSeleccionada->isSameMonth($inicioMes)) {
            $fechaSeleccionada = $inicioMes->isSameMonth($hoy)
                ? $hoy->copy()
                : $inicioMes->copy();
        }

        try {
            // Cantidad de turnos por día para los indicadores de la grilla
            // (solo los del médico autenticado).
            $turnosMes = $this->dashboardService->conteoPorDia($inicioMes, $finMes);

            // Detalle de los turnos del día seleccionado (mismo filtro).
            $turnosDelDia = $this->dashboardService->turnosDelDia($fechaSeleccionada);
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Calendario QueryException: ' . $e->getMessage());
            $turnosMes = [];
            $turnosDelDia = collect();
        }

        return view('dashboard.calendar', [
            'hoy' => $hoy,
            'inicioMes' => $inicioMes,
            'finMes' => $finMes,
            'turnosMes' => $turnosMes,
            'fechaSeleccionada' => $fechaSeleccionada,
            'turnosDelDia' => $turnosDelDia,
        ]);
    }
}
