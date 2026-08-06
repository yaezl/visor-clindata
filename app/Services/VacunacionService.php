<?php

namespace App\Services;

use App\Models\Persona;
use Illuminate\Support\Collection;

/**
 * Motor de reglas del Calendario Nacional de Vacunación 2026 (Argentina).
 *
 * Dado un paciente, calcula:
 *   - qué vacunas DEBERÍAN estar ya aplicadas según su edad acumulada
 *   - qué vacunas corresponden aplicar en el año de vida actual
 *
 * No cruza con la base de datos — es puramente informativo.
 * La fecha de nacimiento es el único dato que necesita.
 *
 * ─── Diseño ────────────────────────────────────────────────────────────
 * El campo 'contexto' permite escalar a otras áreas sin tocar la vista:
 *   'general'      → se muestra en el visor pediátrico
 *   'embarazo'     → para obstetricia (VSR, dTpa, Antigripal embarazada)
 *   'grupo_riesgo' → Fiebre Amarilla, Fiebre Hemorrágica Argentina, etc.
 *
 * Fuente: Calendario Nacional de Vacunación 2026 — Ministerio de Salud
 * de la Nación Argentina — https://www.argentina.gob.ar/salud/vacunas
 * ───────────────────────────────────────────────────────────────────────
 */
class VacunacionService
{
    // ──────────────────────────────────────────────────────────────────
    // Punto de entrada principal
    // ──────────────────────────────────────────────────────────────────

    /**
     * Devuelve las vacunas organizadas en dos bloques para la vista:
     *
     *   'ya_aplicadas'    Collection — deberían estar aplicadas antes del año actual
     *   'este_anio'       Collection — corresponden aplicarse en el año de vida actual
     *   'edad_meses'      int|null
     *   'edad_anios'      int|null
     *   'sin_fecha_nac'   bool
     */
    public function calcularParaPaciente(Persona $persona): array
    {
        $edadMeses = $this->edadEnMeses($persona);
        $edadAnios = $edadMeses !== null ? intdiv($edadMeses, 12) : null;

        // Año de vida actual del paciente: el que está cursando ahora.
        // Ej: 5 años y 3 meses → año de vida actual = 5 (entre los 60 y 71 meses).
        $inicioAnoActual = $edadAnios !== null ? $edadAnios * 12 : null;
        $finAnoActual    = $inicioAnoActual !== null ? $inicioAnoActual + 11 : null;

        $yaAplicadas = collect();
        $esteAnio    = collect();

        foreach (self::calendario() as $vacuna) {
            if ($vacuna['contexto'] !== 'general') {
                continue;
            }

            // Si no hay fecha de nac, mostramos todo en "deberían estar aplicadas".
            if ($edadMeses === null) {
                $yaAplicadas->push($vacuna);
                continue;
            }

            // "Este año": la ventana de aplicación tiene superposición con el
            // año de vida que está cursando el paciente ahora.
            $estaEnEsteAnio = $inicioAnoActual !== null
                && $vacuna['hasta_meses'] >= $inicioAnoActual
                && $vacuna['desde_meses'] <= $finAnoActual;

            // "Ya debería estar aplicada": el rango terminó antes del año actual.
            $yaDeberia = $vacuna['hasta_meses'] < $inicioAnoActual;

            if ($estaEnEsteAnio) {
                $esteAnio->push($vacuna);
            } elseif ($yaDeberia) {
                $yaAplicadas->push($vacuna);
            }
            // Si 'desde_meses' > fin del año actual: vacuna futura, no se muestra.
        }

        return [
            'ya_aplicadas'  => $yaAplicadas,
            'este_anio'     => $esteAnio,
            'edad_meses'    => $edadMeses,
            'edad_anios'    => $edadAnios,
            'sin_fecha_nac' => $edadMeses === null,
        ];
    }

    // ──────────────────────────────────────────────────────────────────
    // Helpers
    // ──────────────────────────────────────────────────────────────────

    private function edadEnMeses(Persona $persona): ?int
    {
        if (! $persona->fecha_nacimiento) {
            return null;
        }
        return (int) $persona->fecha_nacimiento->diffInMonths(now());
    }

    // ──────────────────────────────────────────────────────────────────
    // Calendario Nacional de Vacunación 2026 (Argentina)
    // ──────────────────────────────────────────────────────────────────
    //
    // Campos:
    //   nombre        — nombre oficial según el calendario 2026
    //   dosis         — esquema resumido
    //   cuando        — texto de cuándo corresponde (para la vista)
    //   desde_meses   — inicio del rango etario en meses
    //   hasta_meses   — fin del rango etario en meses
    //   contexto      — 'general' | 'embarazo' | 'grupo_riesgo'
    //
    // NOTA sobre 'hasta_meses' en vacunas sin vencimiento etario:
    // Se usa 1199 (99 años en meses) como tope máximo convencional
    // para vacunas que aplican "desde X en adelante" sin límite superior.
    // Esto simplifica la lógica de comparación sin necesitar null checks.
    // ──────────────────────────────────────────────────────────────────
    private static function calendario(): array
    {
        return [

            // ── Recién nacido ──────────────────────────────────────────
            [
                'nombre'      => 'BCG',
                'dosis'       => '1 dosis',
                'cuando'      => 'Al nacer (antes del alta)',
                'desde_meses' => 0,
                'hasta_meses' => 1,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Hepatitis B',
                'dosis'       => '1 dosis',
                'cuando'      => 'Al nacer (primeras 12 hs)',
                'desde_meses' => 0,
                'hasta_meses' => 1,
                'contexto'    => 'general',
            ],

            // ── Hasta el año de vida ───────────────────────────────────
            [
                'nombre'      => 'Rotavirus',
                'dosis'       => '2 dosis',
                'cuando'      => '2 y 4 meses',
                'desde_meses' => 2,
                'hasta_meses' => 7,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Quíntuple',
                'dosis'       => '3 dosis',
                'cuando'      => '2, 4 y 6 meses',
                'desde_meses' => 2,
                'hasta_meses' => 7,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'IPV (Salk)',
                'dosis'       => '3 dosis',
                'cuando'      => '2, 4 y 6 meses',
                'desde_meses' => 2,
                'hasta_meses' => 7,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Neumococo Conjugada',
                'dosis'       => '3 dosis',
                'cuando'      => '2, 4 y 12 meses',
                'desde_meses' => 2,
                'hasta_meses' => 13,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Meningococo ACYW',
                'dosis'       => '2 dosis',
                'cuando'      => '3 y 5 meses',
                'desde_meses' => 3,
                'hasta_meses' => 6,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Antigripal',
                'dosis'       => '2 dosis al año. 1 dosis anual',
                'cuando'      => 'A partir de los 6 meses (campaña anual)',
                'desde_meses' => 6,
                'hasta_meses' => 23,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Triple Viral',
                'dosis'       => '1.ª dosis',
                'cuando'      => '12 meses',
                'desde_meses' => 12,
                'hasta_meses' => 14,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Hepatitis A',
                'dosis'       => '1 dosis',
                'cuando'      => '12 meses',
                'desde_meses' => 12,
                'hasta_meses' => 14,
                'contexto'    => 'general',
            ],

            // ── Hasta los 2 años ───────────────────────────────────────
            [
                'nombre'      => 'Meningococo ACYW',
                'dosis'       => 'Refuerzo',
                'cuando'      => '15 meses',
                'desde_meses' => 15,
                'hasta_meses' => 17,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Varicela',
                'dosis'       => '1.ª dosis',
                'cuando'      => '15 meses',
                'desde_meses' => 15,
                'hasta_meses' => 17,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Triple Viral',
                'dosis'       => '2.ª dosis',
                'cuando'      => '15–18 meses',
                'desde_meses' => 15,
                'hasta_meses' => 19,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Quíntuple',
                'dosis'       => 'Refuerzo',
                'cuando'      => '15–18 meses',
                'desde_meses' => 15,
                'hasta_meses' => 19,
                'contexto'    => 'general',
            ],

            // ── Nacidos en 2015 (catch-up, ~11 años en 2026) ──────────
            // No se incluyen como regla etaria continua: son cohortes
            // específicas de recupero que el médico verifica en Alephoo.

            // ── 5 años (ingreso escolar / nacidos en 2021) ─────────────
            [
                'nombre'      => 'IPV (Salk)',
                'dosis'       => 'Refuerzo',
                'cuando'      => 'Al cumplir 5 años',
                'desde_meses' => 60,
                'hasta_meses' => 71,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Varicela',
                'dosis'       => '2.ª dosis',
                'cuando'      => 'Al cumplir 5 años',
                'desde_meses' => 60,
                'hasta_meses' => 71,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Triple Viral',
                'dosis'       => '2.ª dosis (si no recibió a los 15-18 m)',
                'cuando'      => 'Al cumplir 5 años',
                'desde_meses' => 60,
                'hasta_meses' => 71,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Triple Bacteriana Celular',
                'dosis'       => '2.º refuerzo',
                'cuando'      => 'Al cumplir 5 años',
                'desde_meses' => 60,
                'hasta_meses' => 71,
                'contexto'    => 'general',
            ],

            // ── 11 años ────────────────────────────────────────────────
            [
                'nombre'      => 'Meningococo ACYW',
                'dosis'       => '1 dosis',
                'cuando'      => 'A los 11 años',
                'desde_meses' => 132,
                'hasta_meses' => 143,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Triple Bacteriana Acelular (dTpa)',
                'dosis'       => 'Refuerzo',
                'cuando'      => 'A los 11 años',
                'desde_meses' => 132,
                'hasta_meses' => 143,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'VPH',
                'dosis'       => '2 dosis',
                'cuando'      => 'A los 11 años',
                'desde_meses' => 132,
                'hasta_meses' => 143,
                'contexto'    => 'general',
            ],

            // ── 15 a 64 años ───────────────────────────────────────────
            [
                'nombre'      => 'Doble Bacteriana (dT)',
                'dosis'       => 'Refuerzo cada 10 años',
                'cuando'      => 'Desde los 15 años',
                'desde_meses' => 180,
                'hasta_meses' => 779,
                'contexto'    => 'general',
            ],

            // ── 65 años y más ──────────────────────────────────────────
            [
                'nombre'      => 'Antigripal',
                'dosis'       => '1 dosis anual',
                'cuando'      => 'Desde los 65 años (campaña anual)',
                'desde_meses' => 780,
                'hasta_meses' => 1199,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Neumococo Conjugada',
                'dosis'       => '1 dosis',
                'cuando'      => 'A los 65 años',
                'desde_meses' => 780,
                'hasta_meses' => 1199,
                'contexto'    => 'general',
            ],
            [
                'nombre'      => 'Doble Bacteriana (dT)',
                'dosis'       => 'Refuerzo cada 10 años',
                'cuando'      => 'Desde los 65 años',
                'desde_meses' => 780,
                'hasta_meses' => 1199,
                'contexto'    => 'general',
            ],

            // ── Embarazo (no se muestra en el visor pediátrico) ───────
            [
                'nombre'      => 'Antigripal',
                'dosis'       => '1 dosis',
                'cuando'      => 'Cualquier trimestre',
                'desde_meses' => 0,
                'hasta_meses' => 1199,
                'contexto'    => 'embarazo',
            ],
            [
                'nombre'      => 'Triple Bacteriana Acelular (dTpa)',
                'dosis'       => '1 dosis por embarazo',
                'cuando'      => 'A partir de la semana 20',
                'desde_meses' => 0,
                'hasta_meses' => 1199,
                'contexto'    => 'embarazo',
            ],
            [
                'nombre'      => 'Virus Sincicial Respiratorio (VSR)',
                'dosis'       => '1 dosis',
                'cuando'      => 'Semanas 32 a 36,6',
                'desde_meses' => 0,
                'hasta_meses' => 1199,
                'contexto'    => 'embarazo',
            ],

            // ── Zonas de riesgo (no se muestra en el visor pediátrico) ─
            [
                'nombre'      => 'Fiebre Amarilla',
                'dosis'       => '1 dosis',
                'cuando'      => 'Desde los 18 meses (residentes en zonas de riesgo)',
                'desde_meses' => 18,
                'hasta_meses' => 1199,
                'contexto'    => 'grupo_riesgo',
            ],
            [
                'nombre'      => 'Fiebre Hemorrágica Argentina',
                'dosis'       => '1 dosis',
                'cuando'      => 'A partir de los 15 años (residentes en zonas de riesgo)',
                'desde_meses' => 180,
                'hasta_meses' => 1199,
                'contexto'    => 'grupo_riesgo',
            ],

        ];
    }
}
