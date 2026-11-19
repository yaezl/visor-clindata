<?php

namespace Database\Seeders;

use App\Models\Antecedentepatologico;
use App\Models\Diagnostico;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

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
            '12345678' => [ // Juan Pérez
                [
                    'codigocie10' => 'J4591',
                    'comentario' => 'Antecedente de episodios compatibles con asma o hiperreactividad bronquial durante la primera infancia. Utiliza broncodilatador inhalado de rescate según necesidad.',
                ],
            ],
            '87654321' => [ // María Gómez
                [
                    'codigocie10' => 'J21',
                    'comentario' => 'Episodio de bronquiolitis durante el primer año de vida, manejado en forma ambulatoria, sin requerimiento de internación y con buena evolución.',
                ],
                [
                    'codigocie10' => 'J4591',
                    'comentario' => 'Episodio de broncoespasmo a los 7 meses de edad, tratado en forma ambulatoria.',
                ],
            ],
            '20444555' => [ // Ramón Díaz
                [
                    'codigocie10' => 'H66',
                    'comentario' => 'Antecedente de otitis media aguda a repetición durante la primera infancia, sin secuelas auditivas documentadas.',
                ],
            ],
            '55100006' => [ // Mateo Herrera
                [
                    'codigocie10' => 'J4591',
                    'comentario' => 'Diagnóstico de hiperreactividad bronquial a los 5 años. Episodios estacionales de sibilancias, predominantemente en primavera. En seguimiento.',
                ],
                [
                    'codigocie10' => 'J310',
                    'comentario' => 'Rinitis alérgica asociada al cuadro respiratorio. Empeora con exposición al polen.',
                ],
            ],
            '55100007' => [ // Isabella Morales
                [
                    'codigocie10' => 'J4591',
                    'comentario' => 'Asma bronquial moderada diagnosticada a los 6 años. Antecedente de episodios de broncoespasmo que requirieron evaluación hospitalaria. En seguimiento con tratamiento inhalatorio.',
                ],
                [
                    'codigocie10' => 'J21',
                    'comentario' => 'Antecedente de bronquiolitis durante la primera infancia con requerimiento de internación y oxígeno suplementario. Buena evolución posterior.',
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
