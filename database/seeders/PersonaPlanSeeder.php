<?php

namespace Database\Seeders;

use App\Models\ObraSocial;
use App\Models\Persona;
use App\Models\PersonaPlan;
use App\Models\TipoBeneficiario;
use App\Models\TipoParentesco;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Asigna cobertura a los 12 pacientes ficticios de demostración.
 * Todos son menores de edad: se registran como beneficiarios familiares
 * con parentesco Hijo/a. PAMI permanece en el catálogo, pero no se asigna
 * a estos pacientes pediátricos.
 */
class PersonaPlanSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $familiar = TipoBeneficiario::where('nombre', 'Familiar')->firstOrFail();
        $hijo = TipoParentesco::where('nombre', 'Hijo/a')->firstOrFail();

        $planes = [
            'OSDE' => ObraSocial::where('nombre', 'OSDE')->firstOrFail()
                ->plans()->where('es_por_defecto', true)->firstOrFail(),
            'Swiss Medical' => ObraSocial::where('nombre', 'Swiss Medical')->firstOrFail()
                ->plans()->where('es_por_defecto', true)->firstOrFail(),
            'IOMA' => ObraSocial::where('nombre', 'IOMA')->firstOrFail()
                ->plans()->where('es_por_defecto', true)->firstOrFail(),
            'Particular' => ObraSocial::where('nombre', 'Particular')->firstOrFail()
                ->plans()->where('es_por_defecto', true)->firstOrFail(),
        ];

        // Documento => obra social. Distribución de demostración.
        $asignaciones = [
            '12345678' => 'OSDE',           // Juan Pérez
            '87654321' => 'Swiss Medical',   // María Gómez
            '67245356' => 'IOMA',            // Carlos Gómez
            '41555666' => 'OSDE',            // Sofía Martínez
            '20444555' => 'Swiss Medical',   // Ramón Díaz
            '55100001' => 'OSDE',            // Valentina Torres
            '55100002' => 'IOMA',            // Tomás Ríos
            '55100003' => 'Particular',      // Luciana Fernández
            '55100004' => 'IOMA',            // Agustín López
            '55100005' => 'Particular',      // Camila Sánchez
            '55100006' => 'OSDE',            // Mateo Herrera
            '55100007' => 'Swiss Medical',   // Isabella Morales
        ];

        $personas = Persona::whereIn('documento', array_keys($asignaciones))->get()->keyBy('documento');

        // Desactivar asignaciones previas de estos pacientes (incluida PAMI)
        // antes de crear la cobertura de demostración actual.
        PersonaPlan::withTrashed()
            ->whereIn('persona_id', $personas->pluck('id'))
            ->update([
                'deleted_at' => now(),
                'deleted_by' => 1,
                'borrado_logico' => true,
            ]);

        foreach ($asignaciones as $documento => $obraSocial) {
            $persona = $personas->get($documento);
            if (!$persona) {
                continue;
            }

            PersonaPlan::create([
                'persona_id' => $persona->id,
                'plan_id' => $planes[$obraSocial]->id,
                'tipo_beneficiario_id' => $familiar->id,
                'tipo_parentesco_id' => $hijo->id,
                'nro_beneficiario' => 'DEMO-' . $documento,
                'borrado_logico' => false,
                'created_by' => 1,
                'modified_by' => 1,
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
