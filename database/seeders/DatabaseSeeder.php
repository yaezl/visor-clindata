<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario principal — se puede ingresar con:
        //   · email:    medico@clindata.com  / password
        //   · usuario:  medico.pediatra      / password  (busca por columna `name`)
        // El `name` actúa como username (login); la topbar mostrará "Hola, Médico Pediatra"
        // solo si el controlador/topbar usa el campo `name` formateado. Para que la
        // topbar muestre un nombre legible, guardamos el nombre de usuario en `name`
        // y el nombre real se mostraría desde Personal/Persona si estuviera vinculado.
        // Por ahora ajustamos el `name` a algo presentable.
        User::updateOrCreate(
            ['email' => 'medico@clindata.com'],
            [
                'name'     => 'medico.pediatra',
                'password' => Hash::make('password'),
            ]
        );

        // Ejecutamos los demás seeders
        $this->call([
            PersonalSeeder::class,
            GrupoSanguineoSeeder::class,
            PersonaSeeder::class,
            TurnoProgramadoSeeder::class,
            DiagnosticoSeeder::class,
            AntecedenteperinatalSeeder::class,
            AntecedentepatologicoSeeder::class,
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
