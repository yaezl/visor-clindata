<?php

namespace Database\Seeders;

use App\Models\Antecedentepatologico;
use App\Models\Diagnostico;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Antecedentes patológicos relevantes por paciente: no son la consulta
 * de hoy (eso vive en Eventohc/Consultadetalle), sino "qué le pasó antes
 * y cómo fue" — el mismo tipo de dato que aparece en la sección
 * "Antecedentes personales relevantes" del PDF real del hospital
 * (ej: "episodio de broncoespasmo a los 7 meses, tratado en forma
 * ambulatoria").
 *
 * El texto libre de 'comentario' es justamente donde se cuenta cómo
 * empezó/se manejó la patología, sin necesidad de un campo nuevo.
 */
class AntecedentepatologicoSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $personalId = $this->personalTratanteId();

        $pacientes = Persona::whereNotIn('documento', PersonalSeeder::DOCUMENTOS_PERSONAL_MEDICO)
            ->get()
            ->keyBy('documento');

        $diagnosticosPorCodigo = Diagnostico::whereIn(
            'codigocie10',
            collect($this->antecedentesPorDocumento())->flatten(1)->pluck('codigocie10')->unique()
        )->get()->keyBy('codigocie10');

        foreach ($this->antecedentesPorDocumento() as $documento => $antecedentes) {
            $persona = $pacientes->get($documento);

            if (!$persona) {
                continue;
            }

            foreach ($antecedentes as $antecedente) {
                $diagnostico = $diagnosticosPorCodigo->get($antecedente['codigocie10']);

                if (!$diagnostico) {
                    continue;
                }

                Antecedentepatologico::firstOrCreate(
                    [
                        'persona_id' => $persona->id,
                        'diagnostico_id' => $diagnostico->id,
                    ],
                    [
                        'comentario' => $antecedente['comentario'],
                        'personal_id' => $personalId,
                        'creado_en' => now(),
                        'borrado_en' => now(),
                        'creadopor_id' => $personalId,
                        'modificadopor_id' => $personalId,
                    ]
                );
            }
        }

        Schema::enableForeignKeyConstraints();
    }

    /**
     * @return array<string, array<int, array{codigocie10: string, comentario: string}>>
     */
    protected function antecedentesPorDocumento(): array
    {
        return [
            // María Gómez (9 meses) — historia larga, con antecedente
            // respiratorio relevante (igual al caso del resumen_ia).
            '87654321' => [
                [
                    'codigocie10' => 'J21',
                    'comentario' => 'Episodio de bronquiolitis durante el primer año de vida, manejado en forma ambulatoria, sin requerimiento de internación, con buena respuesta a salbutamol y kinesioterapia respiratoria.',
                ],
                [
                    'codigocie10' => 'J4591',
                    'comentario' => 'Episodio de broncoespasmo a los 7 meses de edad, tratado en forma ambulatoria con agonistas β2 inhalados.',
                ],
            ],

            // Ramón Díaz (11 años) — antecedente de otitis a repetición
            // de más chico.
            '20444555' => [
                [
                    'codigocie10' => 'H66',
                    'comentario' => 'Antecedente de otitis media aguda a repetición durante la primera infancia, sin requerimiento de cirugía ni secuelas auditivas documentadas.',
                ],
            ],
            // Valentina Torres (7 meses) — episodio de dificultad respiratoria
            '55100001' => [
                [
                    'codigocie10' => 'J21',
                    'comentario'  => 'Episodio de bronquiolitis al mes de vida, manejado en internación breve de 3 días. Buena respuesta a kinesioterapia respiratoria. Sin requerimiento de oxígeno suplementario.',
                ],
            ],

            // Luciana Fernández (2.5 años) — antecedente digestivo
            '55100003' => [
                [
                    'codigocie10' => 'A09',
                    'comentario'  => 'Episodio de gastroenteritis aguda a los 18 meses con deshidratación leve. Requirió hidratación parenteral durante 24hs. Buena evolución sin secuelas.',
                ],
            ],

            // Camila Sánchez (5.5 años) — infecciones urinarias a repetición
            '55100005' => [
                [
                    'codigocie10' => 'N390',
                    'comentario'  => 'Dos episodios de infección urinaria baja entre los 3 y 4 años. Se realizó ecografía renal y vesical sin hallazgos patológicos. Sin recurrencias desde entonces.',
                ],
            ],

            // Mateo Herrera (8 años) — asma leve persistente
            '55100006' => [
                [
                    'codigocie10' => 'J4591',
                    'comentario'  => 'Diagnóstico de hiperreactividad bronquial a los 5 años. Episodios estacionales de sibilancias, predominantemente en primavera. Actualmente bajo tratamiento con montelukast con buena respuesta.',
                ],
                [
                    'codigocie10' => 'J310',
                    'comentario'  => 'Rinitis alérgica asociada al cuadro de hiperreactividad bronquial. Empeora con exposición al polen. Manejo sintomático.',
                ],
            ],

            // Isabella Morales (10 años) — asma moderada
            '55100007' => [
                [
                    'codigocie10' => 'J4591',
                    'comentario'  => 'Asma bronquial moderada diagnosticada a los 6 años. Múltiples episodios de broncoespasmo, dos de los cuales requirieron internación breve. Actualmente con esquema inhalatorio doble (salbutamol rescate + fluticasona mantenimiento).',
                ],
                [
                    'codigocie10' => 'J21',
                    'comentario'  => 'Antecedente de bronquiolitis grave al año de vida con requerimiento de internación de 7 días y oxígeno suplementario. Se considera factor predisponente para el cuadro asmático actual.',
                ],
            ],

            // Santiago Vega (12 años) — otitis y cuadros respiratorios
            '55100008' => [
                [
                    'codigocie10' => 'H66',
                    'comentario'  => 'Antecedente de otitis media aguda a repetición entre los 2 y 5 años. Colocación de tubos de ventilación a los 4 años con buena respuesta. Sin recurrencias posteriores.',
                ],
                [
                    'codigocie10' => 'J20',
                    'comentario'  => 'Episodios frecuentes de bronquitis aguda durante la infancia, sin evolución a asma. Último episodio a los 8 años.',
                ],
            ],

            // Florencia Núñez (16 años) — episodio digestivo y urinario
            '55100009' => [
                [
                    'codigocie10' => 'N390',
                    'comentario'  => 'Episodio de infección urinaria alta (pielonefritis) a los 13 años. Requirió internación de 4 días con antibiótico IV. Estudio posterior sin hallazgos patológicos.',
                ],
                [
                    'codigocie10' => 'R11',
                    'comentario'  => 'Episodios recurrentes de náuseas y vómitos funcionales entre los 10 y 12 años, estudiados sin causa orgánica identificada. Resolución espontánea.',
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
