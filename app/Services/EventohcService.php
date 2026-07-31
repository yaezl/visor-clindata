<?php

namespace App\Services;

use App\Models\Eventohc;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class EventohcService
{
    public function listar(array $filtros = [], int $porPagina = 20): LengthAwarePaginator
    {
        $query = Eventohc::query()->with('tipocontenido');

        if (!empty($filtros['persona_id'])) {
            $query->where('persona_id', $filtros['persona_id']);
        }

        if (!empty($filtros['desde'])) {
            $query->whereDate('fechahora', '>=', $filtros['desde']);
        }

        if (!empty($filtros['hasta'])) {
            $query->whereDate('fechahora', '<=', $filtros['hasta']);
        }

        return $query->orderByDesc('fechahora')->paginate($porPagina)->withQueryString();
    }

    public function buscar(int $id): Eventohc
    {
        return Eventohc::query()
            ->with(['tipocontenido', 'persona'])
            ->findOrFail($id);
    }

    /**
     * Historial clínico completo de una persona para la línea de tiempo
     * del detalle de paciente (consultas, diagnósticos e informes de
     * estudio ya resueltos, ordenado del más reciente al más antiguo).
     */
    public function historial(int $personaId, int $porPagina = 15): LengthAwarePaginator
    {
        return Eventohc::query()
            ->where('persona_id', $personaId)
            ->with([
                'tipocontenido',
                'consulta.consulta_tipo_egreso',
                'consulta.personal.persona',
                'consulta.consultadetalles.diagnostico_detalles.diagnostico',
                'informedeestudios.estudio',
                'informedeestudios.diagnostico',
                'informedeestudios.usuario.personal.persona',
            ])
            ->orderByDesc('fechahora')
            ->paginate($porPagina)
            ->withQueryString();
    }
}