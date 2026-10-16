<?php

namespace Database\Seeders;

use App\Models\Antecedentequirurgico;
use App\Models\Estudio;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Antecedentes quirúrgicos de ejemplo para el acordeón "Antecedentes"
 * (sección "Antecedentes quirúrgicos").
 *
 * Cada cirugía referencia un registro del catálogo `estudio` (marcado
 * es_cirugia = 1), igual que en la base real: el nombre sale de
 * Estudio.nombre y el texto libre de 'comentario' cuenta cómo fue.
 * Si el estudio ya existe en el catálogo (por nombre) se reutiliza.
 *
 * Los casos son coherentes con los antecedentes patológicos ya
 * cargados (ej: Santiago Vega tuvo otitis a repetición y se le
 * colocaron tubos de ventilación a los 4 años).
 *
 * Ejecutar solo en entornos de desarrollo.
 */
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
            // Isabella Morales (10 años) — asma moderada
            '55100007' => [
                [
                    'estudio' => 'Adenoamigdalectomía',
                    'edad_anios' => 7,
                    'comentario' => 'Por hipertrofia adenoamigdalina con ronquido nocturno y apneas. Sin complicaciones intra ni postoperatorias. Alta a las 24 hs.',
                ],
            ],

            // Santiago Vega (12 años) — otitis media a repetición
            '55100008' => [
                [
                    'estudio' => 'Colocación de tubos de ventilación timpánica',
                    'edad_anios' => 4,
                    'comentario' => 'Por otitis media aguda a repetición. Buena respuesta, sin otorrea posterior. Los tubos se eliminaron espontáneamente.',
                ],
            ],

            // Florencia Núñez (16 años)
            '55100009' => [
                [
                    'estudio' => 'Apendicectomía',
                    'edad_anios' => 12,
                    'comentario' => 'Apendicitis aguda no complicada, abordaje laparoscópico. Evolución favorable, alta a las 48 hs.',
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