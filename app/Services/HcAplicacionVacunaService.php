<?php

namespace App\Services;

use App\Models\HcAplicacionVacuna;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Solo lectura: reglas de aplicación de cada vacuna
 * (edad desde/hasta, si es obligatoria, tipo de aplicación).
 */
class HcAplicacionVacunaService
{
    public function listar(array $filtros = [], int $porPagina = 20): LengthAwarePaginator
    {
        $query = HcAplicacionVacuna::query()
            ->where('borrado_logico', false)
            ->with(['hc_vacuna', 'hc_tipo_aplicacion_vacuna']);

        if (!empty($filtros['vacuna_id'])) {
            $query->where('vacuna_id', $filtros['vacuna_id']);
        }

        return $query->orderBy('desde')->paginate($porPagina)->withQueryString();
    }

    public function buscar(int $id): HcAplicacionVacuna
    {
        return HcAplicacionVacuna::query()
            ->where('borrado_logico', false)
            ->with(['hc_vacuna', 'hc_tipo_aplicacion_vacuna', 'admin_configuracion_temporal'])
            ->findOrFail($id);
    }
}