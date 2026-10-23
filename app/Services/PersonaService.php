<?php

namespace App\Services;

use App\Models\GrupoSanguineo;
use App\Models\ObraSocial;
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
    public function buscarPorQ(string $q = '', int $porPagina = 20, array $filtros = []): LengthAwarePaginator
    {
        $query = Persona::query()
            ->select(['id', 'documento', 'apellidos', 'nombres', 'apellido_materno', 'nro_hc', 'nombre_alias', 'usar_nombre_alias', 'sexo', 'fecha_nacimiento'])
            ->whereDoesntHave('personal');

        // ── Búsqueda por texto libre ─────────────────────────────────────
        if ($q !== '') {
            $like = "%{$q}%";

            $query->where(function ($sub) use ($like) {
                $sub->where('nombres',           'like', $like)
                    ->orWhere('apellidos',        'like', $like)
                    ->orWhere('apellido_materno', 'like', $like)
                    ->orWhere('nombre_alias',     'like', $like)
                    ->orWhere('documento',        'like', $like)
                    ->orWhere('nro_hc',           'like', $like);
            });
        }

        // ── Filtro por sexo (M / F) ──────────────────────────────────────
        if (!empty($filtros['sexo'])) {
            $query->where('sexo', strtoupper($filtros['sexo']));
        }

        // ── Filtro por rango de edad ─────────────────────────────────────
        if (!empty($filtros['edad_desde']) || !empty($filtros['edad_hasta'])) {
            $hoy = now()->toDateString();

            if (!empty($filtros['edad_hasta'])) {
                // fecha_nacimiento >= hoy - edad_hasta años (personas no "más viejas" que el límite)
                $fechaMin = now()->subYears((int)$filtros['edad_hasta'])->toDateString();
                $query->where('fecha_nacimiento', '>=', $fechaMin);
            }

            if (!empty($filtros['edad_desde'])) {
                // fecha_nacimiento <= hoy - edad_desde años (personas que ya cumplieron esa edad)
                $fechaMax = now()->subYears((int)$filtros['edad_desde'])->toDateString();
                $query->where('fecha_nacimiento', '<=', $fechaMax);
            }
        }

        // ── Filtro por obra social / financiador ─────────────────────────
        // Busca por nombre en la tabla obra_social a través de la relación
        // persona → persona_plan → plan → obra_social.
        if (!empty($filtros['obra_social'])) {
            try {
                $query->whereHas('plans.obra_social', function ($sub) use ($filtros) {
                    $sub->where('id', (int) $filtros['obra_social'])
                        ->where('borrado_logico', false);
                });
            } catch (\Throwable) {
                // La relación no existe en este entorno; ignoramos el filtro.
            }
        }

        // ── Filtro por grupo sanguíneo ───────────────────────────────────
        if (!empty($filtros['grupo_sanguineo'])) {
            $query->where('grupo_sanguineo_id', (int) $filtros['grupo_sanguineo']);
        }

        // ── Filtro por paciente crónico ──────────────────────────────────
        if (isset($filtros['es_cronico']) && $filtros['es_cronico'] !== '') {
            $query->where('es_cronico', (bool) $filtros['es_cronico']);
        }

        return $query->orderBy('apellidos')->paginate($porPagina)->withQueryString();
    }

    // ── Datos para los selects del panel de filtros ──────────────────────

    /**
     * Devuelve los grupos sanguíneos ordenados por código.
     * Retorna colección vacía si la tabla no existe en el entorno.
     */
    public function gruposSanguineos(): \Illuminate\Support\Collection
    {
        try {
            return GrupoSanguineo::query()
                ->where('borrado_logico', false)
                ->orderBy('codigo')
                ->get(['id', 'codigo']);
        } catch (\Throwable) {
            return collect();
        }
    }

    /**
     * Devuelve las obras sociales que tienen al menos un plan asignado a
     * algún paciente, ordenadas por nombre. Evita listados enormes con
     * financiadores que nunca se usaron.
     * Retorna colección vacía si la relación no existe en el entorno.
     */
    public function obrasSocialesConPacientes(): \Illuminate\Support\Collection
    {
        try {
            return ObraSocial::query()
                ->whereHas('plans.personas')
                ->where('borrado_logico', false)
                ->orderBy('nombre')
                ->get(['id', 'nombre']);
        } catch (\Throwable) {
            return collect();
        }
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
                'plans.obra_social',
                // Solo registros vigentes: activos y no dados de baja.
                'alergias' => fn($query) => $query->where('activa', true)->where('borrado_logico', false),
                'medicaciones' => fn($query) => $query->where('activa', true)->where('borrado_logico', false),
                // En Alephoo antecedentepatologico.borrado_en es NOT NULL (no sirve como
                // marca de baja); quién lo eliminó queda en eliminadopor_id (nullable).
                'antecedentepatologicos' => fn($query) => $query->whereNull('eliminadopor_id')->with('diagnostico'),
                // Cirugías vigentes con el nombre del catálogo de estudios (aunque el
                // estudio esté dado de baja en el catálogo, la cirugía ya ocurrió).
                'antecedentequirurgicos' => fn($query) => $query
                    ->whereNull('eliminadopor_id')
                    ->with(['estudio' => fn($q) => $q->withTrashed()]),
                'antecedenteperinatals' => fn($query) => $query
                    ->whereNull('borrado_en')
                    ->whereNull('eliminadopor_id')
                    ->with('antec_perinatal_diagnosticos.diagnostico'),
                // Se cargan UNA sola vez con todo lo que necesitan el header y
                // el Resumen (PatientSummaryService reutiliza esta relación).
                'eventohcs' => function ($query) {
                    $query->whereHas('consulta')
                        ->with([
                            'consulta.personal.persona',
                            'consulta.consultadetalles.diagnostico_detalles.diagnostico',
                        ])
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
    public function edadFormateada(?\Illuminate\Support\Carbon $fechaNacimiento): ?string
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

    // ── Métodos de carga focalizada para paneles lazy ─────────────────────

    /**
     * Carga mínima: solo datos de persona, sin relaciones.
     * Suficiente para VacunacionService (solo necesita fecha_nacimiento y sexo).
     */
    public function buscarBasico(int $id): Persona
    {
        return Persona::findOrFail($id);
    }

    /**
     * Carga persona con eventohcs y sus relaciones anidadas.
     * Usado por panelResumen → PatientSummaryService.
     */
    public function buscarConEventos(int $id): Persona
    {
        return Persona::query()
            ->with([
                'alergias' => fn($q) => $q->where('activa', true)->where('borrado_logico', false),
                'medicaciones' => fn($q) => $q->where('activa', true)->where('borrado_logico', false),
                'eventohcs' => function ($q) {
                    $q->whereHas('consulta')
                        ->with([
                            'consulta.personal.persona',
                            'consulta.consultadetalles.diagnostico_detalles.diagnostico',
                        ])
                        ->orderByDesc('fechahora');
                },
            ])
            ->findOrFail($id);
    }

    /**
     * Carga persona con antecedentes patológicos, quirúrgicos y perinatales.
     * Usado por panelAntecedentes → AntecedenteService.
     */
    public function buscarConAntecedentes(int $id): Persona
    {
        return Persona::query()
            ->with([
                'antecedentepatologicos' => fn($q) => $q->whereNull('eliminadopor_id')->with('diagnostico'),
                'antecedentequirurgicos' => fn($q) => $q
                    ->whereNull('eliminadopor_id')
                    ->with(['estudio' => fn($q) => $q->withTrashed()]),
                'antecedenteperinatals' => fn($q) => $q
                    ->whereNull('borrado_en')
                    ->whereNull('eliminadopor_id')
                    ->with('antec_perinatal_diagnosticos.diagnostico'),
            ])
            ->findOrFail($id);
    }

    /**
     * Carga persona con mediciones antropométricas y antecedente perinatal.
     * Usado por panelCrecimiento → CrecimientoService.
     */
    public function buscarConMediciones(int $id): Persona
    {
        return Persona::query()
            ->with([
                'antecedenteperinatals' => fn($q) => $q
                    ->whereNull('borrado_en')
                    ->whereNull('eliminadopor_id'),
            ])
            ->findOrFail($id);
    }
}
