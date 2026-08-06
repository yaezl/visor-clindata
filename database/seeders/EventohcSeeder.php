<?php

namespace Database\Seeders;

use App\Models\Eventohc;
use App\Models\Persona;
use App\Models\Tipocontenido;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class EventohcSeeder extends Seeder
{
    /**
     * Cantidad de consultas a generar por paciente. Es intencionalmente
     * variable (algunos con historia corta, otros con historia larga)
     * para poder probar el Resumen en distintos escenarios.
     */
    protected const CANTIDAD_EVENTOS_POR_PACIENTE = [
        // documento => cantidad de eventos
        '12345678' => 3,  // historia corta
        '87654321' => 9,  // lactante con historia larga (mas controles)
        '67245356' => 6,
        '41555666' => 4,
        '20444555' => 2,  // historia muy corta
    ];

    protected const CANTIDAD_POR_DEFECTO = 4;

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $tipoConsulta = Tipocontenido::where('nombre', 'Consulta')->firstOrFail();

        // Solo los pacientes (documentos que NO son de personal medico)
        // reciben eventos de historia clinica.
        $pacientes = Persona::whereNotIn('documento', PersonalSeeder::DOCUMENTOS_PERSONAL_MEDICO)->get();

        foreach ($pacientes as $persona) {

            $cantidad = self::CANTIDAD_EVENTOS_POR_PACIENTE[$persona->documento]
                ?? self::CANTIDAD_POR_DEFECTO;

            foreach ($this->generarFechas($persona, $cantidad) as $fecha) {

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

    /**
     * Genera $cantidad fechas de consulta, distribuidas hacia atras desde
     * hoy, sin nunca ser anteriores a la fecha de nacimiento del paciente
     * (para que la historia sea clinicamente posible).
     *
     * @return \Illuminate\Support\Collection<int, \Carbon\Carbon>
     */
    protected function generarFechas(Persona $persona, int $cantidad): \Illuminate\Support\Collection
    {
        $nacimiento = $persona->fecha_nacimiento?->copy() ?? now()->subYears(5);

        $fechas = collect();
        $cursor = now()->copy();

        for ($i = 0; $i < $cantidad; $i++) {
            // Espaciado irregular entre 10 y 45 dias hacia atras, sin
            // pasar nunca la fecha de nacimiento.
            $salto = rand(10, 45);
            $cursor = $cursor->copy()->subDays($salto);

            if ($cursor->lessThan($nacimiento)) {
                break;
            }

            $fechas->push($cursor->copy());
        }

        return $fechas->sortBy(fn ($f) => $f->timestamp)->values();
    }
}