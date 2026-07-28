<?php

namespace App\Services;

use App\Models\Informedeestudio;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InformedeestudioService
{

    protected array $relacionesBasicas = [
        'estudio',
        'ordendeestudio',
        'usuario',
        'diagnostico',
        'eventohc',
    ];

    public function listar(array $filtros = [], int $porPagina = 15): LengthAwarePaginator
    {
        $query = Informedeestudio::query()->with($this->relacionesBasicas);

        $this->aplicarFiltrosComunes($query, $filtros);

        return $query->orderByDesc('informe_fecha')->paginate($porPagina)->withQueryString();
    }

    public function buscar(int $id): Informedeestudio
    {
        return Informedeestudio::with(array_merge($this->relacionesBasicas, [
            'consultadetalle',
            'bonos',
            'archivos',
            'notabasicas',
            'informarestudio_archivos',
            'dermatologia_informedeestudios',
            'odontologia_informedeestudios',
            'oftalmologia_informedeestudios',
            'personainternacion_informedeestudios',
            'saludmentals',
        ]))->findOrFail($id);
    }

    /**
     * GET /informes-de-estudio/pendientes
     */
    public function pendientes(array $filtros = [], int $porPagina = 15): LengthAwarePaginator
    {
        $query = Informedeestudio::query()
            ->with($this->relacionesBasicas)
            ->where('informe_pendiente', true)
            ->where('activo', true);

        $this->aplicarFiltrosComunes($query, $filtros);

        return $query->orderByDesc('informe_fecha')->paginate($porPagina)->withQueryString();
    }

    /**
     * GET /informes-de-estudio/urgentes
     */
    public function urgentes(array $filtros = [], int $porPagina = 15): LengthAwarePaginator
    {
        $query = Informedeestudio::query()
            ->with($this->relacionesBasicas)
            ->where('es_urgente', true)
            ->where('activo', true);

        $this->aplicarFiltrosComunes($query, $filtros);

        return $query->orderByDesc('informe_fecha')->paginate($porPagina)->withQueryString();
    }

    protected function aplicarFiltrosComunes($query, array $filtros): void
    {
        if (!empty($filtros['estudio_id'])) {
            $query->where('estudio_id', $filtros['estudio_id']);
        }

        if (!empty($filtros['ordendeestudio_id'])) {
            $query->where('ordendeestudio_id', $filtros['ordendeestudio_id']);
        }

        if (!empty($filtros['informadopor_id'])) {
            $query->where('informadopor_id', $filtros['informadopor_id']);
        }

        if (!empty($filtros['evento_id'])) {
            $query->where('evento_id', $filtros['evento_id']);
        }

        if (!empty($filtros['desde'])) {
            $query->whereDate('informe_fecha', '>=', $filtros['desde']);
        }

        if (!empty($filtros['hasta'])) {
            $query->whereDate('informe_fecha', '<=', $filtros['hasta']);
        }
    }
}