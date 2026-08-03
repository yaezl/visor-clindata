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
 * Depende de que PersonaSeeder y PersonalSeeder ya hayan corrido
 * (crea los pacientes y el personal médico que usamos acá).
 *
 * Uso:
 *   php artisan db:seed --class=TurnoProgramadoSeeder
 *
 * O desde DatabaseSeeder (después de PersonaSeeder):
 *   $this->call(TurnoProgramadoSeeder::class);
 */
class TurnoProgramadoSeeder extends Seeder
{
    // ── Estados de turno ────────────────────────────────────────────────────
    // Reproducen los valores típicos de Alephoo.  El DashboardService detecta
    // "atendido" buscando la cadena 'atend' en el nombre (case-insensitive).
    private const ESTADOS = [
        ['id' => 1, 'nombre' => 'Pendiente',   'codigo' => 'PEN', 'alias' => 'Pendiente',   'orden' => 1, 'color' => '#FFC107'],
        ['id' => 2, 'nombre' => 'Atendido',    'codigo' => 'ATE', 'alias' => 'Atendido',    'orden' => 2, 'color' => '#28A745'],
        ['id' => 3, 'nombre' => 'No asistió',  'codigo' => 'NOA', 'alias' => 'No asistió',  'orden' => 3, 'color' => '#DC3545'],
        ['id' => 4, 'nombre' => 'Cancelado',   'codigo' => 'CAN', 'alias' => 'Cancelado',   'orden' => 4, 'color' => '#6C757D'],
    ];

    // Distribución de estados para los turnos de hoy (índice = id del estado).
    // Se aplica cíclicamente sobre la lista de pacientes.
    private const DISTRIBUCION_ESTADOS = [
        2, // Atendido
        2, // Atendido
        1, // Pendiente
        1, // Pendiente
        1, // Pendiente
    ];

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // ── 1. Estados de turno ─────────────────────────────────────────────
        foreach (self::ESTADOS as $estado) {
            DB::table('estado_turno')->updateOrInsert(
                ['id' => $estado['id']],
                array_merge($estado, [
                    'activo'        => 1,
                    'borrado_logico'=> 0,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                    'created_by'    => 1,
                    'modified_by'   => 1,
                ])
            );
        }

        // ── 2. Agenda mínima ────────────────────────────────────────────────
        // La FK de turno_programado.agenda_id es NOT NULL, así que necesitamos
        // al menos un registro en agenda.  Insertamos con FK checks desactivados
        // para no tener que crear toda la cadena asignacion → especialidad → etc.
        $agendaId = DB::table('agenda')->insertGetId([
            'dia'              => now()->dayOfWeek,   // día de la semana (0 = domingo)
            'hora_inicio'      => '08:00:00',
            'hora_fin'         => '13:00:00',
            'inicio_vigencia'  => now()->toDateString(),
            'fin_vigencia'     => now()->addYear()->toDateString(),
            'duracion_turno'   => 20,
            'limite_pacientes' => 20,
            'frecuencia'       => 1,
            'a_demanda'        => 0,
            'por_callcenter'   => 0,
            'cant_por_callcenter' => 0,
            'turnos_por_bloque'=> 1,
            'agenda_ad_hoc'    => 0,
            'comentario'       => 'Agenda generada por seeder (demo)',
            'created_at'       => now(),
            'updated_at'       => now(),
            'created_by'       => 1,
            'modified_by'      => 1,
            // asignacion_id, lugar_id, piso_id, area_servicio_id  → NULL (opcionales)
        ]);

        // ── 3. Pacientes ────────────────────────────────────────────────────
        // Solo usamos personas que NO son personal médico, igual que el resto
        // de los seeders.
        $pacientes = Persona::whereNotIn('documento', PersonalSeeder::DOCUMENTOS_PERSONAL_MEDICO)
            ->get();

        if ($pacientes->isEmpty()) {
            $this->command->warn('TurnoProgramadoSeeder: no hay pacientes en la BD. ¿Corriste PersonaSeeder?');
            Schema::enableForeignKeyConstraints();
            return;
        }

        // ── 4. Turnos de HOY ────────────────────────────────────────────────
        // Creamos un turno por cada paciente con horario desde las 08:00,
        // cada 20 minutos, alternando estados según DISTRIBUCION_ESTADOS.
        $hoy   = Carbon::today();
        $inicio = Carbon::today()->setTime(8, 0, 0);

        foreach ($pacientes as $indice => $paciente) {
            $estadoId = self::DISTRIBUCION_ESTADOS[$indice % count(self::DISTRIBUCION_ESTADOS)];
            $hora     = $inicio->copy()->addMinutes(20 * $indice);

            // Campos para fechahora_arribo y fechahora_noasistio
            $arribo     = null;
            $noAsistio  = null;

            if ($estadoId === 2) {
                // Atendido → llegó 5 minutos antes de su turno
                $arribo = $hora->copy()->subMinutes(5);
            } elseif ($estadoId === 3) {
                // No asistió → se registra al momento del turno
                $noAsistio = $hora->copy();
            }

            DB::table('turno_programado')->insert([
                'agenda_id'               => $agendaId,
                'persona_id'              => $paciente->id,
                'estado_turno_id'         => $estadoId,
                'orden'                   => $indice + 1,
                'fecha'                   => $hoy->toDateString(),
                'hora'                    => $hora->format('H:i:s'),
                'sobreturno'              => 0,
                'tipovezqueconsulta'      => 1,
                'por_callcenter'          => 0,
                'confirmado_por_paciente' => 0,
                'turno_portal_condicional'=> 0,
                'fechahora_arribo'        => $arribo,
                'fechahora_noasistio'     => $noAsistio,
                'created_at'              => now(),
                'updated_at'              => now(),
                'created_by'              => 1,
                'modified_by'             => 1,
                // Columnas opcionales: plan_id, fk_encuentro, consulta_id,
                // institucion_id, observacion, motivo_turno_id, etc. → NULL
            ]);
        }

        // ── 5. Turno histórico de ayer (opcional, para probar filtros) ───────
        // Solo el primer paciente, para que el dashboard NO lo muestre
        // pero sí quede en la BD como dato histórico válido.
        if ($pacientes->isNotEmpty()) {
            DB::table('turno_programado')->insert([
                'agenda_id'               => $agendaId,
                'persona_id'              => $pacientes->first()->id,
                'estado_turno_id'         => 2, // Atendido
                'orden'                   => 1,
                'fecha'                   => Carbon::yesterday()->toDateString(),
                'hora'                    => '09:00:00',
                'sobreturno'              => 0,
                'tipovezqueconsulta'      => 1,
                'por_callcenter'          => 0,
                'confirmado_por_paciente' => 1,
                'turno_portal_condicional'=> 0,
                'created_at'              => now(),
                'updated_at'              => now(),
                'created_by'              => 1,
                'modified_by'             => 1,
            ]);
        }

        Schema::enableForeignKeyConstraints();

        $total     = $pacientes->count();
        $atendidos = collect(self::DISTRIBUCION_ESTADOS)
            ->take($total)
            ->countBy()
            ->get(2, 0);

        $this->command->info("TurnoProgramadoSeeder: {$total} turnos de hoy creados ({$atendidos} atendidos, " . ($total - $atendidos) . " pendientes). Agenda ID: {$agendaId}.");
    }
}