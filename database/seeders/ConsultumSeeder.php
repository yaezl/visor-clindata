<?php

namespace Database\Seeders;

use App\Models\Consultum;
use App\Models\Eventohc;
use App\Models\Persona;
use App\Models\Personal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ConsultumSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Pool de médicos TRATANTES (excluye a la Dra. Fernández, que queda
        // como admin y no debe figurar atendiendo pacientes).
        $medicos = Personal::whereHas('persona', function ($q) {
                $q->whereIn('documento', PersonalSeeder::DOCUMENTOS_MEDICOS_TRATANTES);
            })
            ->get();

        if ($medicos->isEmpty()) {
            Schema::enableForeignKeyConstraints();
            return;
        }

        $indiceMedico = 0;

        // Ordenamos por paciente y fecha para que la rotación de médico
        // sea prolija (cada consulta de un mismo paciente queda con un
        // médico distinto, si hay suficientes médicos en el pool).
        foreach (Eventohc::orderBy('persona_id')->orderBy('fechahora')->get() as $evento) {

            $medico = $medicos[$indiceMedico % $medicos->count()];
            $indiceMedico++;

            Consultum::create([
                'turno_id'        => rand(100000, 999999),
                'tipoegreso_id'   => 1,

                'fechahorainicio' => $evento->fechahora,
                'fechahorafin'    => $evento->fechahora->copy()->addMinutes(30),

                'created_by'      => 1,
                'modified_by'     => 1,
                'deleted_by'      => 0,

                'personal_id'     => $medico->id,

                'evento_id'       => $evento->id,

                'direccion_id'    => rand(100000, 999999),
                'acumulador'      => 0,
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}