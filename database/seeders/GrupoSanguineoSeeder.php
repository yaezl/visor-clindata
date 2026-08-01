<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoSanguineoSeeder extends Seeder
{
    public function run(): void
    {
        $usuarioSistemaId = DB::table('usuario')->where('username', 'laura.fernandez')->value('id');

        $grupos = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

        foreach ($grupos as $codigo) {
            DB::table('grupo_sanguineo')->updateOrInsert(
                ['codigo' => $codigo],
                [
                    'nombre'            => $codigo,
                    'creado_por_id'     => $usuarioSistemaId,
                    'modificado_por_id' => $usuarioSistemaId,
                    'creado_en'         => now(),
                    'modificado_en'     => now(),
                    'borrado_logico'    => 0,
                ]
            );
        }
    }
}