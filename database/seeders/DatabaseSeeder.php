<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario para pruebas de login. Es viejo, ahora no se usa la tabla User, sino Usuario
        User::updateOrCreate(
            ['email' => 'medico@clindata.com'],
            [
                'name'     => 'medico.pediatra',
                'password' => Hash::make('password'),
            ]
        );

        $this->call([
            PersonalSeeder::class,
            GrupoSanguineoSeeder::class,
            PersonaSeeder::class,

            // Obras sociales, planes y sus catálogos de FK (TipoBeneficiario,
            // TipoParentesco). Debe ir ANTES de PersonaPlanSeeder.
            ObraSocialSeeder::class,

            // Asigna obras sociales a los pacientes y marca crónicos.
            // Depende de PersonaSeeder y ObraSocialSeeder.
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