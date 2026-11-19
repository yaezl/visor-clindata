<?php

namespace Database\Seeders;

use App\Models\Alergia;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AlergiaSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Documento => lista de alergias a cargar para ese paciente
        $alergiasPorPaciente = [
            '12345678' => [ // Juan Pérez
                [
                    'nombre' => 'Penicilina',
                    'tipo' => 'Medicamentosa',
                    'severidad' => 'Severa',
                    'observaciones' => 'Antecedente de reacción inmediata compatible con alergia medicamentosa. Evitar penicilinas y verificar antes de indicar antibióticos.',
                ],
                [
                    'nombre' => 'Polvo ambiental',
                    'tipo' => 'Ambiental',
                    'severidad' => 'Leve',
                    'observaciones' => 'Rinitis leve ante exposición prolongada.',
                ],
            ],
            '87654321' => [ // María Gómez
                [
                    'nombre' => 'Maní',
                    'tipo' => 'Alimentaria',
                    'severidad' => 'Moderada',
                    'observaciones' => 'Reacción cutánea luego de la ingesta. Evitar el alimento y controlar posibles trazas.',
                ],
            ],
            '55100006' => [ // Mateo Herrera
                [
                    'nombre' => 'Polen',
                    'tipo' => 'Ambiental',
                    'severidad' => 'Leve',
                    'observaciones' => 'Rinitis estacional que puede acompañarse de síntomas respiratorios.',
                ],
            ],
            '55100007' => [ // Isabella Morales
                [
                    'nombre' => 'Amoxicilina',
                    'tipo' => 'Medicamentosa',
                    'severidad' => 'Severa',
                    'observaciones' => 'Antecedente de rash generalizado con angioedema. Registrar y verificar antes de indicar betalactámicos.',
                ],
                [
                    'nombre' => 'Látex',
                    'tipo' => 'Ambiental',
                    'severidad' => 'Moderada',
                    'observaciones' => 'Utilizar insumos y guantes libres de látex durante la atención.',
                ],
            ],
        ];

        foreach ($alergiasPorPaciente as $documento => $alergias) {

            $persona = Persona::where('documento', $documento)->first();

            if (!$persona) {
                continue;
            }

            foreach ($alergias as $alergia) {
                Alergia::firstOrCreate(
                    [
                        'persona_id' => $persona->id,
                        'nombre'     => $alergia['nombre'],
                    ],
                    [
                        'tipo'           => $alergia['tipo'],
                        'severidad'      => $alergia['severidad'],
                        'observaciones'  => $alergia['observaciones'],
                        'activa'         => true,
                        'borrado_logico' => false,
                        'creado_por_id'  => 1,
                    ]
                );
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
