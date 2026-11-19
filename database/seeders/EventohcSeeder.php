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
    ];

    protected const CANTIDAD_POR_DEFECTO = 4;

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $tipoConsulta = Tipocontenido::where('nombre', 'Consulta')->firstOrFail();

        // Solo los 12 pacientes definidos para la demostración reciben eventos.
        $pacientes = Persona::whereIn('documento', PersonaSeeder::DOCUMENTOS_PACIENTES_DEMO)->get();

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
        $nacimiento = $persona->fecha_nacimiento?->copy()->startOfDay()
            ?? now()->subYears(5)->startOfDay();
        $hoy = now()->copy()->startOfDay();
        $diasDisponibles = max(1, $nacimiento->diffInDays($hoy));

        // Distribución determinística de controles a lo largo de la vida
        // del paciente. Evita que los lactantes queden con muy pocas consultas
        // por acumular saltos aleatorios que superen su edad.
        $fechas = collect();
        for ($i = 1; $i <= $cantidad; $i++) {
            $offset = (int) floor(($diasDisponibles * $i) / ($cantidad + 1));
            $fechas->push($nacimiento->copy()->addDays($offset)->setTime(9, 0));
        }

        return $fechas->unique(fn ($fecha) => $fecha->toDateTimeString())
            ->sortBy(fn ($fecha) => $fecha->timestamp)
            ->values();
    }
}