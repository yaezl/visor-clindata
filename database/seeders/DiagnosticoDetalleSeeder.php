<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * DEPRECADO: la generacion de DiagnosticoDetalle ahora ocurre dentro de
 * ConsultadetalleSeeder, para garantizar que el diagnostico sea coherente
 * con el motivo de consulta (mismo "caso clinico").
 *
 * Se deja esta clase vacia (en vez de borrarla) para no romper la
 * referencia en DatabaseSeeder ni el orden historico de seeders.
 */
class DiagnosticoDetalleSeeder extends Seeder
{
    public function run(): void
    {
        // No-op intencional. Ver ConsultadetalleSeeder.
    }
}