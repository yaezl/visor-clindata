<?php

namespace App\Services;

use App\Models\Persona;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PersonaService
{
    protected array $relacionesBasicas = [
        'direccion',
        'pai',
        'estado_civil',
        'tipo_documento',
        'genero',
    ];

    public function listar(array $filtros = [], int $porPagina = 20): LengthAwarePaginator
    {
        $query = Persona::query()
            ->select(['id', 'documento', 'apellidos', 'nombres', 'apellido_materno']);

        if (!empty($filtros['documento'])) {
            $query->where('documento', 'like', "%{$filtros['documento']}%");
        }

        if (!empty($filtros['apellidos'])) {
            $query->where('apellidos', 'like', "%{$filtros['apellidos']}%");
        }

        return $query->orderBy('apellidos')->paginate($porPagina)->withQueryString();
    }

    public function buscar(int $id): Persona
    {
        return Persona::query()
            ->with($this->relacionesBasicas)
            ->findOrFail($id);
    }
}