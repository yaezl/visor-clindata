<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PersonalSeeder::class,
            GrupoSanguineoSeeder::class,
            PersonaSeeder::class,
            ObraSocialSeeder::class,
            PersonaPlanSeeder::class,
            TurnoProgramadoSeeder::class,
            DiagnosticoSeeder::class,
            AntecedenteperinatalSeeder::class,
            AntecedentepatologicoSeeder::class,
            AntecedentequirurgicoSeeder::class,
            TipoContenidoSeeder::class,
            EventohcSeeder::class,
            ConsultumSeeder::class,
            ConsultadetalleSeeder::class,
            DiagnosticoDetalleSeeder::class,
            AlergiaSeeder::class,
            MedicacionSeeder::class,
            MedicionesAntropometricasSeeder::class,
            PediatriaOmsSeeder::class,
        ]);
    }
}