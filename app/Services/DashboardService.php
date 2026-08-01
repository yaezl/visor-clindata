<?php

namespace App\Services;

use App\Models\TurnoProgramado;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class DashboardService
{
    /**
     * Devuelve los turnos programados para el día indicado (hoy por defecto),
     * con los datos de la persona ya resueltos.
     *
     * TODO(backend): Filtrar también por el profesional logueado.
     * Hoy `TurnoProgramado` no tiene una FK directa a `personal_id`; llega a
     * través de `agenda.asignacion`. Cuando el vínculo Auth::user() <-> Personal
     * de Alephoo esté definido, agregar acá:
     *   ->whereHas('agenda.asignacion', fn ($q) => $q->where('personal_id', $personalId))
     */
    public function turnosDelDia(?Carbon $fecha = null): Collection
    {
        $fecha ??= now();

        return TurnoProgramado::query()
            ->with(['persona', 'estado_turno'])
            ->whereDate('fecha', $fecha->toDateString())
            ->orderBy('hora')
            ->get();
    }

    /**
     * Arma los contadores del día (total / atendidos / pendientes) a partir
     * de los turnos reales, en base al estado_turno de cada uno.
     *
     * TODO(backend): Confirmar con el equipo qué IDs/nombres de EstadoTurno
     * corresponden a "atendido" en la base de Alephoo (acá se infiere por
     * nombre para no depender de un ID mágico).
     */
    public function estadisticasDelDia(Collection $turnos): array
    {
        $atendidos = $turnos->filter(function ($turno) {
            $estado = optional($turno->estado_turno)->nombre;

            return $estado && str_contains(mb_strtolower($estado), 'atend');
        })->count();

        $total = $turnos->count();

        return [
            'total' => $total,
            'atendidos' => $atendidos,
            'pendientes' => $total - $atendidos,
        ];
    }
}