<?php

namespace App\Services;

use App\Models\Consultum;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ConsultaService
{
    /**
     * Relaciones que normalmente se necesitan para listar/mostrar
     */
    protected array $relacionesBasicas = [
        'personal',
        'consulta_tipo_egreso',
        'eventohc',
        'direccion',
        'turno_programado',
    ];

    public function listar(array $filtros = [], int $porPagina = 15): LengthAwarePaginator
    {
        $query = Consultum::query()->with($this->relacionesBasicas);

        if (!empty($filtros['personal_id'])) {
            $query->where('personal_id', $filtros['personal_id']);
        }

        if (!empty($filtros['evento_id'])) {
            $query->where('evento_id', $filtros['evento_id']);
        }

        if (!empty($filtros['desde'])) {
            $query->whereDate('fechahorainicio', '>=', $filtros['desde']);
        }

        if (!empty($filtros['hasta'])) {
            $query->whereDate('fechahorainicio', '<=', $filtros['hasta']);
        }

        return $query->orderByDesc('fechahorainicio')->paginate($porPagina)->withQueryString();
    }

    public function buscar(int $id): Consultum
    {
        return Consultum::with(array_merge($this->relacionesBasicas, [
            'consultadetalles.finalidad_consulta_hc',
            'consultadetalles.causa_externa_hc',
            'consultadetalles.incapacidad_hc',
            'consultadetalles.diagnostico_detalles.diagnostico',
            'consultadetalles.diagnostico_detalles.tipo_diagnostico_principal_hc',
            'consultadetalles.personalintervinientes',

            'consultadetalles.informedeestudio.estudio',

            'estudiocomplementarios.estudio',
            'indicacions.consulta_receta_electronica',
            'indicacions.hcrecetum.articuloprescriptos',
            'indicacions.orden_ad_hoc',
            'indicacions.ordendeestudio',
            'indicacions.ordendeoftalmologium',

            /*  Relaciones de especialidad (dtype determina cuál viene poblada)
            'consultadetalles.dermatologium',
            'consultadetalles.enfermerium',
            'consultadetalles.informedeestudio',
            'consultadetalles.kinesiologium',
            'consultadetalles.notabasica',
            'consultadetalles.odontologium',
            'consultadetalles.oftalmologium',
            'consultadetalles.saludmental',

            'articuloprescriptos',*/
        ]))->findOrFail($id);
    }
}
 