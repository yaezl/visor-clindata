<?php

namespace Database\Seeders;

use App\Models\Antecedentequirurgico;
use App\Models\Estudio;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AntecedentequirurgicoSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $personalId = $this->personalTratanteId();

        $pacientes = Persona::whereNotIn('documento', PersonalSeeder::DOCUMENTOS_PERSONAL_MEDICO)
            ->get()
            ->keyBy('documento');

        foreach ($this->cirugiasPorDocumento() as $documento => $cirugias) {
            $persona = $pacientes->get($documento);

            if (!$persona) {
                continue;
            }

            foreach ($cirugias as $cirugia) {
                $estudio = Estudio::firstOrCreate(
                    ['nombre' => $cirugia['estudio']],
                    [
                        'created_by' => 1,
                        'modified_by' => 1,
                        'borrado_logico' => 0,
                        'requiere_autorizacion' => 0,
                        'es_cirugia' => 1,
                        'es_especial' => 0,
                    ]
                );

                // La fecha se calcula con la edad del paciente al momento de la
                // cirugía, así sigue siendo coherente aunque pase el tiempo.
                $fecha = $persona->fecha_nacimiento->copy()->addYears($cirugia['edad_anios']);

                // firstOrCreate: volver a correr el seeder no pisa lo ya cargado.
                // borrado_en es NOT NULL en esta tabla (igual que en
                // antecedentepatologico), por eso se completa con now().
                Antecedentequirurgico::firstOrCreate(
                    [
                        'persona_id' => $persona->id,
                        'estudio_id' => $estudio->id,
                    ],
                    [
                        'comentario' => $cirugia['comentario'],
                        'fecha_cirugia' => $fecha,
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
     * @return array<string, array<int, array{estudio: string, edad_anios: int, comentario: string}>>
     */
    protected function cirugiasPorDocumento(): array
    {
        return [
            // Ramón Díaz: cirugía asociada a su otitis media recurrente (ver
            // AntecedentepatologicoSeeder).
            '20444555' => [
                [
                    'estudio' => 'Colocación de tubos de ventilación (drenaje transtimpánico)',
                    'edad_anios' => 4,
                    'comentario' => 'Colocación bilateral por otitis media aguda recurrente. Sin complicaciones; extrusión espontánea de los tubos con posterioridad.',
                ],
            ],

            // Isabella Morales: antecedente quirúrgico documentado para la demo.
            '55100007' => [
                [
                    'estudio' => 'Adenoamigdalectomía',
                    'edad_anios' => 7,
                    'comentario' => 'Cirugía por hipertrofia adenoamigdalina con ronquido nocturno. Evolución postoperatoria favorable, sin complicaciones registradas.',
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