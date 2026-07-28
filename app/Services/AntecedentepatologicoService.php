<?php

namespace App\Services;

use App\Models\Antecedentepatologico;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Solo lectura: antecedentes patológicos de una persona.
 * Siempre se consulta en el contexto de un paciente (persona_id).
 */
class AntecedentepatologicoService
{
    public function listar(array $filtros = [], int $porPagina = 20): LengthAwarePaginator
    {
        $query = Antecedentepatologico::query()
            ->with(['diagnostico', 'personal']);

        if (!empty($filtros['persona_id'])) {
            $query->where('persona_id', $filtros['persona_id']);
        }

        return $query->orderByDesc('creado_en')->paginate($porPagina)->withQueryString();
    }

    public function buscar(int $id): Antecedentepatologico
    {
        return Antecedentepatologico::query()
            ->with(['diagnostico', 'persona', 'personal'])
            ->findOrFail($id);
    }
}