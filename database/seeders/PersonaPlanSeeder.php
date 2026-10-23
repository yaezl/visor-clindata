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
 * Asigna una obra social (vía plan) a cada paciente de prueba.
 * El flag es_cronico ya viene seteado desde PersonaSeeder.
 *
 * Distribución:
 *   OSDE           → Juan Pérez, Sofía Martínez, Valentina Torres, Mateo Herrera
 *   PAMI           → Ramón Díaz, Florencia Núñez, Benjamín Castro
 *   IOMA           → María Gómez, Agustín López, Isabella Morales
 *   Swiss Medical  → Carlos Gómez, Tomás Ríos, Santiago Vega
 *   Particular     → Luciana Fernández, Camila Sánchez
 *
 * Depende de: PersonaSeeder, ObraSocialSeeder.
 */
class PersonaPlanSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // ── FKs obligatorias de persona_plan ─────────────────────────────
        $titular           = TipoBeneficiario::where('nombre', 'Titular')->firstOrFail();
        $parentescoTitular = TipoParentesco::where('nombre', 'Titular')->firstOrFail();

        // ── Planes por defecto de cada obra social ────────────────────────
        $planOsde       = ObraSocial::where('nombre', 'OSDE')->firstOrFail()
                              ->plans()->where('es_por_defecto', true)->firstOrFail();
        $planPami       = ObraSocial::where('nombre', 'PAMI')->firstOrFail()
                              ->plans()->where('es_por_defecto', true)->firstOrFail();
        $planIoma       = ObraSocial::where('nombre', 'IOMA')->firstOrFail()
                              ->plans()->where('es_por_defecto', true)->firstOrFail();
        $planSwiss      = ObraSocial::where('nombre', 'Swiss Medical')->firstOrFail()
                              ->plans()->where('es_por_defecto', true)->firstOrFail();
        $planParticular = ObraSocial::where('nombre', 'Particular')->firstOrFail()
                              ->plans()->where('es_por_defecto', true)->firstOrFail();

        // ── Mapa: documento → plan ────────────────────────────────────────
        $asignaciones = [
            '12345678' => $planOsde,        // Juan Pérez
            '41555666' => $planOsde,        // Sofía Martínez
            '55100001' => $planOsde,        // Valentina Torres
            '55100006' => $planOsde,        // Mateo Herrera

            '20444555' => $planPami,        // Ramón Díaz
            '55100009' => $planPami,        // Florencia Núñez
            '55100010' => $planPami,        // Benjamín Castro

            '87654321' => $planIoma,        // María Gómez
            '55100004' => $planIoma,        // Agustín López
            '55100007' => $planIoma,        // Isabella Morales

            '67245356' => $planSwiss,       // Carlos Gómez
            '55100002' => $planSwiss,       // Tomás Ríos
            '55100008' => $planSwiss,       // Santiago Vega

            '55100003' => $planParticular,  // Luciana Fernández
            '55100005' => $planParticular,  // Camila Sánchez
        ];

        foreach ($asignaciones as $documento => $plan) {
            $persona = Persona::where('documento', $documento)->first();

            if (!$persona) {
                continue; // paciente no existe en este entorno, saltar
            }

            PersonaPlan::firstOrCreate(
                [
                    'persona_id' => $persona->id,
                    'plan_id'    => $plan->id,
                ],
                [
                    'tipo_beneficiario_id' => $titular->id,
                    'tipo_parentesco_id'   => $parentescoTitular->id,
                    'borrado_logico'       => false,
                    'created_by'           => 1,
                    'modified_by'          => 1,
                ]
            );
        }

        Schema::enableForeignKeyConstraints();
    }
}