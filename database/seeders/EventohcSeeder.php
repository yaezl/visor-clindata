<?php

namespace Database\Seeders;

use App\Models\Eventohc;
use App\Models\Persona;
use App\Models\Tipocontenido;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class EventohcSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $tipoConsulta = Tipocontenido::where('nombre', 'Consulta')->firstOrFail();

        foreach (Persona::all() as $persona) {

            $fechas = [
                now()->subYear(),
                now()->subMonths(6),
                now()->subMonths(2),
                now()->subDays(10),
            ];

            foreach ($fechas as $fecha) {

                Eventohc::create([
                    'tipocontenido_id' => $tipoConsulta->id,
                    'persona_id'       => $persona->id,
                    'parent_id'        => null,
                    'fechahora'        => $fecha,
                    'datos'            => '',
                    'root'             => 0,
                    'lft'              => 0,
                    'rgt'              => 0,
                    'lvl'              => 0,
                    'creadopor_id'     => 1,
                    'modificadopor_id' => 1,
                    'deleted_by'       => 0,
                ]);

            }
        }

        Schema::enableForeignKeyConstraints();
    }
}