<?php

namespace App\Services;

use App\Models\HcVacuna;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Solo lectura: catálogo de vacunas.
 */
class HcVacunaService
{
    public function listar(array $filtros = [], int $porPagina = 20): LengthAwarePaginator
    {
        $query = HcVacuna::query()->where('borrado_logico', false);

        if (!empty($filtros['nombre'])) {
            $query->where('nombre', 'like', "%{$filtros['nombre']}%");
        }

        return $query->orderBy('orden')->orderBy('nombre')->paginate($porPagina)->withQueryString();
    }

    public function buscar(int $id): HcVacuna
    {
        return HcVacuna::query()
            ->where('borrado_logico', false)
            ->findOrFail($id);
    }
}