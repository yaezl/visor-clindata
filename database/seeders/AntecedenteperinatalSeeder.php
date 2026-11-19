<?php

namespace Database\Seeders;

use App\Models\AntecPerinatalDiagnostico;
use App\Models\Antecedenteperinatal;
use App\Models\Diagnostico;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Carga un antecedente perinatal por cada uno de los 12 pacientes de
 * demostración (PersonaSeeder::DOCUMENTOS_PACIENTES_DEMO). TODOS tienen uno.
 *
 * Criterios de coherencia usados en los datos:
 *  - sano = true solo si no hay patología, depresión ni reanimación.
 *  - deprimido = true solo con Apgar al minuto <= 6.
 *  - peso / talla al nacer == primera medición de MedicionesAntropometricasSeeder.
 *  - los diagnósticos CIE10 (categoría 'perinatal') se cargan en DiagnosticoSeeder
 *    y se muestran en el tab Antecedentes cuando con_patologia = true.
 *
 * Es idempotente: si se vuelve a correr, actualiza los datos existentes.
 */
class AntecedenteperinatalSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $personalId = $this->personalTratanteId();

        $pacientes = Persona::whereIn('documento', PersonaSeeder::DOCUMENTOS_PACIENTES_DEMO)
            ->get()
            ->keyBy('documento');

        $datosPorDocumento = $this->antecedentesPorDocumento();

        foreach (PersonaSeeder::DOCUMENTOS_PACIENTES_DEMO as $documento) {
            $persona = $pacientes->get($documento);
            $datos = $datosPorDocumento[$documento] ?? null;

            if (!$persona) {
                continue;
            }

            if (!$datos) {
                $this->command?->warn("⚠ Sin antecedente perinatal definido para el documento {$documento}");
                continue;
            }

            $antecedente = Antecedenteperinatal::firstOrNew(['persona_id' => $persona->id]);

            if (!$antecedente->exists) {
                $antecedente->creadopor_id = $personalId;
                $antecedente->creado_en = now();
            }

            $antecedente->fill(array_merge($datos['antecedente'], [
                'modificadopor_id' => $personalId,
                'modificado_en' => now(),
            ]));
            $antecedente->save();

            foreach ((array) ($datos['codigocie10'] ?? []) as $codigo) {
                $diagnostico = Diagnostico::where('codigocie10', $codigo)->first();

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
     * @return array<string, array{antecedente: array, codigocie10?: string|array<int, string>}>
     */
    protected function antecedentesPorDocumento(): array
    {
        return [
            // Juan Pérez — parto sin particularidades.
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

            // María Gómez — pretérmino tardía con ictericia neonatal.
            '87654321' => [
                'antecedente' => [
                    'institucion_nacio' => 'Hospital Universitario',
                    'tipo_parto' => 'Cesárea',
                    'peso_al_nacer' => 2.8,
                    'edad_gestacional' => 36,
                    'talla' => 47,
                    'perimetro_cefalico' => 32.5,
                    'sano' => false,
                    'con_patologia' => true,
                    'deprimido' => false,
                    'reanimacion' => false,
                    'apgar_1' => 8,
                    'apgar_5' => 9,
                    'comentario' => 'Pretérmino tardía, adecuada para la edad gestacional. Cesárea indicada por hipertensión materna. Ictericia neonatal que requirió fototerapia 48 horas, con buena evolución.',
                    'pesquisa_neonatal' => 'Normal',
                ],
                'codigocie10' => ['P073', 'P599'],
            ],

            // Carlos Gómez — RN de término, sano.
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

            // Sofía Martínez — RN de término, sana.
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
                    'comentario' => 'Recién nacida de término, sin complicaciones periparto.',
                    'pesquisa_neonatal' => 'Normal',
                ],
            ],

            // Ramón Díaz — requirió reanimación breve al nacer.
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
                    'comentario' => 'Apgar 6 al minuto: requirió reanimación breve al nacer, con buena respuesta (Apgar 9 a los 5 minutos). Sin secuelas evidentes en los controles posteriores.',
                    'pesquisa_neonatal' => 'Normal',
                ],
                'codigocie10' => 'P211',
            ],

            // Valentina Torres — pretérmino tardía, sana.
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

            // Tomás Ríos — RN de término, sano.
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

            // Luciana Fernández — pretérmino moderado-tardío, requirió incubadora.
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
                    'comentario'         => 'Pretérmino moderado-tardío (34 semanas), adecuada para la edad gestacional. Requirió incubadora 10 días por inmadurez y ganancia de peso. Buena evolución.',
                    'pesquisa_neonatal'  => 'Normal',
                ],
                'codigocie10' => 'P073',
            ],

            // Agustín López — macrosómico, cesárea programada.
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

            // Camila Sánchez — RN de término, parto normal.
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

            // Mateo Herrera — RN de término, sano.
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

            // Isabella Morales — pretérmino tardío con taquipnea transitoria
            // (coherente con su historia respiratoria posterior).
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
                    'comentario'         => 'Pretérmino tardía, adecuada para la edad gestacional. Taquipnea transitoria: requirió incubadora 5 días. Buena evolución.',
                    'pesquisa_neonatal'  => 'Normal',
                ],
                'codigocie10' => ['P073', 'P221'],
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
