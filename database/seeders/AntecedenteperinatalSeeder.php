<?php

namespace Database\Seeders;

use App\Models\AntecPerinatalDiagnostico;
use App\Models\Antecedenteperinatal;
use App\Models\Diagnostico;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Carga un antecedente perinatal por cada paciente pediátrico de
 * PersonaSeeder.
 *
 * Solo pacientes: se apoya en la misma lista de documentos de
 * personal médico que EventohcSeeder, para no crear antecedentes
 * perinatales de médicos.
 */
class AntecedenteperinatalSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $personalId = $this->personalTratanteId();

        $pacientes = Persona::whereNotIn('documento', PersonalSeeder::DOCUMENTOS_PERSONAL_MEDICO)
            ->get()
            ->keyBy('documento');

        foreach ($this->antecedentesPorDocumento() as $documento => $datos) {
            $persona = $pacientes->get($documento);

            if (!$persona) {
                continue;
            }

            $antecedente = Antecedenteperinatal::firstOrCreate(
                ['persona_id' => $persona->id],
                array_merge($datos['antecedente'], [
                    'creadopor_id' => $personalId,
                    'modificadopor_id' => $personalId,
                    'creado_en' => now(),
                ])
            );

            if (isset($datos['codigocie10'])) {
                $diagnostico = Diagnostico::where('codigocie10', $datos['codigocie10'])->first();

                if ($diagnostico) {
                    AntecPerinatalDiagnostico::firstOrCreate([
                        'antecedenteperinatal_id' => $antecedente->id,
                        'diagnostico_id' => $diagnostico->id,
                    ]);
                }
            }
        }

        Schema::enableForeignKeyConstraints();
    }

    /**
     * @return array<string, array{antecedente: array, codigocie10?: string}>
     */
    protected function antecedentesPorDocumento(): array
    {
        return [
            // Juan Pérez (3 años) — parto sin particularidades.
            '12345678' => [
                'antecedente' => [
                    'institucion_nacio' => 'Hospital Universitario',
                    'tipo_parto' => 'Normal',
                    'peso_al_nacer' => 3.2,
                    'edad_gestacional' => 39,
                    'talla' => 50,
                    'perimetro_cefalico' => 34.5,
                    'sano' => true,
                    'con_patologia' => false,
                    'deprimido' => false,
                    'reanimacion' => false,
                    'apgar_1' => 9,
                    'apgar_5' => 10,
                    'comentario' => 'Recién nacido de término, sin complicaciones periparto.',
                    'pesquisa_neonatal' => 'Normal',
                ],
            ],

            // María Gómez (9 meses)
            '87654321' => [
                'antecedente' => [
                    'institucion_nacio' => 'Hospital Universitario',
                    'tipo_parto' => 'Cesárea',
                    'peso_al_nacer' => 2.1,
                    'edad_gestacional' => 36,
                    'talla' => 44,
                    'perimetro_cefalico' => 31,
                    'sano' => true,
                    'con_patologia' => true,
                    'deprimido' => false,
                    'reanimacion' => false,
                    'apgar_1' => 8,
                    'apgar_5' => 9,
                    'comentario' => 'Pretérmino tardía, parto indicado por hipertensión materna. Pequeña para la edad gestacional (PAEG).',
                    'pesquisa_neonatal' => 'Normal',
                ],
            ],

            // Carlos Gómez (2 años) — sano.
            '67245356' => [
                'antecedente' => [
                    'institucion_nacio' => 'Hospital Universitario',
                    'tipo_parto' => 'Normal',
                    'peso_al_nacer' => 3.4,
                    'edad_gestacional' => 39,
                    'talla' => 51,
                    'perimetro_cefalico' => 35,
                    'sano' => true,
                    'con_patologia' => false,
                    'deprimido' => false,
                    'reanimacion' => false,
                    'apgar_1' => 9,
                    'apgar_5' => 10,
                    'comentario' => 'Recién nacido de término, sin complicaciones periparto.',
                    'pesquisa_neonatal' => 'Normal',
                ],
            ],

            // Sofía Martínez (7 años) — sana, sin datos llamativos.
            '41555666' => [
                'antecedente' => [
                    'institucion_nacio' => 'Hospital Universitario',
                    'tipo_parto' => 'Normal',
                    'peso_al_nacer' => 3.1,
                    'edad_gestacional' => 38,
                    'talla' => 49,
                    'perimetro_cefalico' => 34,
                    'sano' => true,
                    'con_patologia' => false,
                    'deprimido' => false,
                    'reanimacion' => false,
                    'apgar_1' => 9,
                    'apgar_5' => 10,
                    'comentario' => 'Recién nacido de término, sin complicaciones periparto.',
                    'pesquisa_neonatal' => 'Normal',
                ],
            ],

            // Ramón Díaz (11 años) — requirió reanimación breve al nacer.
            '20444555' => [
                'antecedente' => [
                    'institucion_nacio' => 'Hospital Universitario',
                    'tipo_parto' => 'Cesárea',
                    'peso_al_nacer' => 2.9,
                    'edad_gestacional' => 37,
                    'talla' => 47,
                    'perimetro_cefalico' => 33,
                    'sano' => false,
                    'con_patologia' => true,
                    'deprimido' => true,
                    'reanimacion' => true,
                    'apgar_1' => 6,
                    'apgar_5' => 9,
                    'comentario' => 'Requirió reanimación breve al nacer, con buena respuesta. Sin secuelas evidentes en los controles posteriores.',
                    'pesquisa_neonatal' => 'Normal',
                ],
            ],
        ];
    }

    protected function personalTratanteId(): ?int
    {
        $documento = PersonalSeeder::DOCUMENTOS_MEDICOS_TRATANTES[0] ?? null;

        if (!$documento) {
            return null;
        }

        return Persona::where('documento', $documento)
            ->first()
            ?->personal
            ?->id;
    }
}