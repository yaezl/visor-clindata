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
                    'observaciones' => 'Reacción anafiláctica confirmada en 2015.',
                ],
                [
                    'nombre' => 'Polvo ambiental',
                    'tipo' => 'Ambiental',
                    'severidad' => 'Leve',
                    'observaciones' => 'Rinitis leve en exposición prolongada.',
                ],
            ],
            '87654321' => [ // María Gómez
                [
                    'nombre' => 'Maní',
                    'tipo' => 'Alimentaria',
                    'severidad' => 'Moderada',
                    'observaciones' => null,
                ],
            ],
            '67245356' => [ // Carlos Gómez
                [
                    'nombre' => 'Penicilina',
                    'tipo' => 'Medicamentosa',
                    'severidad' => 'Severa',
                    'observaciones' => null,
                ],
                [
                    'nombre' => 'Polvo ambiental',
                    'tipo' => 'Ambiental',
                    'severidad' => 'Leve',
                    'observaciones' => null,
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