<?php

namespace App\Services;

use App\Models\Persona;
use App\Models\PediatriaPercentil;
use App\Models\PediatriaParametro;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * CrecimientoService
 * ------------------
 * Calcula el panel de "Control de crecimiento" para un paciente.
 *
 * Devuelve un array con:
 *   - sin_datos        bool
 *   - es_pediatrico    bool   (< 19 años)
 *   - edad_anios       int
 *   - edad_meses_total int    (para lookup de percentiles OMS)
 *   - ultimo_control   array  { fecha, peso, talla, imc, perimetro_cefalico }
 *   - historico        Collection de mediciones ordenadas ASC (para gráfico)
 *   - percentiles      array  { peso, talla, imc } → cada uno: { p3,p15,p50,p85,p97, valor_paciente, percentil_estimado }
 *   - alertas          Collection de strings
 *   - proximo_control  Carbon|null
 *   - curvas_oms       array  { peso: [...], talla: [...], imc: [...] }  (puntos de referencia para el gráfico)
 */
class CrecimientoService
{
    // IDs convencionales en pediatria_parametro — ajustar si difieren en tu BD
    private const PARAM_PESO  = 1;
    private const PARAM_TALLA = 2;
    private const PARAM_IMC   = 3;

    public function calcularParaPaciente(Persona $persona): array
    {
        $fechaNac = $persona->fecha_nacimiento;

        // ── Sin fecha de nacimiento no podemos calcular nada ──────────────
        if (! $fechaNac) {
            return $this->sinDatos('Sin fecha de nacimiento registrada.');
        }

        $hoy           = Carbon::today();
        $edadAnios     = $fechaNac->diffInYears($hoy);
        $edadMeses     = (int) $fechaNac->diffInMonths($hoy);
        $esPediatrico  = $edadAnios < 19;

        // ── Mediciones del paciente (sin borrado lógico) ──────────────────
        $mediciones = $persona->mediciones_antropometricas()
            ->where('borrado_logico', false)
            ->whereNotNull('peso')
            ->whereNotNull('talla')
            ->orderBy('fecha')
            ->get();

        if ($mediciones->isEmpty()) {
            return array_merge($this->sinDatos('Sin mediciones registradas.'), [
                'es_pediatrico'   => $esPediatrico,
                'edad_anios'      => $edadAnios,
            ]);
        }

        // ── Última medición ───────────────────────────────────────────────
        /** @var \App\Models\MedicionesAntropometrica $ultima */
        $ultima = $mediciones->last();

        $peso  = round((float) $ultima->peso, 1);
        $talla = round((float) $ultima->talla, 1);   // Se asume en cm
        $imc   = $talla > 0 ? round($peso / (($talla / 100) ** 2), 1) : null;

        // ── Percentiles OMS ───────────────────────────────────────────────
        $sexo       = strtoupper($persona->sexo ?? 'M');   // 'M' o 'F'
        $percentiles = [];

        if ($esPediatrico) {
            $percentiles = $this->calcularPercentiles($edadMeses, $sexo, $peso, $talla, $imc);
        }

        // ── Curvas OMS para el gráfico (rango ± 3 años alrededor de la edad actual) ──
        $curvasOms = $esPediatrico
            ? $this->curvasOmsPara($edadMeses, $sexo)
            : [];

        // ── Histórico para el gráfico ─────────────────────────────────────
        $historico = $mediciones->map(fn($m) => [
            'fecha'  => Carbon::parse($m->fecha)->format('d/m/Y'),
            'fecha_iso' => Carbon::parse($m->fecha)->toDateString(),
            'edad_meses' => (int) $fechaNac->diffInMonths(Carbon::parse($m->fecha)),
            'peso'   => round((float) $m->peso, 1),
            'talla'  => round((float) $m->talla, 1),
            'imc'    => $m->talla > 0
                ? round($m->peso / (($m->talla / 100) ** 2), 1)
                : null,
        ]);

        // ── Alertas ───────────────────────────────────────────────────────
        $alertas = $this->generarAlertas($mediciones, $ultima, $percentiles);

        // ── Próximo control sugerido ──────────────────────────────────────
        $proximoControl = $this->proximoControl($edadAnios, Carbon::parse($ultima->fecha));

        // ── Formateo de datos para próximo control ──────────────────────────────────────
        $hoy = Carbon::today();

        $diff = $hoy->diff($proximoControl);

        $partes = [];

        if ($diff->y > 0) {
            $partes[] = $diff->y . ' ' . ($diff->y === 1 ? 'año' : 'años');
        }

        if ($diff->m > 0) {
            $partes[] = $diff->m . ' ' . ($diff->m === 1 ? 'mes' : 'meses');
        }

        if ($diff->d > 0) {
            $partes[] = $diff->d . ' ' . ($diff->d === 1 ? 'día' : 'días');
        }

        $tiempoRestante = implode(' y ', $partes);

        return [
            'sin_datos'        => false,
            'es_pediatrico'    => $esPediatrico,
            'edad_anios'       => $edadAnios,
            'edad_meses_total' => $edadMeses,
            'ultimo_control'   => [
                'fecha'              => Carbon::parse($ultima->fecha)->format('d/m/Y'),
                'peso'               => $peso,
                'talla'              => $talla,
                'imc'                => $imc,
                'perimetro_cefalico' => null,  // No está en mediciones_antropometricas; agregar si se suma el campo
            ],
            'historico'        => $historico,
            'percentiles'      => $percentiles,
            'alertas'          => $alertas,
            'proximo_control'  => $proximoControl,
            'tiempo_restante' => $tiempoRestante,
            'curvas_oms'       => $curvasOms,
        ];
    }

    // ──────────────────────────────────────────────────────────────────────
    // Métodos privados
    // ──────────────────────────────────────────────────────────────────────

    private function sinDatos(string $motivo = ''): array
    {
        return [
            'sin_datos'        => true,
            'motivo'           => $motivo,
            'es_pediatrico'    => false,
            'edad_anios'       => null,
            'edad_meses_total' => null,
            'ultimo_control'   => null,
            'historico'        => collect(),
            'percentiles'      => [],
            'alertas'          => collect(),
            'proximo_control'  => null,
            'curvas_oms'       => [],
        ];
    }

    /**
     * Calcula el percentil estimado interpolando en la tabla OMS.
     */
    private function calcularPercentiles(int $edadMeses, string $sexo, float $peso, float $talla, ?float $imc): array
    {
        $result = [];

        $paramMap = [
            'peso'  => self::PARAM_PESO,
            'talla' => self::PARAM_TALLA,
            'imc'   => self::PARAM_IMC,
        ];

        $valores = [
            'peso'  => $peso,
            'talla' => $talla,
            'imc'   => $imc,
        ];

        foreach ($paramMap as $clave => $paramId) {
            $fila = PediatriaPercentil::where('pediatria_parametro_id', $paramId)
                ->where('sexo', $sexo)
                ->where('mes', $edadMeses)
                ->first();

            // Si no hay fila exacta, buscar la más cercana
            if (! $fila) {
                $fila = PediatriaPercentil::where('pediatria_parametro_id', $paramId)
                    ->where('sexo', $sexo)
                    ->orderByRaw('ABS(mes - ?)', [$edadMeses])
                    ->first();
            }

            if (! $fila || $valores[$clave] === null) {
                $result[$clave] = null;
                continue;
            }

            $result[$clave] = [
                'p3'                => (float) $fila->p3,
                'p15'               => (float) $fila->p15,
                'p50'               => (float) $fila->p50,
                'p85'               => (float) $fila->p85,
                'p97'               => (float) $fila->p97,
                'valor_paciente'    => $valores[$clave],
                'percentil_estimado' => $this->estimarPercentil($valores[$clave], $fila),
            ];
        }

        return $result;
    }

    /**
     * Estima el percentil del paciente interpolando entre los valores OMS.
     */
    private function estimarPercentil(float $valor, PediatriaPercentil $fila): int
    {
        $curva = [
            3  => (float) $fila->p3,
            15 => (float) $fila->p15,
            50 => (float) $fila->p50,
            85 => (float) $fila->p85,
            97 => (float) $fila->p97,
        ];

        if ($valor <= $curva[3])  return 3;
        if ($valor >= $curva[97]) return 97;

        $pares = array_keys($curva);

        for ($i = 0; $i < count($pares) - 1; $i++) {
            $p1 = $pares[$i];
            $p2 = $pares[$i + 1];
            $v1 = $curva[$p1];
            $v2 = $curva[$p2];

            if ($valor >= $v1 && $valor <= $v2) {
                $ratio = ($valor - $v1) / ($v2 - $v1);
                return (int) round($p1 + $ratio * ($p2 - $p1));
            }
        }

        return 50;
    }

    /**
     * Carga las curvas OMS para el rango de edad del paciente (para el gráfico).
     * Devuelve puntos cada 6 meses en un rango de ±36 meses alrededor de la edad actual.
     */
    private function curvasOmsPara(int $edadMeses, string $sexo): array
    {
        $desde = max(0, $edadMeses - 36);
        $hasta = $edadMeses + 36;

        $paramMap = [
            'peso'  => self::PARAM_PESO,
            'talla' => self::PARAM_TALLA,
            'imc'   => self::PARAM_IMC,
        ];

        $curvas = [];

        foreach ($paramMap as $clave => $paramId) {
            $filas = PediatriaPercentil::where('pediatria_parametro_id', $paramId)
                ->where('sexo', $sexo)
                ->whereBetween('mes', [$desde, $hasta])
                ->orderBy('mes')
                ->get(['mes', 'p3', 'p15', 'p50', 'p85', 'p97']);

            $curvas[$clave] = $filas->map(fn($f) => [
                'mes' => $f->mes,
                'p3'  => (float) $f->p3,
                'p15' => (float) $f->p15,
                'p50' => (float) $f->p50,
                'p85' => (float) $f->p85,
                'p97' => (float) $f->p97,
            ])->values()->toArray();
        }

        return $curvas;
    }

    /**
     * Genera alertas clínicas básicas.
     */
    private function generarAlertas(Collection $mediciones, $ultima, array $percentiles): Collection
    {
        $alertas = collect();

        // Alerta: sin control reciente (> 6 meses)
        $fechaUltima = Carbon::parse($ultima->fecha);
        $mesesSinControl = (int) floor(
            $fechaUltima->diffInMonths(Carbon::today())
        );

        if ($mesesSinControl >= 6) {
            $alertas->push([
                'tipo'    => 'warning',
                'mensaje' => "No registra control de crecimiento desde hace {$mesesSinControl} meses.",
            ]);
        }

        // Alerta: velocidad de crecimiento (si hay al menos 2 mediciones)
        if ($mediciones->count() >= 2) {
            $anterior = $mediciones->slice(-2, 1)->first();
            $diff = round((float) $ultima->talla - (float) $anterior->talla, 1);
            $meses = max(1, (int) Carbon::parse($anterior->fecha)->diffInMonths($fechaUltima));
            $crec  = round($diff / $meses * 12, 1); // cm/año

            if ($crec >= 3 && $crec <= 10) {
                $alertas->push([
                    'tipo'    => 'success',
                    'mensaje' => 'La velocidad de crecimiento está dentro de los valores esperados.',
                ]);
            } elseif ($crec < 3) {
                $alertas->push([
                    'tipo'    => 'danger',
                    'mensaje' => 'La velocidad de crecimiento podría estar por debajo de lo esperado.',
                ]);
            }
        }

        // Alerta por percentil de peso o talla
        $sinAlertas = true;
        foreach (['peso', 'talla', 'imc'] as $param) {
            $p = $percentiles[$param] ?? null;
            if ($p && ($p['percentil_estimado'] < 3 || $p['percentil_estimado'] > 97)) {
                $alertas->push([
                    'tipo'    => 'danger',
                    'mensaje' => ucfirst($param) . " fuera de rango (Percentil {$p['percentil_estimado']}).",
                ]);
                $sinAlertas = false;
            }
        }

        if ($sinAlertas && $alertas->where('tipo', 'danger')->isEmpty()) {
            $alertas->push([
                'tipo'    => 'success',
                'mensaje' => 'Sin alertas de peso, talla o IMC.',
            ]);
        }

        return $alertas;
    }

    /**
     * Sugiere el próximo control según la edad del paciente.
     */
    private function proximoControl(int $edadAnios, Carbon $ultimoControl): Carbon
    {
        $meses = match (true) {
            $edadAnios < 1  => 2,
            $edadAnios < 2  => 3,
            $edadAnios < 6  => 6,
            default         => 12,
        };

        return $ultimoControl->copy()->addMonths($meses);
    }
}
