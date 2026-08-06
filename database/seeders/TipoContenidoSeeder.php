<?php

namespace Database\Seeders;

use App\Models\Tipocontenido;
use Illuminate\Database\Seeder;

class TipoContenidoSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            'Consulta',
            'Estudio',
            'Internación',
        ];

        foreach ($tipos as $nombre) {

            Tipocontenido::firstOrCreate(
                ['nombre' => $nombre],
                [
                    'created_by' => 1,
                    'modified_by' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

        }
    }
}