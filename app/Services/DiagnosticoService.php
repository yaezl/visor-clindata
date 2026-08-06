<?php

namespace App\Services;

use App\Models\Diagnostico;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DiagnosticoService
{
    public function listar(array $filtros = [], int $porPagina = 20): LengthAwarePaginator
    {
        $query = Diagnostico::query()
            ->where('borrado_logico', false)
            ->with(['tipodiagnostico', 'subtipodiagnostico']);

        if (!empty($filtros['nombre'])) {
            $query->where('nombre', 'like', "%{$filtros['nombre']}%");
        }

        if (!empty($filtros['codigocie10'])) {
            $query->where('codigocie10', 'like', "%{$filtros['codigocie10']}%");
        }

        return $query->orderBy('nombre')->paginate($porPagina)->withQueryString();
    }

    public function buscar(int $id): Diagnostico
    {
        return Diagnostico::query()
            ->where('borrado_logico', false)
            ->with(['tipodiagnostico', 'subtipodiagnostico', 'clasediagnostico'])
            ->findOrFail($id);
    }
}