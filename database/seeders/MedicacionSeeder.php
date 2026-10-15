<?php

namespace Database\Seeders;

use App\Models\Medicacion;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MedicacionSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Documento => lista de medicación a cargar para ese paciente
        $medicacionPorPaciente = [
            '12345678' => [ // Juan Pérez
                [
                    'nombre' => 'Salbutamol',
                    'dosis' => '100mcg',
                    'frecuencia' => 'Según necesidad (rescate)',
                    'via_administracion' => 'Inhalatoria',
                    'fecha_inicio' => now()->subMonths(6),
                    'fecha_fin' => null,
                    'activa' => true,
                ],
            ],
            '87654321' => [ // María Gómez
                // Sin medicación activa actualmente
            ],
            '67245356' => [ // Carlos Gómez
                [
                    'nombre' => 'Salbutamol',
                    'dosis' => '100mcg',
                    'frecuencia' => '2 puff cada 8hs (según necesidad)',
                    'via_administracion' => 'Inhalatoria',
                    'fecha_inicio' => now()->subMonths(2),
                    'fecha_fin' => null,
                    'activa' => true,
                ],
            ],
            // Mateo Herrera — antiasmático de mantenimiento
            '55100006' => [
                [
                    'nombre'             => 'Montelukast',
                    'dosis'              => '5mg',
                    'frecuencia'         => '1 comprimido masticable por noche',
                    'via_administracion' => 'Oral',
                    'fecha_inicio'       => now()->subMonths(3),
                    'fecha_fin'          => null,
                    'activa'             => true,
                ],
            ],

            // Isabella Morales — asma moderada, doble esquema
            '55100007' => [
                [
                    'nombre'             => 'Salbutamol',
                    'dosis'              => '100mcg',
                    'frecuencia'         => '2 puff cada 8hs en crisis (rescate)',
                    'via_administracion' => 'Inhalatoria',
                    'fecha_inicio'       => now()->subMonths(8),
                    'fecha_fin'          => null,
                    'activa'             => true,
                ],
                [
                    'nombre'             => 'Fluticasona',
                    'dosis'              => '50mcg',
                    'frecuencia'         => '1 puff cada 12hs (mantenimiento)',
                    'via_administracion' => 'Inhalatoria',
                    'fecha_inicio'       => now()->subMonths(8),
                    'fecha_fin'          => null,
                    'activa'             => true,
                ],
            ],

            // Florencia Núñez — anticoncepción oral
            '55100009' => [
                [
                    'nombre'             => 'Anticonceptivos orales',
                    'dosis'              => '1 comprimido diario',
                    'frecuencia'         => 'Tomar 21 días, descansar 7',
                    'via_administracion' => 'Oral',
                    'fecha_inicio'       => now()->subMonths(4),
                    'fecha_fin'          => null,
                    'activa'             => true,
                ],
            ],
        ];

        foreach ($medicacionPorPaciente as $documento => $medicaciones) {

            $persona = Persona::where('documento', $documento)->first();

            if (!$persona) {
                continue;
            }

            foreach ($medicaciones as $medicacion) {
                Medicacion::firstOrCreate(
                    [
                        'persona_id' => $persona->id,
                        'nombre'     => $medicacion['nombre'],
                    ],
                    [
                        'dosis'              => $medicacion['dosis'],
                        'frecuencia'         => $medicacion['frecuencia'],
                        'via_administracion' => $medicacion['via_administracion'],
                        'fecha_inicio'       => $medicacion['fecha_inicio'],
                        'fecha_fin'          => $medicacion['fecha_fin'],
                        'activa'             => $medicacion['activa'],
                        'borrado_logico'     => false,
                        'creado_por_id'      => 1,
                    ]
                );
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
