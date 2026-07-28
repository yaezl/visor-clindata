<?php

namespace App\Services;

use App\Models\Ordendeestudio;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrdendeestudioService
{
    /**
     * Relaciones que normalmente se necesitan para listar/mostrar
     */
    protected array $relacionesBasicas = [
        'estudios',
        'indicacion',
    ];

    public function listar(array $filtros = [], int $porPagina = 15): LengthAwarePaginator
    {
        $query = Ordendeestudio::query()->with($this->relacionesBasicas);

        if (!empty($filtros['diagnostico_id'])) {
            $query->where('diagnostico_id', $filtros['diagnostico_id']);
        }

        if (!empty($filtros['estudio_id'])) {
            $query->whereHas('estudios', function ($q) use ($filtros) {
                $q->where('estudio.id', $filtros['estudio_id']);
            });
        }

        return $query->orderByDesc('id')->paginate($porPagina)->withQueryString();
    }

    public function buscar(int $id): Ordendeestudio
    {
        return Ordendeestudio::with(array_merge($this->relacionesBasicas, [
            'informedeestudios',
        ]))->findOrFail($id);
    }
}