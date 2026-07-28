<?php

namespace Database\Seeders;

use App\Models\Consultum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ConsultumSeeder extends Seeder
{
    public function run(): void
    {
        // Apagamos llaves foráneas temporalmente
        Schema::disableForeignKeyConstraints();

        // Creamos la Consulta 1 con identificadores únicos al azar
        Consultum::create([
            'fechahorainicio' => now()->subYears(1),
            'fechahorafin' => now()->subYears(1)->addMinutes(30),
            'created_by' => 1,
            'modified_by' => 1,
            'deleted_by' => 0,
            'personal_id' => 1,
            'turno_id' => rand(100000, 999999),     // ID al azar para que no dé duplicado
            'tipoegreso_id' => 1,
            'evento_id' => rand(100000, 999999),    // ID al azar
            'direccion_id' => rand(100000, 999999), // ID al azar
            'acumulador' => 0,
        ]);

        // Creamos la Consulta 2
        Consultum::create([
            'fechahorainicio' => now()->subDays(2),
            'fechahorafin' => now()->subDays(2)->addMinutes(20),
            'created_by' => 1,
            'modified_by' => 1,
            'deleted_by' => 0,
            'personal_id' => 1,
            'turno_id' => rand(100000, 999999),     // ID al azar distinto
            'tipoegreso_id' => 1,
            'evento_id' => rand(100000, 999999),    // ID al azar distinto
            'direccion_id' => rand(100000, 999999), // ID al azar distinto
            'acumulador' => 0,
        ]);

        // Volvemos a encender las llaves foráneas
        Schema::enableForeignKeyConstraints();
    }
}