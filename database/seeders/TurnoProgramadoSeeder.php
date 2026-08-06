<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\Personal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Siembra la cadena mínima de tablas que necesita el DashboardService
 * para mostrar "Pacientes del día":
 *
 *   estado_turno → agenda → turno_programado
 *
 * Genera turnos del 5 al 10 de agosto de 2026 (6 días).
 * Depende de que PersonaSeeder y PersonalSeeder ya hayan corrido.
 *
 * Uso:
 *   php artisan db:seed --class=TurnoProgramadoSeeder
 */
class TurnoProgramadoSeeder extends Seeder
{
    // ── Estados de turno ────────────────────────────────────────────────────
    private const ESTADOS = [
        ['id' => 1, 'nombre' => 'Pendiente',   'codigo' => 'PEN', 'alias' => 'Pendiente',   'orden' => 1, 'color' => '#FFC107'],
        ['id' => 2, 'nombre' => 'Atendido',    'codigo' => 'ATE', 'alias' => 'Atendido',    'orden' => 2, 'color' => '#28A745'],
        ['id' => 3, 'nombre' => 'Arribado',    'codigo' => 'ARR', 'alias' => 'Arribado',    'orden' => 3, 'color' => '#0D6EFD'],
        ['id' => 4, 'nombre' => 'No asistió',  'codigo' => 'NOA', 'alias' => 'No asistió',  'orden' => 4, 'color' => '#DC3545'],
        ['id' => 5, 'nombre' => 'Cancelado',   'codigo' => 'CAN', 'alias' => 'Cancelado',   'orden' => 5, 'color' => '#6C757D'],
    ];

    /**
     * Distribución de estados por día:
     *   - Días pasados (< hoy): mezcla de Atendido / Pendiente
     *   - Día de hoy:           mezcla de Atendido / Arribado / Pendiente
     *   - Días futuros (> hoy): todos Pendiente
     *
     * IDs: 1 = Pendiente, 2 = Atendido, 3 = Arribado
     */
    private function distribucionParaDia(Carbon $dia, int $totalPacientes): array
    {
        $hoy = Carbon::today();

        if ($dia->lt($hoy)) {
            // Pasado: todos atendidos, excepto el último que quedó pendiente
            return array_map(fn ($i) => ($i < $totalPacientes - 1) ? 2 : 1, range(0, $totalPacientes - 1));
        }

        if ($dia->isToday()) {
            // Hoy: cíclico 2, 2, 3, 1, 1  (Atendido, Atendido, Arribado, Pendiente, Pendiente)
            $patron = [2, 2, 3, 1, 1];
            return array_map(fn ($i) => $patron[$i % count($patron)], range(0, $totalPacientes - 1));
        }

        // Futuro: todos Pendiente
        return array_fill(0, $totalPacientes, 1);
    }

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // ── 0. Limpiar datos de seeders anteriores ──────────────────────────
        // Borramos solo las agendas marcadas como "demo" (comentario del seeder)
        // y sus turnos asociados, para que volver a correr el seeder no duplique.
        $agendaIdsDemo = DB::table('agenda')
            ->where('comentario', 'Agenda generada por seeder (demo)')
            ->pluck('id');

        if ($agendaIdsDemo->isNotEmpty()) {
            DB::table('turno_programado')->whereIn('agenda_id', $agendaIdsDemo)->delete();
            DB::table('agenda')->whereIn('id', $agendaIdsDemo)->delete();
        }

        // ── 1. Estados de turno ─────────────────────────────────────────────
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

        // ── 2. Agenda mínima ────────────────────────────────────────────────
        $agendaId = DB::table('agenda')->insertGetId([
            'dia'                 => 1,   // lunes (no importa, es demo)
            'hora_inicio'         => '08:00:00',
            'hora_fin'            => '13:00:00',
            'inicio_vigencia'     => '2026-08-05',
            'fin_vigencia'        => '2026-08-31',
            'duracion_turno'      => 20,
            'limite_pacientes'    => 20,
            'frecuencia'          => 1,
            'a_demanda'           => 0,
            'por_callcenter'      => 0,
            'cant_por_callcenter' => 0,
            'turnos_por_bloque'   => 1,
            'agenda_ad_hoc'       => 0,
            'comentario'          => 'Agenda generada por seeder (demo)',
            'created_at'          => now(),
            'updated_at'          => now(),
            'created_by'          => 1,
            'modified_by'         => 1,
        ]);

        // ── 3. Pacientes ────────────────────────────────────────────────────
        $pacientes = Persona::whereNotIn('documento', PersonalSeeder::DOCUMENTOS_PERSONAL_MEDICO)
            ->get();

        if ($pacientes->isEmpty()) {
            $this->command->warn('TurnoProgramadoSeeder: no hay pacientes en la BD. ¿Corriste PersonaSeeder?');
            Schema::enableForeignKeyConstraints();
            return;
        }

        // ── 4. Turnos del 5 al 10 de agosto de 2026 ─────────────────────────
        $fechas = [
            Carbon::parse('2026-08-05'),
            Carbon::parse('2026-08-06'),
            Carbon::parse('2026-08-07'),
            Carbon::parse('2026-08-08'),
            Carbon::parse('2026-08-09'),
            Carbon::parse('2026-08-10'),
        ];

        $totalTurnos = 0;

        foreach ($fechas as $fecha) {
            $distribucion = $this->distribucionParaDia($fecha, $pacientes->count());
            $inicio       = $fecha->copy()->setTime(8, 0, 0);

            foreach ($pacientes as $indice => $paciente) {
                $estadoId = $distribucion[$indice];
                $hora     = $inicio->copy()->addMinutes(20 * $indice);

                $arribo    = null;
                $noAsistio = null;

                if ($estadoId === 2) {
                    // Atendido → llegó 5 min antes
                    $arribo = $hora->copy()->subMinutes(5);
                } elseif ($estadoId === 3) {
                    // Arribado → llegó puntual pero todavía no fue atendido
                    $arribo = $hora->copy();
                } elseif ($estadoId === 4) {
                    // No asistió
                    $noAsistio = $hora->copy();
                }

                DB::table('turno_programado')->insert([
                    'agenda_id'                => $agendaId,
                    'persona_id'               => $paciente->id,
                    'estado_turno_id'          => $estadoId,
                    'orden'                    => $indice + 1,
                    'fecha'                    => $fecha->toDateString(),
                    'hora'                     => $hora->format('H:i:s'),
                    'sobreturno'               => 0,
                    'tipovezqueconsulta'        => 1,
                    'por_callcenter'           => 0,
                    'confirmado_por_paciente'  => 0,
                    'turno_portal_condicional' => 0,
                    'fechahora_arribo'         => $arribo,
                    'fechahora_noasistio'      => $noAsistio,
                    'created_at'               => now(),
                    'updated_at'               => now(),
                    'created_by'               => 1,
                    'modified_by'              => 1,
                ]);

                $totalTurnos++;
            }
        }

        Schema::enableForeignKeyConstraints();

        $this->command->info("TurnoProgramadoSeeder: {$totalTurnos} turnos creados en " . count($fechas) . " días (5 al 10 de agosto de 2026). Agenda ID: {$agendaId}.");
    }
}