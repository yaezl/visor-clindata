<?php

namespace App\Services;

use App\Models\TurnoProgramado;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class DashboardService
{
    /**
     * Devuelve los turnos programados para el día indicado (hoy por defecto),
     * con los datos de la persona y el estado_turno ya resueltos.
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
     * Arma los contadores del día a partir de los turnos reales.
     *
     * Lógica de clasificación (en orden de prioridad):
     *   - "atendido"   → nombre del estado contiene 'atend'
     *   - "en_consulta"→ nombre del estado contiene 'consul' o 'curso'
     *   - "arribado"   → fechahora_arribo está presente y no es nulo
     *   - "pendiente"  → todo lo demás
     *
     * TODO(backend): Confirmar con el equipo qué IDs/nombres de EstadoTurno
     * corresponden a cada categoría en la BD de Alephoo.
     */
    public function estadisticasDelDia(Collection $turnos): array
    {
        $atendidos   = 0;
        $en_consulta = 0;
        $arribados   = 0;
        $pendientes  = 0;

        foreach ($turnos as $turno) {
            $estado = mb_strtolower(optional($turno->estado_turno)->nombre ?? '');

            if (str_contains($estado, 'atend')) {
                $atendidos++;
            } elseif (str_contains($estado, 'consul') || str_contains($estado, 'curso')) {
                $en_consulta++;
            } elseif (!is_null($turno->fechahora_arribo) || str_contains($estado, 'arrib')) {
                $arribados++;
            } else {
                $pendientes++;
            }
        }

        return [
            'total'       => $turnos->count(),
            'atendidos'   => $atendidos,
            'en_consulta' => $en_consulta,
            'arribados'   => $arribados,
            'pendientes'  => $pendientes,
        ];
    }

    /**
     * Devuelve la "etiqueta de estado" que se muestra en la tabla del dashboard.
     * Centralizado acá para que la misma lógica sirva también en futuros endpoints API.
     */
    public static function etiquetaEstado(TurnoProgramado $turno): array
    {
        $estado = mb_strtolower(optional($turno->estado_turno)->nombre ?? '');

        if (str_contains($estado, 'atend')) {
            return ['label' => 'Atendido',    'css' => 'badge-atendido'];
        }

        if (str_contains($estado, 'consul') || str_contains($estado, 'curso')) {
            return ['label' => 'En consulta', 'css' => 'badge-en-consulta'];
        }

        if (!is_null($turno->fechahora_arribo) || str_contains($estado, 'arrib')) {
            return ['label' => 'Arribado',    'css' => 'badge-arribado'];
        }

        return ['label' => 'Pendiente', 'css' => 'badge-pendiente'];
    }
}