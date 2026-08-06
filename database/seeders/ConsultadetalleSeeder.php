<?php

namespace Database\Seeders;

use App\Models\Consultadetalle;
use App\Models\Consultum;
use App\Models\Diagnostico;
use App\Models\DiagnosticoDetalle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Genera Consultadetalle + su DiagnosticoDetalle correspondiente en el
 * mismo lugar, a partir de un unico "caso clinico" (ver
 * CasosClinicosPediatricos), para que el motivo de consulta, el examen
 * fisico y el diagnostico sean siempre coherentes entre si.
 *
 * Reemplaza la logica anterior, donde ConsultadetalleSeeder y
 * DiagnosticoDetalleSeeder eran independientes y podian generar
 * combinaciones sin sentido clinico (ej: motivo "tos" + diagnostico
 * "Diabetes mellitus").
 */
class ConsultadetalleSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $casos = CasosClinicosPediatricos::casos();

        // Mapa codigocie10 => Diagnostico, para no golpear la BD en cada
        // iteracion.
        $diagnosticosPorCodigo = Diagnostico::whereIn(
            'codigocie10',
            collect($casos)->pluck('codigocie10')->unique()
        )->get()->keyBy('codigocie10');

        // Se recorren las consultas ordenadas por fecha para que, dentro
        // de la historia de un mismo paciente, no se repita el mismo
        // caso clinico dos veces seguidas (mas realista).
        $consultasPorPaciente = Consultum::with('eventohc')
            ->get()
            ->filter(fn ($consulta) => $consulta->eventohc !== null)
            ->sortBy(fn ($consulta) => $consulta->eventohc->fechahora)
            ->groupBy(fn ($consulta) => $consulta->eventohc->persona_id);

        foreach ($consultasPorPaciente as $consultas) {

            $ultimoCodigoUsado = null;

            foreach ($consultas as $consulta) {

                $caso = $this->elegirCasoDistintoAlAnterior($casos, $ultimoCodigoUsado);
                $ultimoCodigoUsado = $caso['codigocie10'];

                $detalle = Consultadetalle::create([
                    'consulta_id' => $consulta->id,
                    'dtype' => 'Consultadetalle',
                    'creadopor_id' => 1,
                    'modificadopor_id' => 1,
                    'borradopor_id' => 0,
                    'creado_en' => now(),
                    'finalidad_consulta_id' => 1, // Control medico
                    'causa_externa_id' => null,
                    'incapacidad_id' => null,
                    'cremiento_desarrollo' => $caso['crecimiento_desarrollo'],
                    'funciones_biologicas' => $caso['funciones_biologicas'],
                    'sintomas_signos' => $caso['sintomas_signos'],
                    'proxima_cita' => $consulta->eventohc->fechahora->copy()->addMonth(),
                ]);

                $diagnostico = $diagnosticosPorCodigo->get($caso['codigocie10']);

                if ($diagnostico) {
                    DiagnosticoDetalle::create([
                        'diagnostico_id' => $diagnostico->id,
                        'detalle_id' => $detalle->id,
                        'orden' => 1,
                        'textodiagnostico' => $diagnostico->nombre,
                        'es_confirmado' => 1,
                        'tipo_diagnostico_principal_id' => 1,
                    ]);
                }
            }
        }

        Schema::enableForeignKeyConstraints();
    }

    /**
     * @param array<int, array> $casos
     */
    protected function elegirCasoDistintoAlAnterior(array $casos, ?string $ultimoCodigoUsado): array
    {
        if (count($casos) === 1) {
            return $casos[array_key_first($casos)];
        }

        do {
            $caso = $casos[array_rand($casos)];
        } while ($caso['codigocie10'] === $ultimoCodigoUsado);

        return $caso;
    }
}