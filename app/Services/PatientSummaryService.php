<?php

namespace App\Services;

use App\Models\Persona;
use Illuminate\Support\Collection;

class PatientSummaryService
{
    /** Cantidad máxima de diagnósticos que se listan en el bloque "más frecuentes". */
    protected const MAX_DIAGNOSTICOS_LISTADOS = 5;

    public function resumenDe(Persona $persona): array
    {
        $eventos = $this->eventosConConsulta($persona);
        $diagnosticos = $this->diagnosticosDelPaciente($eventos);

        return [
            'diagnosticos_frecuentes' => $this->diagnosticosFrecuentes($diagnosticos),
            'patron_categoria' => $this->detectarPatron($diagnosticos, $eventos->count()),
            'ultima_consulta' => $this->ultimaConsultaResumen($eventos),
            'medicacion_activa' => $this->medicacionActiva($persona),
            'cantidad_consultas' => $eventos->count(),
        ];
    }

    /**
     * Eventos de historia clínica del paciente que tienen al menos una
     * consulta, del más reciente al más antiguo.
     *
     * @return Collection<int, \App\Models\Eventohc>
     */
    protected function eventosConConsulta(Persona $persona): Collection
    {
        $persona->loadMissing([
            'eventohcs.consulta.personal.persona',
            'eventohcs.consulta.consultadetalles.diagnostico_detalles.diagnostico',
        ]);

        return $persona->eventohcs
            ->filter(fn ($evento) => $evento->fechahora && $evento->consulta->isNotEmpty())
            ->sortByDesc(fn ($evento) => $evento->fechahora->getTimestamp())
            ->values();
    }

    /**
     * Un registro por cada diagnóstico cargado en la historia, con el id
     * y la fecha del evento (consulta) al que pertenece. El evento_id
     * permite contar consultas reales y no diagnósticos sueltos.
     *
     * @return Collection<int, object{
     *   evento_id: int,
     *   diagnostico_id: int,
     *   nombre: string,
     *   categoria: string|null,
     *   fecha: \Carbon\Carbon
     * }>
     */
    protected function diagnosticosDelPaciente(Collection $eventos): Collection
    {
        $filas = collect();

        foreach ($eventos as $evento) {
            foreach ($evento->consulta as $consulta) {
                foreach ($consulta->consultadetalles as $detalle) {
                    foreach ($detalle->diagnostico_detalles as $diagnosticoDetalle) {
                        $diagnostico = $diagnosticoDetalle->diagnostico;

                        if (!$diagnostico) {
                            continue;
                        }

                        $filas->push((object) [
                            'evento_id' => $evento->id,
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
     * Agrupa por diagnóstico y cuenta en cuántas consultas distintas
     * apareció (si un diagnóstico se repite dentro de la misma consulta,
     * cuenta una sola vez). Ordenado de más a menos frecuente.
     *
     * @return Collection<int, array{nombre: string, cantidad: int}>
     */
    protected function diagnosticosFrecuentes(Collection $diagnosticos): Collection
    {
        return $diagnosticos
            ->groupBy('nombre')
            ->map(fn (Collection $grupo) => [
                'nombre' => $grupo->first()->nombre,
                'cantidad' => $grupo->unique('evento_id')->count(),
            ])
            ->sortByDesc('cantidad')
            ->values()
            ->take(self::MAX_DIAGNOSTICOS_LISTADOS);
    }

    /**
     * Detecta consultas recurrentes por categoría clínica usando solo los
     * datos reales del paciente:
     *
     *  - Cuenta CONSULTAS reales por categoría (una consulta con dos
     *    diagnósticos de la misma categoría cuenta una vez).
     *  - Calcula el intervalo entre consultas consecutivas a partir de la
     *    fecha de cada una, y de ahí el promedio.
     *  - No hay ventana de meses ni mínimo arbitrario: se necesitan al
     *    menos 2 consultas de la categoría porque con una sola no existe
     *    intervalo que medir.
     *
     * Si hay varias categorías con recurrencia se informa la de más
     * consultas y, en empate, la de consulta más reciente.
     *
     * @return array{
     *   categoria: string,
     *   cantidad: int,
     *   total_consultas: int,
     *   primera_fecha: \Carbon\Carbon,
     *   ultima_fecha: \Carbon\Carbon,
     *   intervalo_dias: int,
     *   intervalo_texto: string,
     *   dias_desde_ultima: int,
     * }|null
     */
    protected function detectarPatron(Collection $diagnosticos, int $totalConsultas): ?array
    {
        $candidatos = $diagnosticos
            ->filter(fn ($d) => filled($d->categoria) && $d->fecha)
            ->groupBy('categoria')
            ->map(function (Collection $grupo, $categoria) {
                $fechas = $grupo
                    ->unique('evento_id')
                    ->pluck('fecha')
                    ->sortBy(fn ($fecha) => $fecha->getTimestamp())
                    ->values();

                return [
                    'categoria' => (string) $categoria,
                    'fechas' => $fechas,
                    'cantidad' => $fechas->count(),
                    'ultima_ts' => $fechas->last()->getTimestamp(),
                ];
            })
            ->filter(fn ($candidato) => $candidato['cantidad'] >= 2);

        if ($candidatos->isEmpty()) {
            return null;
        }

        $elegido = $candidatos
            ->sort(fn ($a, $b) => [$b['cantidad'], $b['ultima_ts']] <=> [$a['cantidad'], $a['ultima_ts']])
            ->first();

        $fechas = $elegido['fechas'];
        $primera = $fechas->first();
        $ultima = $fechas->last();

        // Días entre cada consulta y la siguiente, según sus fechas reales.
        $intervalos = collect();
        for ($i = 1; $i < $fechas->count(); $i++) {
            $intervalos->push(abs(
                $fechas[$i - 1]->copy()->startOfDay()->diffInDays($fechas[$i]->copy()->startOfDay())
            ));
        }

        $intervaloDias = (int) round($intervalos->avg());

        return [
            'categoria' => $elegido['categoria'],
            'cantidad' => $elegido['cantidad'],
            'total_consultas' => $totalConsultas,
            'primera_fecha' => $primera,
            'ultima_fecha' => $ultima,
            'intervalo_dias' => $intervaloDias,
            'intervalo_texto' => $this->intervaloTexto($intervaloDias),
            'dias_desde_ultima' => (int) abs($ultima->copy()->startOfDay()->diffInDays(now()->startOfDay())),
        ];
    }

    /**
     * Expresa un intervalo en días ("12 días") o, desde los 60 días, en
     * meses ("2,5 meses") para que se lea natural.
     */
    protected function intervaloTexto(int $dias): string
    {
        if ($dias < 1) {
            return 'menos de un día';
        }

        if ($dias < 60) {
            return $dias . ($dias === 1 ? ' día' : ' días');
        }

        $meses = round($dias / 30.4375, 1);
        $texto = rtrim(rtrim(number_format($meses, 1, ',', ''), '0'), ',');

        return $texto . ($texto === '1' ? ' mes' : ' meses');
    }

    protected function ultimaConsultaResumen(Collection $eventos): ?array
    {
        $evento = $eventos->first();

        if (!$evento) {
            return null;
        }

        $consulta = $evento->consulta
            ->sortByDesc(fn ($c) => $c->fechahorainicio?->getTimestamp() ?? 0)
            ->first();
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
     * Medicación vigente (activa y no dada de baja), con nombre, dosis y
     * fecha de inicio. Usa la relación ya cargada por PersonaService, por
     * lo que no hace otra consulta; igual filtra por si llegara sin
     * filtrar.
     *
     * @return Collection<int, array{
     *   nombre: string,
     *   dosis: string|null,
     *   fecha_inicio: \Carbon\Carbon|null,
     * }>
     */
    protected function medicacionActiva(Persona $persona): Collection
    {
        return $persona->medicaciones
            ->filter(fn ($medicacion) => $medicacion->activa && !$medicacion->borrado_logico)
            ->map(fn ($medicacion) => [
                'nombre' => $medicacion->nombre,
                'dosis' => $medicacion->dosis,
                'fecha_inicio' => $medicacion->fecha_inicio,
            ])
            ->values();
    }
}