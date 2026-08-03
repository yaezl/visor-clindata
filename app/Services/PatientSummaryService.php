<?php

namespace App\Services;

use App\Models\Persona;
use Illuminate\Support\Collection;

/**
 * Arma los datos del Resumen del paciente (tab "Resumen" en
 * patients/detail.blade.php).
 *
 * A diferencia de la Historia Clínica (que lista consulta por consulta
 * en orden cronológico), este resumen muestra información AGREGADA:
 * qué diagnósticos se repiten, si hay un patrón de consultas por una
 * misma categoría clínica, la medicación activa del paciente, y los
 * datos más relevantes de un vistazo.
 *
 * No usa IA: todo sale de queries directas sobre datos ya cargados
 * (Eventohc -> Consulta -> Consultadetalle -> DiagnosticoDetalle -> Diagnostico
 * para lo clínico, y Medicacion para el tratamiento activo).
 */
class PatientSummaryService
{
    /**
     * Cantidad mínima de diagnósticos de una misma categoría, dentro de
     * la ventana de tiempo definida en $mesesVentanaPatron, para
     * considerar que hay un "patrón de consultas recurrentes".
     */
    protected const MINIMO_PARA_PATRON = 2;

    protected const MESES_VENTANA_PATRON = 6;

    public function resumenDe(Persona $persona): array
    {
        $diagnosticos = $this->diagnosticosDelPaciente($persona);

        return [
            'diagnosticos_frecuentes' => $this->diagnosticosFrecuentes($diagnosticos),
            'patron_categoria' => $this->detectarPatron($diagnosticos),
            'ultima_consulta' => $this->ultimaConsultaResumen($persona),
            'medicacion_activa' => $this->medicacionActiva($persona),
            'cantidad_consultas_totales' => $diagnosticos->count(),
        ];
    }

    /**
     * Trae, para este paciente, un registro por cada diagnóstico
     * cargado en su historia, con la fecha del evento al que pertenece.
     *
     * @return Collection<int, object{
     *   diagnostico_id: int,
     *   nombre: string,
     *   categoria: string|null,
     *   fecha: \Carbon\Carbon
     * }>
     */
    protected function diagnosticosDelPaciente(Persona $persona): Collection
    {
        $eventos = $persona->eventohcs()
            ->whereHas('consulta')
            ->with([
                'consulta.consultadetalles.diagnostico_detalles.diagnostico',
            ])
            ->orderByDesc('fechahora')
            ->get();

        $filas = collect();

        foreach ($eventos as $evento) {
            $consultas = $evento->consulta;

            foreach ($consultas as $consulta) {
                foreach ($consulta->consultadetalles as $detalle) {
                    foreach ($detalle->diagnostico_detalles as $diagnosticoDetalle) {
                        $diagnostico = $diagnosticoDetalle->diagnostico;

                        if (!$diagnostico) {
                            continue;
                        }

                        $filas->push((object) [
                            'diagnostico_id' => $diagnostico->id,
                            'nombre' => $diagnostico->nombre,
                            'categoria' => $diagnostico->categoria,
                            'fecha' => $evento->fechahora,
                        ]);
                    }
                }
            }
        }

        return $filas;
    }

    /**
     * Agrupa por diagnóstico y cuenta ocurrencias, ordenado de más a
     * menos frecuente. Es la sección "qué le pasa habitualmente a este
     * paciente", en vez de repetir la evolución cronológica completa.
     *
     * @return Collection<int, array{nombre: string, cantidad: int}>
     */
    protected function diagnosticosFrecuentes(Collection $diagnosticos): Collection
    {
        return $diagnosticos
            ->groupBy('nombre')
            ->map(fn (Collection $grupo) => [
                'nombre' => $grupo->first()->nombre,
                'cantidad' => $grupo->count(),
            ])
            ->sortByDesc('cantidad')
            ->values()
            ->take(5);
    }

    /**
     * Detecta si hay una categoría clínica (respiratorio, digestivo,
     * etc.) con varias consultas dentro de la ventana reciente definida
     * en MESES_VENTANA_PATRON. Es un dato neutro y calculado con una
     * regla simple (conteo), no una inferencia clínica compleja.
     */
    protected function detectarPatron(Collection $diagnosticos): ?array
    {
        $desde = now()->subMonths(self::MESES_VENTANA_PATRON);

        $categoriaMasFrecuente = $diagnosticos
            ->filter(fn ($d) => $d->categoria && $d->fecha && $d->fecha->greaterThanOrEqualTo($desde))
            ->groupBy('categoria')
            ->map(fn (Collection $grupo, $categoria) => [
                'categoria' => $categoria,
                'cantidad' => $grupo->count(),
            ])
            ->sortByDesc('cantidad')
            ->first();

        if (!$categoriaMasFrecuente || $categoriaMasFrecuente['cantidad'] < self::MINIMO_PARA_PATRON) {
            return null;
        }

        return [
            'categoria' => $categoriaMasFrecuente['categoria'],
            'etiqueta' => $this->etiquetaCategoria($categoriaMasFrecuente['categoria']),
            'cantidad' => $categoriaMasFrecuente['cantidad'],
            'meses' => self::MESES_VENTANA_PATRON,
        ];
    }

    protected function etiquetaCategoria(string $categoria): string
    {
        return match ($categoria) {
            'respiratorio' => 'consultas respiratorias',
            'digestivo' => 'consultas digestivas',
            'otorrinolaringologico' => 'consultas otorrinolaringológicas',
            'urinario' => 'consultas urinarias',
            'control' => 'controles clínicos',
            default => 'consultas de tipo "' . $categoria . '"',
        };
    }

    /**
     * Motivo y diagnóstico de la consulta más reciente, en formato
     * corto (no repite todo el detalle largo de Consultadetalle).
     */
    protected function ultimaConsultaResumen(Persona $persona): ?array
    {
        $evento = $persona->eventohcs()
            ->whereHas('consulta')
            ->with([
                'consulta.personal.persona',
                'consulta.consultadetalles.diagnostico_detalles.diagnostico',
            ])
            ->orderByDesc('fechahora')
            ->first();

        if (!$evento) {
            return null;
        }

        $consulta = $evento->consulta->first();
        $detalle = $consulta?->consultadetalles->first();
        $diagnostico = $detalle?->diagnostico_detalles->first()?->diagnostico;

        return [
            'fecha' => $evento->fechahora,
            'medico' => $consulta?->personal?->persona?->nombre_completo,
            'diagnostico' => $diagnostico?->nombre,
            'motivo' => $this->primerRenglon($detalle?->sintomas_signos),
        ];
    }

    /**
     * Toma solo el primer renglón de un texto libre multilínea (ej.
     * sintomas_signos), para mostrar un motivo corto en el resumen sin
     * repetir todo el detalle clínico completo.
     */
    protected function primerRenglon(?string $texto): ?string
    {
        if (!$texto) {
            return null;
        }

        $lineas = preg_split('/\r\n|\r|\n/', trim($texto));

        return $lineas[0] ?? null;
    }

    /**
     * Medicación que el paciente está tomando actualmente (activa = true),
     * con nombre, dosis y fecha de inicio. Pensado para que el médico
     * pueda preguntar directamente por el avance de ese tratamiento sin
     * tener que ir a buscarlo a otra pantalla.
     *
     * @return Collection<int, array{
     *   nombre: string,
     *   dosis: string|null,
     *   fecha_inicio: \Carbon\Carbon|null,
     * }>
     */
    protected function medicacionActiva(Persona $persona): Collection
    {
        return $persona->medicaciones()
            ->where('activa', true)
            ->get()
            ->map(fn ($medicacion) => [
                'nombre' => $medicacion->nombre,
                'dosis' => $medicacion->dosis,
                'fecha_inicio' => $medicacion->fecha_inicio,
            ])
            ->values();
    }
}