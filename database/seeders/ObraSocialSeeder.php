<?php

namespace Database\Seeders;

use App\Models\ObraSocial;
use App\Models\Plan;
use App\Models\TipoBeneficiario;
use App\Models\TipoParentesco;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Carga:
 *  - TipoBeneficiario  (titular / familiar)       ← FK obligatoria de persona_plan
 *  - TipoParentesco    (titular / hijo / cónyuge)  ← FK obligatoria de persona_plan
 *  - ObraSocial        (OSDE, PAMI, IOMA, Particular, SWISS Medical)
 *  - Plan              (uno o dos planes por obra social)
 *
 * PersonaPlanSeeder usa los IDs que crea este seeder, por lo que
 * ObraSocialSeeder debe ejecutarse antes que PersonaPlanSeeder.
 */
class ObraSocialSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // ── Tipos de beneficiario ─────────────────────────────────────────
        $titular  = TipoBeneficiario::firstOrCreate(
            ['nombre' => 'Titular'],
            ['created_by' => 1, 'modified_by' => 1]
        );
        TipoBeneficiario::firstOrCreate(
            ['nombre' => 'Familiar'],
            ['created_by' => 1, 'modified_by' => 1]
        );

        // ── Tipos de parentesco ───────────────────────────────────────────
        $parentescoTitular = TipoParentesco::firstOrCreate(
            ['nombre' => 'Titular'],
            ['created_by' => 1, 'modified_by' => 1]
        );
        TipoParentesco::firstOrCreate(
            ['nombre' => 'Hijo/a'],
            ['created_by' => 1, 'modified_by' => 1]
        );
        TipoParentesco::firstOrCreate(
            ['nombre' => 'Cónyuge'],
            ['created_by' => 1, 'modified_by' => 1]
        );

        // ── Obras sociales + planes ───────────────────────────────────────
        // Estructura: ['os' => [...campos OS...], 'planes' => [['nombre'=>...], ...]]
        $catalogo = [
            [
                'os' => [
                    'nombre'              => 'OSDE',
                    'denominacion'        => 'Obra Social de Empresas',
                    'nombre_en_factura'   => 'OSDE',
                    'cuit'                => '30-51455860-5',
                    'iva'                 => 'Responsable Inscripto',
                    'codigo_rnos'         => '010803',
                ],
                'planes' => [
                    ['nombre' => '210 - Básico',    'es_por_defecto' => true],
                    ['nombre' => '310 - Estándar',  'es_por_defecto' => false],
                    ['nombre' => '410 - Superador', 'es_por_defecto' => false],
                ],
            ],
            [
                'os' => [
                    'nombre'            => 'PAMI',
                    'denominacion'      => 'Prog. de Atención Médica Integral',
                    'nombre_en_factura' => 'PAMI',
                    'cuit'              => '30-52233583-5',
                    'iva'               => 'Exento',
                    'codigo_rnos'       => '500807',
                ],
                'planes' => [
                    ['nombre' => 'General', 'es_por_defecto' => true],
                ],
            ],
            [
                'os' => [
                    'nombre'            => 'IOMA',
                    'denominacion'      => 'Instituto Obra Médico Asistencial',
                    'nombre_en_factura' => 'IOMA',
                    'cuit'              => '30-53649810-4',
                    'iva'               => 'Exento',
                    'codigo_rnos'       => '601012',
                ],
                'planes' => [
                    ['nombre' => 'Activo',   'es_por_defecto' => true],
                    ['nombre' => 'Pasivo',   'es_por_defecto' => false],
                ],
            ],
            [
                'os' => [
                    'nombre'            => 'Swiss Medical',
                    'denominacion'      => 'Swiss Medical Group',
                    'nombre_en_factura' => 'Swiss Medical',
                    'cuit'              => '30-65745763-5',
                    'iva'               => 'Responsable Inscripto',
                    'codigo_rnos'       => '110100',
                ],
                'planes' => [
                    ['nombre' => 'SMG10',    'es_por_defecto' => true],
                    ['nombre' => 'SMG30',    'es_por_defecto' => false],
                ],
            ],
            [
                'os' => [
                    'nombre'            => 'Particular',
                    'denominacion'      => 'Pago Particular',
                    'nombre_en_factura' => 'Particular',
                    'cuit'              => '00-00000000-0',
                    'iva'               => 'Consumidor Final',
                    'codigo_rnos'       => '000000',
                ],
                'planes' => [
                    ['nombre' => 'Particular', 'es_por_defecto' => true, 'es_sin_cobertura' => true],
                ],
            ],
        ];

        $camposOsBase = [
            'telefono'              => '',
            'email'                 => '',
            'nombre_contacto'       => '',
            'email_contacto'        => '',
            'telefono_contacto'     => '',
            'fax_contacto'          => '',
            'oficina_contacto'      => '',
            'observaciones'         => '',
            'observacion_alerta_his'=> '',
            'codigoFacturaDoc'      => '',
            'codigoSiteds'          => '',
            'borrado_logico'        => false,
            'es_no_editable'        => false,
            'informa_vacunas'       => false,
            'requiereEspecialidad'  => false,
            'factura_simultaneo'    => false,
            'created_by'            => 1,
            'modified_by'           => 1,
        ];

        $camposPlanBase = [
            'borrado_logico'            => false,
            'es_sin_cobertura'          => false,
            'habilitado_autorizaciones' => false,
            'habilitado_autoseguros'    => false,
            'requiere_firma'            => false,
            'requiere_codigo_seguridad' => false,
            'observacion_alerta_his'    => '',
            'created_by'                => 1,
            'modified_by'               => 1,
        ];

        foreach ($catalogo as $entrada) {
            $osDatos = array_merge($camposOsBase, $entrada['os']);

            $os = ObraSocial::firstOrCreate(
                ['nombre' => $osDatos['nombre']],
                $osDatos
            );

            foreach ($entrada['planes'] as $planDatos) {
                Plan::firstOrCreate(
                    ['obra_social_id' => $os->id, 'nombre' => $planDatos['nombre']],
                    array_merge($camposPlanBase, $planDatos, ['obra_social_id' => $os->id])
                );
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}