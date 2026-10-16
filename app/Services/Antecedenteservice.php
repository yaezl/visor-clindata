<?php

namespace App\Services;

use App\Models\Persona;
use Illuminate\Support\Collection;

/**
 * Arma los datos del tab "Antecedentes" del paciente
 * (patients/partials/antecedentes-expandable.blade.php).
 */
class AntecedenteService
{
    public function antecedentesDe(Persona $persona): array
    {
        return [
            'perinatal' => $this->perinatal($persona),
            'patologicos' => $this->patologicos($persona),
            'quirurgicos' => $this->quirurgicos($persona),
        ];
    }

    /**
     * El hospital carga un antecedente perinatal por paciente (no una
     * lista): tomamos el más reciente si por algún motivo hubiera más
     * de uno cargado.
     */
    protected function perinatal(Persona $persona): ?array
    {
        $antecedente = $persona->antecedenteperinatals
            ->sortByDesc(fn ($a) => $a->creado_en?->getTimestamp() ?? 0)
            ->first();

        if (!$antecedente) {
            return null;
        }

        return [
            'tipo_parto' => $antecedente->tipo_parto,
            'edad_gestacional' => $antecedente->edad_gestacional,
            'peso_al_nacer' => $antecedente->peso_al_nacer,
            'talla' => $antecedente->talla,
            'perimetro_cefalico' => $antecedente->perimetro_cefalico,
            'apgar_1' => $antecedente->apgar_1,
            'apgar_5' => $antecedente->apgar_5,
            'con_patologia' => (bool) $antecedente->con_patologia,
            'reanimacion' => (bool) $antecedente->reanimacion,
            'comentario' => $antecedente->comentario,
            'diagnosticos' => $antecedente->antec_perinatal_diagnosticos
                ->pluck('diagnostico.nombre')
                ->filter()
                ->values(),
        ];
    }

    /**
     * Lista de antecedentes patológicos: nombre del diagnóstico +
     * el comentario del médico, que es donde se cuenta cómo empezó
     * o se manejó esa patología (sin inventar un campo nuevo para eso).
     *
     * @return Collection<int, array{nombre: string, comentario: string|null}>
     */
    protected function patologicos(Persona $persona): Collection
    {
        return $persona->antecedentepatologicos
            ->filter(fn ($antecedente) => $antecedente->diagnostico !== null)
            ->map(fn ($antecedente) => [
                'nombre' => $antecedente->diagnostico->nombre,
                'comentario' => $antecedente->comentario,
            ])
            ->values();
    }

    /**
     * Lista de antecedentes quirúrgicos, de la cirugía más reciente a la
     * más antigua (las que no tienen fecha cargada van al final).
     *
     * El nombre sale del catálogo de estudios (Estudio.nombre). Si el
     * registro no tiene estudio asociado, se usa como título el primer
     * renglón del comentario para que la cirugía no quede sin nombre.
     *
     * @return Collection<int, array{
     *   nombre: string,
     *   fecha: \Carbon\Carbon|null,
     *   comentario: string|null,
     * }>
     */
    protected function quirurgicos(Persona $persona): Collection
    {
        return $persona->antecedentequirurgicos
            ->map(function ($antecedente) {
                $comentario = filled($antecedente->comentario) ? trim($antecedente->comentario) : null;
                $nombre = $antecedente->estudio?->nombre;

                if (!$nombre) {
                    if ($comentario) {
                        // Primer renglón como título; el resto sigue siendo el comentario.
                        $lineas = preg_split('/\r\n|\r|\n/', $comentario);
                        $nombre = array_shift($lineas);
                        $comentario = trim(implode("\n", $lineas)) ?: null;
                    } else {
                        $nombre = 'Cirugía sin especificar';
                    }
                }

                return [
                    'nombre' => $nombre,
                    'fecha' => $antecedente->fecha_cirugia,
                    'comentario' => $comentario,
                ];
            })
            ->sortByDesc(fn ($item) => $item['fecha']?->getTimestamp() ?? PHP_INT_MIN)
            ->values();
    }
}