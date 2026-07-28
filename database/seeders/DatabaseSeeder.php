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
            PersonaSeeder::class,
            DiagnosticoSeeder::class,
            ConsultumSeeder::class,
        ]);
    }
}