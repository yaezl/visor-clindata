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
            '87654321' => [ // María Gómez: sin medicación crónica activa
            ],
            '20444555' => [ // Ramón Díaz: sin medicación crónica activa
            ],
            '55100006' => [ // Mateo Herrera
                [
                    'nombre' => 'Montelukast',
                    'dosis' => '5mg',
                    'frecuencia' => '1 comprimido masticable por noche',
                    'via_administracion' => 'Oral',
                    'fecha_inicio' => now()->subMonths(3),
                    'fecha_fin' => null,
                    'activa' => true,
                ],
            ],
            '55100007' => [ // Isabella Morales
                [
                    'nombre' => 'Salbutamol',
                    'dosis' => '100mcg',
                    'frecuencia' => 'Según necesidad en crisis (rescate)',
                    'via_administracion' => 'Inhalatoria',
                    'fecha_inicio' => now()->subMonths(8),
                    'fecha_fin' => null,
                    'activa' => true,
                ],
                [
                    'nombre' => 'Fluticasona',
                    'dosis' => '50mcg',
                    'frecuencia' => 'Según esquema de mantenimiento',
                    'via_administracion' => 'Inhalatoria',
                    'fecha_inicio' => now()->subMonths(8),
                    'fecha_fin' => null,
                    'activa' => true,
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
