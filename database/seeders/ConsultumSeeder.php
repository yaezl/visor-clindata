<?php

namespace Database\Seeders;

use App\Models\Consultum;
use App\Models\Eventohc;
use App\Models\Personal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ConsultumSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        foreach (Eventohc::all() as $evento) {

            $personal = Personal::where('persona_id', $evento->persona_id)->first();

            Consultum::create([
                'turno_id'        => rand(100000, 999999),
                'tipoegreso_id'   => 1,

                'fechahorainicio' => $evento->fechahora,
                'fechahorafin'    => $evento->fechahora->copy()->addMinutes(30),

                'created_by'      => 1,
                'modified_by'     => 1,
                'deleted_by'      => 0,

                'personal_id'     => $personal?->id,

                'evento_id'       => $evento->id,

                'direccion_id'    => rand(100000, 999999),
                'acumulador'      => 0,
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}