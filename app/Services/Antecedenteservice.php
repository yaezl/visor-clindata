<?php

namespace App\Services;

use App\Models\Persona;
use Illuminate\Support\Collection;

/**
 * Arma los datos del tab "Antecedentes" del paciente
 * (patients/partials/antecedentes-expandable.blade.php).
 *
 * Igual que PatientSummaryService, no usa IA: toma lo que ya está
 * cargado en Antecedenteperinatal y Antecedentepatologico y lo deja
 * listo para la vista. Refleja la misma estructura que usa el
 * hospital en su historia clínica impresa: primero antecedentes
 * perinatales (cómo fue el nacimiento), después antecedentes
 * patológicos (qué le pasó antes y cómo fue, vía el texto libre de
 * 'comentario').
 */
class AntecedenteService
{
    public function antecedentesDe(Persona $persona): array
    {
        return [
            'perinatal' => $this->perinatal($persona),
            'patologicos' => $this->patologicos($persona),
        ];
    }

    /**
     * El hospital carga un antecedente perinatal por paciente (no una
     * lista): tomamos el más reciente si por algún motivo hubiera más
     * de uno cargado.
     */
    protected function perinatal(Persona $persona): ?array
    {
        $antecedente = $persona->antecedenteperinatals->first();

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
}