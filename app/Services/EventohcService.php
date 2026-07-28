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
}