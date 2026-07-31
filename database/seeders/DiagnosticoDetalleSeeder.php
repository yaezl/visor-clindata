<?php

namespace Database\Seeders;

use App\Models\Consultadetalle;
use App\Models\Diagnostico;
use App\Models\DiagnosticoDetalle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DiagnosticoDetalleSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $diagnosticos = Diagnostico::all();

        foreach (Consultadetalle::all() as $detalle) {

            $cantidad = rand(1,2);

            foreach ($diagnosticos->random($cantidad) as $diagnostico) {

                DiagnosticoDetalle::create([

                    'diagnostico_id' => $diagnostico->id,

                    // ESTE ES EL CAMPO CORRECTO
                    'detalle_id' => $detalle->id,

                    'orden' => 1,

                    'textodiagnostico' => $diagnostico->nombre,

                    'es_confirmado' => 1,

                    'tipo_diagnostico_principal_id' => 1,

                ]);

            }

        }

        Schema::enableForeignKeyConstraints();
    }
}