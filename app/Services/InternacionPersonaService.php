<?php

namespace App\Services;

use App\Models\InternacionPersona;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InternacionPersonaService
{

    protected array $relacionesBasicas = [
        'persona',
        'plan',
        'eventohc',
    ];

    public function listar(array $filtros = [], int $porPagina = 15): LengthAwarePaginator
    {
        $query = InternacionPersona::query()->with($this->relacionesBasicas);

        // Por defecto no se muestran las borradas lógicamente, salvo que se pida explícito
        if (empty($filtros['incluir_borrados'])) {
            $query->whereNull('borrado_en')->where('borrado_logico', false);
        }

        if (!empty($filtros['persona_id'])) {
            $query->where('persona_id', $filtros['persona_id']);
        }

        if (!empty($filtros['evento_id'])) {
            $query->where('evento_id', $filtros['evento_id']);
        }

        if (!empty($filtros['plan_id'])) {
            $query->where('plan_id', $filtros['plan_id']);
        }

        if (!empty($filtros['desde'])) {
            $query->whereDate('creado_en', '>=', $filtros['desde']);
        }

        if (!empty($filtros['hasta'])) {
            $query->whereDate('creado_en', '<=', $filtros['hasta']);
        }

        return $query->orderByDesc('creado_en')->paginate($porPagina)->withQueryString();
    }

    public function buscar(int $id): InternacionPersona
    {
        return InternacionPersona::with(array_merge($this->relacionesBasicas, [
            // Cuelgan 1 a 1 (o pocos) de la internación, van dentro del show
            'internacion_epicrisis',
            'internacion_hoja_evolucion.evolucion_descripcions',

            // Otras relaciones útiles para el resumen de la internación
            'internacion_movimientos',
            'internacion_estudios_internacions',
            'personainternacion_informedeestudios',
        ]))->findOrFail($id);
    }
}