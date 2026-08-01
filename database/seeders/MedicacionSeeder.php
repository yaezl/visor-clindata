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