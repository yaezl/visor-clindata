<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * MedicionesAntropometricasSeeder
 * ─────────────────────────────────
 * Carga mediciones antropométricas de prueba para los pacientes
 * pediátricos creados por PersonaSeeder.
 *
 * Pacientes (definidos en PersonaSeeder):
 *   - Juan    doc:12345678  ~3 años   M  → controles desde el nacimiento
 *   - María   doc:87654321  ~9 meses  F  → controles mensuales
 *   - Carlos  doc:67245356  ~2 años   M  → controles trimestrales
 *   - Sofía   doc:41555666  ~7 años   F  → controles anuales (sin alertas)
 *   - Ramón   doc:20444555  ~11 años  M  → controles anuales (alerta: vel. crecimiento baja)
 *
 * Importante: corre DESPUÉS de PersonaSeeder en DatabaseSeeder.
 *
 * Uso:
 *   php artisan db:seed --class=MedicionesAntropometricasSeeder
 */
class MedicionesAntropometricasSeeder extends Seeder
{
    // ID del usuario sistema — se resuelve dinámicamente en run()
    private int $usuarioId;

    public function run(): void
    {
        // Tomar el primer usuario disponible (no asumir que existe id=1)
        $this->usuarioId = DB::table('usuario')->value('id')
            ?? throw new \RuntimeException('No hay usuarios en la tabla `usuario`. Correr PersonalSeeder primero.');

        // Buscar cada paciente por documento (el campo único que usa PersonaSeeder)
        $juan   = Persona::where('documento', '12345678')->first();
        $maria  = Persona::where('documento', '87654321')->first();
        $carlos = Persona::where('documento', '67245356')->first();
        $sofia  = Persona::where('documento', '41555666')->first();
        $ramon  = Persona::where('documento', '20444555')->first();
        $valentina = Persona::where('documento', '55100001')->first();
        $tomas     = Persona::where('documento', '55100002')->first();
        $luciana   = Persona::where('documento', '55100003')->first();
        $agustin   = Persona::where('documento', '55100004')->first();
        $camila    = Persona::where('documento', '55100005')->first();
        $mateo     = Persona::where('documento', '55100006')->first();
        $isabella  = Persona::where('documento', '55100007')->first();
        $santiago  = Persona::where('documento', '55100008')->first();
        $florencia = Persona::where('documento', '55100009')->first();
        $benjamin  = Persona::where('documento', '55100010')->first();

        if ($valentina) $this->medicionesValentina($valentina);
        if ($tomas)     $this->medicionesTomas($tomas);
        if ($luciana)   $this->medicionesLuciana($luciana);
        if ($agustin)   $this->medicionesAgustin($agustin);
        if ($camila)    $this->medicionesCamila($camila);
        if ($mateo)     $this->medicionesMateo($mateo);
        if ($isabella)  $this->medicionesIsabella($isabella);
        if ($santiago)  $this->medicionesSantiago($santiago);
        if ($florencia) $this->medicionesFlorencia($florencia);
        if ($benjamin)  $this->medicionesBenjamin($benjamin);
        if ($juan)   $this->medicionesJuan($juan);
        if ($maria)  $this->medicionesMaria($maria);
        if ($carlos) $this->medicionesCarlos($carlos);
        if ($sofia)  $this->medicionesSofia($sofia);
        if ($ramon)  $this->medicionesRamon($ramon);

        $this->command->info('✓ Mediciones antropométricas cargadas para:');
        foreach (compact('juan', 'maria', 'carlos', 'sofia', 'ramon', 'valentina', 'tomas', 'luciana', 'agustin', 'camila', 'mateo', 'isabella', 'santiago', 'florencia', 'benjamin') as $nombre => $persona) {
            $estado = $persona ? "id {$persona->id}" : '⚠ no encontrado (correr PersonaSeeder primero)';
            $this->command->info("  · {$nombre}: {$estado}");
        }
    }

    // ══════════════════════════════════════════════════════════════════
    //  Juan — ~3 años, M. Controles desde el nacimiento.
    //  Percentiles normales, sin alertas.
    // ══════════════════════════════════════════════════════════════════
    private function medicionesJuan(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);

        // [meses_desde_nac, peso_kg, talla_cm]
        $controles = [
            [0,  3.3,  49.9],
            [1,  4.5,  54.7],
            [2,  5.6,  58.0],
            [3,  6.4,  61.0],
            [4,  7.0,  63.4],
            [5,  7.5,  65.4],
            [6,  7.9,  67.3],
            [9,  8.9,  71.7],
            [12, 9.6,  75.4],
            [18,10.9,  81.5],
            [24,12.2,  86.8],
            [30,13.3,  92.5],
            [36,14.3,  98.0],
        ];

        $this->insertar($persona->id, $nac, $controles, modo: 'meses');
    }

    // ══════════════════════════════════════════════════════════════════
    //  María — ~9 meses, F. Controles mensuales desde nacimiento.
    //  Lactante con buen crecimiento.
    // ══════════════════════════════════════════════════════════════════
    private function medicionesMaria(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);

        $controles = [
            [0, 3.2,  49.1],
            [1, 4.2,  53.7],
            [2, 5.1,  57.1],
            [3, 5.8,  59.8],
            [4, 6.4,  62.1],
            [5, 6.9,  64.0],
            [6, 7.3,  65.7],
            [7, 7.6,  67.3],
            [8, 7.9,  68.7],
            [9, 8.2,  70.1],
        ];

        $this->insertar($persona->id, $nac, $controles, modo: 'meses');
    }

    // ══════════════════════════════════════════════════════════════════
    //  Carlos — ~2 años, M. Controles trimestrales.
    //  Crecimiento un poco por encima del P50.
    // ══════════════════════════════════════════════════════════════════
    private function medicionesCarlos(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);

        $controles = [
            [0,  3.5,  50.5],
            [3,  6.8,  62.0],
            [6,  8.3,  68.5],
            [9,  9.4,  73.0],
            [12,10.3,  77.0],
            [15,11.0,  80.5],
            [18,11.8,  83.5],
            [21,12.5,  86.5],
            [24,13.2,  89.5],
        ];

        $this->insertar($persona->id, $nac, $controles, modo: 'meses');
    }

    // ══════════════════════════════════════════════════════════════════
    //  Sofía — ~7 años, F. Controles anuales.
    //  Percentil 50, sin alertas. Caso "todo verde".
    // ══════════════════════════════════════════════════════════════════
    private function medicionesSofia(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);

        // [años_desde_nac, peso_kg, talla_cm]
        $controles = [
            [0,  3.2,  49.1],
            [1,  9.0,  74.0],
            [2, 11.5,  85.5],
            [3, 13.9,  97.4],
            [4, 15.8, 106.7],
            [5, 17.7, 114.7],
            [6, 19.4, 121.7],
            [7, 21.2, 128.1],
        ];

        $this->insertar($persona->id, $nac, $controles, modo: 'anios');
    }

    // ══════════════════════════════════════════════════════════════════
    //  Ramón — ~11 años, M. Controles anuales.
    //  Velocidad de crecimiento baja en los últimos 2 años → alerta roja.
    // ══════════════════════════════════════════════════════════════════
    private function medicionesRamon(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);

        $controles = [
            [0,  3.3,  49.9],
            [1,  9.6,  75.4],
            [2, 12.2,  86.8],
            [3, 14.3,  98.0],
            [4, 16.3, 107.4],
            [5, 18.3, 115.6],
            [6, 20.5, 122.2],
            [7, 22.8, 128.7],
            [8, 25.2, 134.6],
            [9, 27.7, 140.2],
            [10,30.8, 145.0],
            [11,33.5, 147.5],  // solo 2.5 cm/año → alerta velocidad baja
        ];

        $this->insertar($persona->id, $nac, $controles, modo: 'anios');
    }

        private function medicionesValentina(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);
        $controles = [
            [0, 2.8, 47.0],
            [1, 3.8, 52.0],
            [2, 4.9, 56.0],
            [4, 6.1, 62.0],
            [6, 7.0, 66.0],
        ];
        $this->insertar($persona->id, $nac, $controles, modo: 'meses');
    }

    private function medicionesTomas(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);
        $controles = [
            [0,  3.5, 51.0],
            [2,  5.8, 58.5],
            [4,  7.0, 63.5],
            [6,  8.0, 67.5],
            [9,  9.2, 72.5],
            [12, 10.2, 76.0],
            [15, 11.0, 79.5],
        ];
        $this->insertar($persona->id, $nac, $controles, modo: 'meses');
    }

    private function medicionesLuciana(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);
        $controles = [
            [0,  2.4, 45.0],
            [2,  4.2, 54.0],
            [4,  5.5, 60.0],
            [6,  6.5, 65.0],
            [9,  7.8, 70.0],
            [12, 8.7, 74.5],
            [18, 10.2, 80.5],
            [24, 11.5, 86.0],
            [30, 12.8, 91.0],
        ];
        $this->insertar($persona->id, $nac, $controles, modo: 'meses');
    }

    private function medicionesAgustin(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);
        $controles = [
            [0,  4.2, 53.0],
            [3,  7.2, 63.0],
            [6,  8.8, 69.0],
            [12, 10.8, 77.5],
            [18, 12.2, 83.5],
            [24, 13.7, 89.0],
            [36, 15.5, 97.0],
            [48, 17.3, 104.0],
        ];
        $this->insertar($persona->id, $nac, $controles, modo: 'meses');
    }

    private function medicionesCamila(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);
        $controles = [
            [0,  3.1, 49.0],
            [6,  7.5, 66.5],
            [12, 9.5, 75.0],
            [24, 12.0, 87.0],
            [36, 14.2, 95.5],
            [48, 16.3, 103.0],
            [60, 18.4, 110.0],
            [66, 19.3, 113.0],
        ];
        $this->insertar($persona->id, $nac, $controles, modo: 'meses');
    }

    private function medicionesMateo(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);
        $controles = [
            [0,  3.6, 51.0],
            [1,  9.8, 76.0],
            [2, 12.5, 88.0],
            [3, 15.2, 97.0],
            [4, 17.5, 104.0],
            [5, 19.8, 111.0],
            [6, 22.0, 118.5],
            [7, 24.5, 124.5],
            [8, 27.2, 130.5],
        ];
        $this->insertar($persona->id, $nac, $controles, modo: 'anios');
    }

    private function medicionesIsabella(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);
        $controles = [
            [0,  2.7,  46.0],
            [1,  8.5,  73.0],
            [2, 11.0,  84.5],
            [3, 13.2,  93.0],
            [4, 15.5, 101.0],
            [5, 17.8, 108.5],
            [6, 20.5, 116.0],
            [7, 23.0, 122.5],
            [8, 26.0, 128.5],
            [9, 29.5, 134.0],
            [10, 33.0, 140.0],
        ];
        $this->insertar($persona->id, $nac, $controles, modo: 'anios');
    }

    private function medicionesSantiago(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);
        $controles = [
            [0,  4.1,  53.0],
            [1, 11.0,  77.0],
            [2, 13.8,  89.0],
            [3, 16.2,  97.5],
            [4, 18.8, 105.0],
            [5, 21.5, 112.5],
            [6, 24.5, 119.5],
            [7, 27.5, 126.5],
            [8, 31.0, 133.0],
            [9, 35.0, 139.5],
            [10, 40.0, 146.0],
            [11, 46.0, 153.0],
            [12, 52.0, 159.0],
        ];
        $this->insertar($persona->id, $nac, $controles, modo: 'anios');
    }

    private function medicionesFlorencia(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);
        $controles = [
            [0,  3.3,  50.0],
            [1,  9.5,  75.5],
            [2, 12.1,  87.5],
            [3, 14.5,  96.5],
            [4, 16.8, 104.0],
            [5, 19.2, 111.5],
            [6, 21.8, 118.5],
            [7, 24.5, 124.5],
            [8, 27.5, 130.5],
            [9, 31.0, 136.0],
            [10, 35.5, 141.5],
            [11, 41.0, 147.0],
            [12, 46.5, 153.5],
            [13, 50.5, 158.0],
            [14, 53.0, 161.0],
            [15, 54.5, 162.5],
            [16, 55.5, 163.0],
        ];
        $this->insertar($persona->id, $nac, $controles, modo: 'anios');
    }

    private function medicionesBenjamin(Persona $persona): void
    {
        $nac = Carbon::parse($persona->fecha_nacimiento);
        $controles = [
            [0, 3.2, 50.0],
        ];
        $this->insertar($persona->id, $nac, $controles, modo: 'meses');
    }

    // ══════════════════════════════════════════════════════════════════
    //  Helper genérico de inserción
    // ══════════════════════════════════════════════════════════════════
    /**
     * @param int    $personaId
     * @param Carbon $nacimiento
     * @param array  $controles  [[offset, peso, talla], ...]
     * @param string $modo       'meses' | 'anios'
     */
    private function insertar(int $personaId, Carbon $nacimiento, array $controles, string $modo): void
    {
        $rows = [];

        foreach ($controles as [$offset, $peso, $talla]) {
            $fecha = $modo === 'meses'
                ? $nacimiento->copy()->addMonths($offset)
                : $nacimiento->copy()->addYears($offset);

            if ($fecha->isFuture()) continue;

            $rows[] = [
                'persona_id'     => $personaId,
                'fecha'          => $fecha->toDateString(),
                'peso'           => $peso,
                'talla'          => $talla,
                'created_by'     => $this->usuarioId,
                'modified_by'    => $this->usuarioId,
                'borrado_logico' => false,
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        if ($rows) {
            DB::table('mediciones_antropometricas')->insertOrIgnore($rows);
        }
    }
}