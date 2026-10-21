<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\Personal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Siembra la cadena completa que necesita el DashboardService para mostrar
 * turnos filtrados por médico autenticado:
 *
 *   personal → asignacion → agenda (por día de semana) → turno_programado
 *
 * Además crea (si no existen) los catálogos mínimos que exige `asignacion`:
 *   comportamiento + departamento → especialidad
 *   nomenclable → categoria
 * (el dump de la BD es solo estructura, sin datos de catálogo).
 *
 * Cada médico tiene sus propias agendas según su horario semanal.
 * Los turnos cubren todo el año 2026 (enero–diciembre).
 *
 * Médicos y horarios:
 *   - Laura Fernández  → Lun, Mié, Vie  ·  mañana (08:00–12:00)
 *   - Martín Suárez    → Mar, Jue, Sáb  ·  mañana (08:00–12:00)
 *   - Valeria Torres   → Lun, Mié, Vie  ·  tarde  (14:00–18:00)
 *   - Diego Ramírez    → Mar, Jue, Sáb  ·  tarde  (14:00–18:00)
 *
 * Turnos de 20 minutos; 60–80 % del cupo diario ocupado (varía por día).
 *
 * Uso:
 *   php artisan db:seed --class=TurnoProgramadoSeeder
 */
class TurnoProgramadoSeeder extends Seeder
{
    private const COMENTARIO_DEMO = 'Agenda generada por seeder (demo)';

    // Cantidad de filas por INSERT masivo
    private const CHUNK = 500;

    // ── Estados de turno ─────────────────────────────────────────────────────
    private const ESTADOS = [
        ['id' => 1, 'nombre' => 'Pendiente',  'codigo' => 'PEN', 'alias' => 'Pendiente',  'orden' => 1, 'color' => '#FFC107'],
        ['id' => 2, 'nombre' => 'Atendido',   'codigo' => 'ATE', 'alias' => 'Atendido',   'orden' => 2, 'color' => '#28A745'],
        ['id' => 3, 'nombre' => 'Arribado',   'codigo' => 'ARR', 'alias' => 'Arribado',   'orden' => 3, 'color' => '#0D6EFD'],
        ['id' => 4, 'nombre' => 'No asistió', 'codigo' => 'NOA', 'alias' => 'No asistió', 'orden' => 4, 'color' => '#DC3545'],
        ['id' => 5, 'nombre' => 'Cancelado',  'codigo' => 'CAN', 'alias' => 'Cancelado',  'orden' => 5, 'color' => '#6C757D'],
    ];

    // ── Feriados nacionales 2026 ──────────────────────────────────────────────
    private const FERIADOS_2026 = [
        '2026-01-01',
        '2026-02-16',
        '2026-02-17',
        '2026-03-24',
        '2026-04-02',
        '2026-04-03',
        '2026-05-01',
        '2026-05-25',
        '2026-06-15',
        '2026-06-20',
        '2026-07-09',
        '2026-08-17',
        '2026-10-12',
        '2026-11-23',
        '2026-12-08',
        '2026-12-25',
    ];

    // ── Configuración por médico ──────────────────────────────────────────────
    // dias: día ISO de Carbon (1=Lun … 6=Sáb)
    private function configuracionMedicos(): array
    {
        return [
            [
                'documento'   => '11223344', // Laura Fernández
                'dias'        => [1, 3, 5],  // Lun, Mié, Vie
                'hora_inicio' => '08:00:00',
                'hora_fin'    => '12:00:00',
                'turno_min'   => 20,
            ],
            [
                'documento'   => '20111333', // Martín Suárez
                'dias'        => [2, 4, 6],  // Mar, Jue, Sáb
                'hora_inicio' => '08:00:00',
                'hora_fin'    => '12:00:00',
                'turno_min'   => 20,
            ],
            [
                'documento'   => '27222444', // Valeria Torres
                'dias'        => [1, 3, 5],  // Lun, Mié, Vie
                'hora_inicio' => '14:00:00',
                'hora_fin'    => '18:00:00',
                'turno_min'   => 20,
            ],
            [
                'documento'   => '20333555', // Diego Ramírez
                'dias'        => [2, 4, 6],  // Mar, Jue, Sáb
                'hora_inicio' => '14:00:00',
                'hora_fin'    => '18:00:00',
                'turno_min'   => 20,
            ],
        ];
    }

    // ── Estado del turno según si la fecha es pasada, hoy o futura ───────────
    private function estadoParaSlot(Carbon $fecha, int $slot): int
    {
        $hoy = Carbon::today();

        if ($fecha->lt($hoy)) {
            $mod = $slot % 20;
            if ($mod < 16) return 2; // Atendido (~80 %)
            if ($mod < 18) return 4; // No asistió (~10 %)
            return 5;                // Cancelado (~10 %)
        }

        if ($fecha->isToday()) {
            $patron = [2, 2, 3, 1, 1, 2, 3, 1, 1, 1, 2, 2];
            return $patron[$slot % count($patron)];
        }

        return 1; // Futuro: pendiente
    }

    // ── Tiempos de arribo/no-asistencia según estado ─────────────────────────
    private function tiemposArribo(int $estadoId, Carbon $horaFecha): array
    {
        return match ($estadoId) {
            2 => [$horaFecha->copy()->subMinutes(rand(3, 10)), null],
            3 => [$horaFecha->copy(), null],
            4 => [null, $horaFecha->copy()->addMinutes(5)],
            default => [null, null],
        };
    }

    // ── Precalcula fechas del año 2026 para cada día ISO (1–6) ───────────────
    private function precalcularFechas(): array
    {
        $feriados  = collect(self::FERIADOS_2026);
        $inicio    = Carbon::parse('2026-01-01');
        $fin       = Carbon::parse('2026-12-31');
        $resultado = [];

        for ($dia = 1; $dia <= 6; $dia++) {
            $resultado[$dia] = collect();
            $cursor = $inicio->copy();

            // Avanzar hasta el primer día del año que coincida con $dia
            while ($cursor->dayOfWeekIso !== $dia) {
                $cursor->addDay();
            }

            while ($cursor->lte($fin)) {
                if (! $feriados->contains($cursor->toDateString())) {
                    $resultado[$dia]->push($cursor->copy());
                }
                $cursor->addWeek();
            }
        }

        return $resultado;
    }

    // ── Campos de auditoría comunes a las tablas de catálogo ─────────────────
    private function auditoria(): array
    {
        return [
            'created_at'  => now(),
            'created_by'  => 1,
            'updated_at'  => now(),
            'modified_by' => 1,
        ];
    }

    // ── Devuelve el id de un registro de catálogo (lo crea si no existe) ─────
    private function idOCrear(string $tabla, array $buscar, array $crear): int
    {
        $id = DB::table($tabla)
            ->where($buscar)
            ->whereNull('deleted_at')
            ->value('id');

        return $id ? (int) $id : (int) DB::table($tabla)->insertGetId($crear);
    }

    /**
     * Garantiza que existan los catálogos que exige `asignacion`.
     * Devuelve [especialidad_id, categoria_id].
     *
     * Cadena de FKs:
     *   especialidad → departamento, comportamiento
     *   categoria    → nomenclable (misma PK, herencia por dtype)
     */
    private function asegurarCatalogos(): array
    {
        $comportamientoId = $this->idOCrear(
            'comportamiento',
            ['nombre' => 'Consultorio'],
            ['nombre' => 'Consultorio'] + $this->auditoria()
        );

        $departamentoId = $this->idOCrear(
            'departamento',
            ['nombre' => 'Pediatría'],
            ['nombre' => 'Pediatría', 'codigo' => 'PED'] + $this->auditoria()
        );

        $especialidadId = $this->idOCrear(
            'especialidad',
            ['nombre' => 'Pediatría'],
            [
                'departamento_id'   => $departamentoId,
                'comportamiento_id' => $comportamientoId,
                'nombre'            => 'Pediatría',
                'codigo'            => 'PED',
                'es_especial'       => 0,
            ] + $this->auditoria()
        );

        $categoriaId = DB::table('categoria')
            ->where('nombre', 'Médico')
            ->whereNull('deleted_at')
            ->value('id');

        if (! $categoriaId) {
            // categoria.id es FK a nomenclable.id: primero la fila padre.
            $categoriaId = DB::table('nomenclable')->insertGetId(['dtype' => 'categoria']);

            DB::table('categoria')->insert(
                ['id' => $categoriaId, 'nombre' => 'Médico', 'codigo' => 'MED'] + $this->auditoria()
            );
        }

        return [$especialidadId, (int) $categoriaId];
    }

    // ── Inserta en lotes para no hacer ~miles de INSERT individuales ─────────
    private function insertarEnLotes(string $tabla, array &$filas): void
    {
        foreach (array_chunk($filas, self::CHUNK) as $lote) {
            DB::table($tabla)->insert($lote);
        }
        $filas = [];
    }

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // ── 0. Limpiar datos de seeders anteriores ───────────────────────────
        $agendaIdsDemo = DB::table('agenda')
            ->where('comentario', self::COMENTARIO_DEMO)
            ->pluck('id');

        if ($agendaIdsDemo->isNotEmpty()) {
            foreach ($agendaIdsDemo->chunk(500) as $ids) {
                DB::table('turno_programado')->whereIn('agenda_id', $ids)->delete();
            }
            DB::table('agenda')->whereIn('id', $agendaIdsDemo)->delete();
        }

        DB::table('asignacion')
            ->where('comentario', self::COMENTARIO_DEMO)
            ->delete();

        // ── 1. Estados de turno ──────────────────────────────────────────────
        foreach (self::ESTADOS as $estado) {
            DB::table('estado_turno')->updateOrInsert(
                ['id' => $estado['id']],
                array_merge($estado, [
                    'activo'         => 1,
                    'borrado_logico' => 0,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                    'created_by'     => 1,
                    'modified_by'    => 1,
                ])
            );
        }

        // ── 2. Catálogos que necesita asignacion (se crean si faltan) ────────
        [$especialidadId, $categoriaId] = $this->asegurarCatalogos();

        $this->command->info("Usando especialidad_id={$especialidadId}, categoria_id={$categoriaId}");

        // ── 3. Pacientes ─────────────────────────────────────────────────────
        $pacientes = Persona::whereNotIn('documento', PersonalSeeder::DOCUMENTOS_PERSONAL_MEDICO)->get();

        if ($pacientes->isEmpty()) {
            $this->command->warn('TurnoProgramadoSeeder: no hay pacientes. ¿Corriste PersonaSeeder?');
            Schema::enableForeignKeyConstraints();
            return;
        }

        // ── 4. Fechas precalculadas ───────────────────────────────────────────
        $fechasPorDia = $this->precalcularFechas();

        // ── 5. Médico → asignacion → agendas → turnos ────────────────────────
        $totalTurnos  = 0;
        $totalAgendas = 0;

        foreach ($this->configuracionMedicos() as $config) {
            $persona = Persona::where('documento', $config['documento'])->first();
            if (! $persona) {
                $this->command->warn("Persona con documento {$config['documento']} no encontrada.");
                continue;
            }

            $personal = Personal::where('persona_id', $persona->id)->first();
            if (! $personal) {
                $this->command->warn("Personal no encontrado para {$persona->apellidos}.");
                continue;
            }

            // Una asignacion por médico
            $asignacionId = DB::table('asignacion')->insertGetId([
                'personal_id'           => $personal->id,
                'especialidad_id'       => $especialidadId,
                'categoria_id'          => $categoriaId,
                'activo'                => 1,
                'disponible_portal'     => 0,
                'acumulador'            => 0,
                'practicas_bloqueantes' => 0,
                'comentario'            => self::COMENTARIO_DEMO,
                'created_at'            => now(),
                'updated_at'            => now(),
                'created_by'            => 1,
                'modified_by'           => 1,
            ]);

            // Slots disponibles en el bloque horario (4hs / 20min = 12)
            $minutos     = Carbon::parse($config['hora_inicio'])
                ->diffInMinutes(Carbon::parse($config['hora_fin']), true);
            $slotsMaxDia = (int) ($minutos / $config['turno_min']);

            // Una agenda por cada día que trabaja el médico
            foreach ($config['dias'] as $dia) {
                $agendaId = DB::table('agenda')->insertGetId([
                    'asignacion_id'        => $asignacionId,
                    'dia'                  => $dia,
                    'hora_inicio'          => $config['hora_inicio'],
                    'hora_fin'             => $config['hora_fin'],
                    'inicio_vigencia'      => '2026-01-01',
                    'fin_vigencia'         => '2026-12-31',
                    'duracion_turno'       => $config['turno_min'],
                    'limite_pacientes'     => $slotsMaxDia,
                    'frecuencia'           => 1,
                    'a_demanda'            => 0,
                    'por_callcenter'       => 0,
                    'cant_por_callcenter'  => 0,
                    'turnos_por_bloque'    => 1,
                    'agenda_ad_hoc'        => 0,
                    'comentario'           => self::COMENTARIO_DEMO,
                    'created_at'           => now(),
                    'updated_at'           => now(),
                    'created_by'           => 1,
                    'modified_by'          => 1,
                ]);
                $totalAgendas++;

                // Turnos para cada fecha del año que cae en este día
                $filas = [];
                foreach ($fechasPorDia[$dia] as $fecha) {
                    // Ocupación variable: 60–80 % del cupo
                    $turnosPorDia = (int) ceil($slotsMaxDia * (rand(60, 80) / 100));

                    // Pacientes distintos y en orden aleatorio cada día
                    // (nunca se repite un paciente dentro del mismo día mientras
                    // haya pacientes suficientes).
                    $pacientesDelDia = $pacientes->shuffle()->values();

                    for ($slot = 0; $slot < $turnosPorDia; $slot++) {
                        $paciente  = $pacientesDelDia[$slot % $pacientesDelDia->count()];
                        $estadoId  = $this->estadoParaSlot($fecha, $slot);
                        $hora      = Carbon::parse($config['hora_inicio'])
                            ->addMinutes($config['turno_min'] * $slot);
                        $horaFecha = $fecha->copy()
                            ->setHour($hora->hour)
                            ->setMinute($hora->minute)
                            ->setSecond(0);

                        [$arribo, $noAsistio] = $this->tiemposArribo($estadoId, $horaFecha);

                        $filas[] = [
                            'agenda_id'                => $agendaId,
                            'persona_id'               => $paciente->id,
                            'estado_turno_id'          => $estadoId,
                            'orden'                    => $slot + 1,
                            'fecha'                    => $fecha->toDateString(),
                            'hora'                     => $hora->format('H:i:s'),
                            'sobreturno'               => 0,
                            'tipovezqueconsulta'       => 1,
                            'por_callcenter'           => 0,
                            'confirmado_por_paciente'  => 0,
                            'turno_portal_condicional' => 0,
                            'fechahora_arribo'         => $arribo,
                            'fechahora_noasistio'      => $noAsistio,
                            'created_at'               => now(),
                            'updated_at'               => now(),
                            'created_by'               => 1,
                            'modified_by'              => 1,
                        ];

                        $totalTurnos++;
                    }
                }
                $this->insertarEnLotes('turno_programado', $filas);
            }

            $this->command->info(
                "  ✓ {$persona->apellidos}, {$persona->nombres} "
                    . "— " . count($config['dias']) . " agendas — asignacion ID: {$asignacionId}"
            );
        }

        Schema::enableForeignKeyConstraints();

        $this->command->info(
            "TurnoProgramadoSeeder: {$totalTurnos} turnos creados en {$totalAgendas} agendas (2026 completo)."
        );
    }
}
