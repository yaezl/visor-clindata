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
            ->select(['id', 'documento', 'apellidos', 'nombres', 'apellido_materno', 'nro_hc', 'nombre_alias', 'usar_nombre_alias'])
            ->whereDoesntHave('personal');

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
            ->select(['id', 'documento', 'apellidos', 'nombres', 'apellido_materno', 'nro_hc', 'nombre_alias', 'usar_nombre_alias'])
            ->whereDoesntHave('personal');

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

    /**
     * Arma todos los datos que necesita el header de detalle de paciente:
     * datos básicos, patologías, última consulta con el médico real,
     * cantidad de consultas, alergias y medicación activa.
     */
    public function buscarParaDetalle(int $id): array
    {
        $persona = Persona::query()
            ->with(array_merge($this->relacionesBasicas, [
                'grupo_sanguineo',
                'plans',
                'alergias' => fn ($query) => $query->where('activa', true),
                'medicaciones' => fn ($query) => $query->where('activa', true),
                'antecedentepatologicos.diagnostico',
                'antecedenteperinatals.antec_perinatal_diagnosticos.diagnostico',
                'eventohcs' => function ($query) {
                    $query->whereHas('consulta')
                        ->with(['consulta.personal.persona'])
                        ->orderByDesc('fechahora');
                },
            ]))
            ->findOrFail($id);

        $ultimoEvento = $persona->eventohcs->first();
        $ultimaConsulta = $ultimoEvento?->consulta instanceof \Illuminate\Support\Collection
            ? $ultimoEvento->consulta->first()
            : $ultimoEvento?->consulta;
        $medicoUltimaConsulta = $ultimaConsulta?->personal?->persona;

        return [
            'persona' => $persona,

            'iniciales' => $this->iniciales($persona),

            'edad' => $this->edadFormateada($persona->fecha_nacimiento),

            'grupo_sanguineo' => $persona->grupo_sanguineo?->codigo,

            'patologias' => $persona->antecedentepatologicos
                ->pluck('diagnostico.nombre')
                ->filter()
                ->values(),

            'ultima_consulta_fecha' => $ultimoEvento?->fechahora,
            'ultima_consulta_medico' => $medicoUltimaConsulta?->nombre_completo,

            'cantidad_consultas' => $persona->eventohcs->count(),

            'alergias' => $persona->alergias,
            'alergias_count' => $persona->alergias->count(),

            'medicaciones_activas' => $persona->medicaciones,
            'tiene_medicacion_activa' => $persona->medicaciones->isNotEmpty(),
        ];
    }

   /**
     * Para bebés (menores de 1 año) mostrar la edad en años redondea
     * a "0 años", que no dice nada útil al médico. Mostramos en meses
     * hasta que cumplan el año, y en años a partir de ahí.
     */
    protected function edadFormateada(?\Illuminate\Support\Carbon $fechaNacimiento): ?string
    {
        if (!$fechaNacimiento) {
            return null;
        }

        $anios = (int) floor($fechaNacimiento->age);

        if ($anios >= 1) {
            return "{$anios} " . ($anios === 1 ? 'año' : 'años');
        }

        $meses = (int) floor($fechaNacimiento->diffInMonths(now()));

        if ($meses < 1) {
            $dias = (int) floor($fechaNacimiento->diffInDays(now()));

            return "{$dias} " . ($dias === 1 ? 'día' : 'días');
        }

        return "{$meses} " . ($meses === 1 ? 'mes' : 'meses');
    }

    protected function iniciales(Persona $persona): string
    {
        $inicialNombre = mb_substr($persona->nombres ?? '', 0, 1);
        $inicialApellido = mb_substr($persona->apellidos ?? '', 0, 1);

        return mb_strtoupper($inicialNombre . $inicialApellido);
    }
}