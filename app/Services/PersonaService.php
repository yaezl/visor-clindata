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

    /**
     * Búsqueda unificada por nombre, apellido, DNI o nro de historia clínica.
     * Devuelve paginado para que la vista pueda navegar páginas.
     */
    public function buscarPorQ(string $q = '', int $porPagina = 20): LengthAwarePaginator
    {
        $query = Persona::query()
            ->select(['id', 'documento', 'apellidos', 'nombres', 'apellido_materno', 'nro_hc', 'nombre_alias', 'usar_nombre_alias']);

        if ($q !== '') {
            $like = "%{$q}%";

            $query->where(function ($sub) use ($like, $q) {
                $sub->where('nombres',          'like', $like)
                    ->orWhere('apellidos',       'like', $like)
                    ->orWhere('apellido_materno','like', $like)
                    ->orWhere('nombre_alias',    'like', $like)
                    ->orWhere('documento',       'like', $like)
                    ->orWhere('nro_hc',          'like', $like);
            });
        }

        return $query->orderBy('apellidos')->paginate($porPagina)->withQueryString();
    }

    /**
     * Listado simple con filtros separados (conservado por si otras partes lo usan).
     */
    public function listar(array $filtros = [], int $porPagina = 20): LengthAwarePaginator
    {
        $query = Persona::query()
            ->select(['id', 'documento', 'apellidos', 'nombres', 'apellido_materno', 'nro_hc', 'nombre_alias', 'usar_nombre_alias']);

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