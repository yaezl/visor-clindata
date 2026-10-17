<?php

namespace App\Services;

use App\Models\TurnoProgramado;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    /**
     * Devuelve los turnos programados para el día indicado (hoy por defecto),
     * con los datos de la persona y el estado_turno ya resueltos.
     */
    public function turnosDelDia(?Carbon $fecha = null): Collection
    {
        $fecha ??= now();

        $query = TurnoProgramado::query()
            ->with(['persona', 'estado_turno'])
            ->whereDate('fecha', $fecha->toDateString())
            ->orderBy('hora');

        $personalId = Auth::user()?->personal_id;

        if ($personalId) {
            $query->whereHas('agenda.asignacion', function ($q) use ($personalId) {
                $q->where('personal_id', $personalId);
            });
        }

        return $query->get();
    }

    /**
     * Arma los contadores del día a partir de los turnos reales.
     *
     * Lógica de clasificación (en orden de prioridad):
     *   - "atendido"  → el nombre del estado contiene 'atend'
     *   - "arribado"  → fechahora_arribo presente O nombre contiene 'arrib'
     *   - "pendiente" → todo lo demás (no llegó, no fue atendido)
     */
    public function estadisticasDelDia(Collection $turnos): array
    {
        $atendidos  = 0;
        $arribados  = 0;
        $pendientes = 0;

        foreach ($turnos as $turno) {
            $estado = mb_strtolower(optional($turno->estado_turno)->nombre ?? '');

            if (str_contains($estado, 'atend')) {
                $atendidos++;
            } elseif (!is_null($turno->fechahora_arribo) || str_contains($estado, 'arrib')) {
                $arribados++;
            } else {
                $pendientes++;
            }
        }

        return [
            'total'      => $turnos->count(),
            'atendidos'  => $atendidos,
            'arribados'  => $arribados,
            'pendientes' => $pendientes,
        ];
    }

    /**
     * Devuelve la "etiqueta de estado" que se muestra en la tabla del dashboard.
     * Centralizado acá para que la misma lógica sirva también en futuros endpoints API.
     */
    public static function etiquetaEstado(TurnoProgramado $turno): array
    {
        $estado = mb_strtolower(optional($turno->estado_turno)->nombre ?? '');

        // Atendido → ya pasó la consulta
        if (str_contains($estado, 'atend')) {
            return ['label' => 'Atendido', 'css' => 'badge-atendido'];
        }

        // Arribado → llegó al consultorio, espera ser llamado
        if (!is_null($turno->fechahora_arribo) || str_contains($estado, 'arrib')) {
            return ['label' => 'Arribado', 'css' => 'badge-arribado'];
        }

        // Pendiente → todavía no llegó ni fue atendido
        return ['label' => 'Pendiente', 'css' => 'badge-pendiente'];
    }
}
