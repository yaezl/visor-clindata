<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // firstOrCreate evita duplicados: busca por el email, si no existe lo crea con los demás datos
        User::firstOrCreate(
            ['email' => 'medico@clindata.com'], // Condición de búsqueda
            [
                'name' => 'Médico Pediatra',
                'password' => Hash::make('password'),
            ]
        );

        // Ejecutamos los demás seeders
        $this->call([
            PersonalSeeder::class,      // Crea Dra. Fernández (Persona+Personal) + Usuario legacy "sistema"
            GrupoSanguineoSeeder::class, // Usa el Usuario recién creado
            PersonaSeeder::class,        // Usa el Usuario recién creado + grupo_sanguineo
            TurnoProgramadoSeeder::class,
            DiagnosticoSeeder::class,
            AntecedenteperinatalSeeder::class, // Usa Persona + Diagnostico
            AntecedentepatologicoSeeder::class, // Usa Persona + Diagnostico
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
