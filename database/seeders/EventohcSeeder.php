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
        '55100001' => 3,   // Valentina, 7 meses — pocos controles
        '55100002' => 5,   // Tomás, 15 meses
        '55100003' => 7,   // Luciana, 2.5 años
        '55100004' => 5,   // Agustín, 4 años
        '55100005' => 6,   // Camila, 5.5 años
        '55100006' => 8,   // Mateo, 8 años
        '55100007' => 10,  // Isabella, 10 años
        '55100008' => 11,  // Santiago, 12 años
        '55100009' => 12,  // Florencia, 16 años
        '55100010' => 1,   // Benjamín, recién nacido
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

                Eventohc::firstOrCreate(
                    [
                        'persona_id' => $persona->id,
                        'fechahora'  => $fecha,
                    ],
                    [
                        'tipocontenido_id' => $tipoConsulta->id,
                        'parent_id' => null,
                        'datos' => '',
                        'root' => 0,
                        'lft' => 0,
                        'rgt' => 0,
                        'lvl' => 0,
                        'creadopor_id' => 1,
                        'modificadopor_id' => 1,
                        'deleted_by' => 0,
                    ]
                );
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