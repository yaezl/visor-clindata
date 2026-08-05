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