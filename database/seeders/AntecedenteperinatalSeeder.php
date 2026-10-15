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
            // Valentina Torres (7 meses) — pretérmino tardía, sana.
            '55100001' => [
                'antecedente' => [
                    'institucion_nacio'  => 'Hospital Universitario',
                    'tipo_parto'         => 'Cesárea',
                    'peso_al_nacer'      => 2.8,
                    'edad_gestacional'   => 36,
                    'talla'              => 47,
                    'perimetro_cefalico' => 33.0,
                    'sano'               => true,
                    'con_patologia'      => false,
                    'deprimido'          => false,
                    'reanimacion'        => false,
                    'apgar_1'            => 8,
                    'apgar_5'            => 9,
                    'comentario'         => 'Pretérmino tardía. Cesárea por presentación podálica. Sin complicaciones.',
                    'pesquisa_neonatal'  => 'Normal',
                ],
            ],

            // Tomás Ríos (15 meses) — RN de término, sano.
            '55100002' => [
                'antecedente' => [
                    'institucion_nacio'  => 'Hospital Universitario',
                    'tipo_parto'         => 'Normal',
                    'peso_al_nacer'      => 3.5,
                    'edad_gestacional'   => 39,
                    'talla'              => 51,
                    'perimetro_cefalico' => 35.0,
                    'sano'               => true,
                    'con_patologia'      => false,
                    'deprimido'          => false,
                    'reanimacion'        => false,
                    'apgar_1'            => 9,
                    'apgar_5'            => 10,
                    'comentario'         => 'RN de término, parto sin complicaciones.',
                    'pesquisa_neonatal'  => 'Normal',
                ],
            ],

            // Luciana Fernández (2.5 años) — pretérmino moderada, RCIU leve.
            '55100003' => [
                'antecedente' => [
                    'institucion_nacio'  => 'Hospital Universitario',
                    'tipo_parto'         => 'Cesárea',
                    'peso_al_nacer'      => 2.4,
                    'edad_gestacional'   => 34,
                    'talla'              => 45,
                    'perimetro_cefalico' => 31.5,
                    'sano'               => false,
                    'con_patologia'      => true,
                    'deprimido'          => false,
                    'reanimacion'        => false,
                    'apgar_1'            => 7,
                    'apgar_5'            => 9,
                    'comentario'         => 'Pretérmino moderada con RCIU leve. Requirió incubadora 10 días. Buena evolución.',
                    'pesquisa_neonatal'  => 'Normal',
                ],
            ],

            // Agustín López (4 años) — macrosómico, cesárea programada.
            '55100004' => [
                'antecedente' => [
                    'institucion_nacio'  => 'Hospital Universitario',
                    'tipo_parto'         => 'Cesárea',
                    'peso_al_nacer'      => 4.2,
                    'edad_gestacional'   => 40,
                    'talla'              => 53,
                    'perimetro_cefalico' => 36.0,
                    'sano'               => true,
                    'con_patologia'      => false,
                    'deprimido'          => false,
                    'reanimacion'        => false,
                    'apgar_1'            => 9,
                    'apgar_5'            => 10,
                    'comentario'         => 'Cesárea programada por macrosomía fetal. Sin complicaciones.',
                    'pesquisa_neonatal'  => 'Normal',
                ],
            ],

            // Camila Sánchez (5.5 años) — RN de término, parto normal.
            '55100005' => [
                'antecedente' => [
                    'institucion_nacio'  => 'Hospital Universitario',
                    'tipo_parto'         => 'Normal',
                    'peso_al_nacer'      => 3.1,
                    'edad_gestacional'   => 38,
                    'talla'              => 49,
                    'perimetro_cefalico' => 34.0,
                    'sano'               => true,
                    'con_patologia'      => false,
                    'deprimido'          => false,
                    'reanimacion'        => false,
                    'apgar_1'            => 9,
                    'apgar_5'            => 10,
                    'comentario'         => 'RN de término, sin complicaciones periparto.',
                    'pesquisa_neonatal'  => 'Normal',
                ],
            ],

            // Mateo Herrera (8 años) — RN de término, sano.
            '55100006' => [
                'antecedente' => [
                    'institucion_nacio'  => 'Hospital Universitario',
                    'tipo_parto'         => 'Normal',
                    'peso_al_nacer'      => 3.6,
                    'edad_gestacional'   => 40,
                    'talla'              => 51,
                    'perimetro_cefalico' => 35.0,
                    'sano'               => true,
                    'con_patologia'      => false,
                    'deprimido'          => false,
                    'reanimacion'        => false,
                    'apgar_1'            => 9,
                    'apgar_5'            => 10,
                    'comentario'         => 'RN de término, parto sin complicaciones.',
                    'pesquisa_neonatal'  => 'Normal',
                ],
            ],

            // Isabella Morales (10 años) — pretérmino moderada, RCIU leve.
            '55100007' => [
                'antecedente' => [
                    'institucion_nacio'  => 'Hospital Universitario',
                    'tipo_parto'         => 'Normal',
                    'peso_al_nacer'      => 2.7,
                    'edad_gestacional'   => 36,
                    'talla'              => 46,
                    'perimetro_cefalico' => 32.0,
                    'sano'               => false,
                    'con_patologia'      => true,
                    'deprimido'          => false,
                    'reanimacion'        => false,
                    'apgar_1'            => 7,
                    'apgar_5'            => 9,
                    'comentario'         => 'Pretérmino moderada. RCIU leve. Requirió incubadora 5 días.',
                    'pesquisa_neonatal'  => 'Normal',
                ],
            ],

            // Santiago Vega (12 años) — macrosómico, cesárea.
            '55100008' => [
                'antecedente' => [
                    'institucion_nacio'  => 'Hospital Universitario',
                    'tipo_parto'         => 'Cesárea',
                    'peso_al_nacer'      => 4.1,
                    'edad_gestacional'   => 41,
                    'talla'              => 53,
                    'perimetro_cefalico' => 36.0,
                    'sano'               => true,
                    'con_patologia'      => false,
                    'deprimido'          => false,
                    'reanimacion'        => false,
                    'apgar_1'            => 9,
                    'apgar_5'            => 10,
                    'comentario'         => 'Cesárea por macrosomía. RN de término, sin complicaciones.',
                    'pesquisa_neonatal'  => 'Normal',
                ],
            ],

            // Florencia Núñez (16 años) — RN de término, sana.
            '55100009' => [
                'antecedente' => [
                    'institucion_nacio'  => 'Hospital Universitario',
                    'tipo_parto'         => 'Normal',
                    'peso_al_nacer'      => 3.3,
                    'edad_gestacional'   => 39,
                    'talla'              => 50,
                    'perimetro_cefalico' => 34.0,
                    'sano'               => true,
                    'con_patologia'      => false,
                    'deprimido'          => false,
                    'reanimacion'        => false,
                    'apgar_1'            => 9,
                    'apgar_5'            => 10,
                    'comentario'         => 'RN de término, sin complicaciones periparto.',
                    'pesquisa_neonatal'  => 'Normal',
                ],
            ],

            // Benjamín Castro (recién nacido) — RN de término, sano.
            '55100010' => [
                'antecedente' => [
                    'institucion_nacio'  => 'Hospital Universitario',
                    'tipo_parto'         => 'Normal',
                    'peso_al_nacer'      => 3.2,
                    'edad_gestacional'   => 39,
                    'talla'              => 50,
                    'perimetro_cefalico' => 34.5,
                    'sano'               => true,
                    'con_patologia'      => false,
                    'deprimido'          => false,
                    'reanimacion'        => false,
                    'apgar_1'            => 10,
                    'apgar_5'            => 10,
                    'comentario'         => 'RN de término, primera consulta de control.',
                    'pesquisa_neonatal'  => 'Pendiente',
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
