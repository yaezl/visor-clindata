<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\GrupoSanguineo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PersonaSeeder extends Seeder
{
    /**
     * Los únicos 12 pacientes ficticios del entorno de demostración.
     * Los turnos y las historias clínicas usan esta misma lista.
     */
    public const DOCUMENTOS_PACIENTES_DEMO = [
        '12345678', '87654321', '67245356', '41555666',
        '20444555', '55100001', '55100002', '55100003',
        '55100004', '55100005', '55100006', '55100007',
    ];

    /** Pacientes de prueba retirados del escenario de demostración. */
    public const DOCUMENTOS_PACIENTES_EXCLUIDOS = [
        '55100008', // Santiago Vega
        '55100009', // Florencia Núñez
        '55100010', // Benjamín Castro
    ];

    /**
     * Documentos de las personas que son PERSONAL MÉDICO (no pacientes).
     * PersonalSeeder y ConsultumSeeder usan esta misma lista para no
     * duplicar el criterio en varios lugares.
     */
    public const DOCUMENTOS_MEDICOS = ['30111222', '30222333', '30333444'];

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Grupos sanguíneos de los pacientes de prueba: uno por paciente,
        // variados a propósito. Se resuelven por código contra el catálogo
        // real (GrupoSanguineoSeeder) en vez de hardcodear IDs.
        $gruposPorCodigo = GrupoSanguineo::whereIn('codigo', ['A+', 'O+', 'O-', 'B+', 'AB-'])
            ->get()
            ->keyBy('codigo');

        $grupoAPositivo = $gruposPorCodigo->get('A+') ?? GrupoSanguineo::firstOrCreate(
            ['codigo' => 'A+'],
            [
                'nombre'        => 'A Positivo',
                'creado_en'     => now(),
                'modificado_en' => now(),
                'borrado_logico' => 0,
            ]
        );

        // ── Pacientes de prueba ───────────────────────────────────────────
        // es_cronico distribuido a propósito entre los 12 pacientes de demostración
        // para que el filtro tenga resultados reales en ambas opciones.
        //
        // Crónicos: Sofía Martínez, Ramón Díaz, Mateo Herrera e Isabella Morales.
        $pacientes = [
            [
                'nombres'           => 'Juan',
                'apellidos'         => 'Pérez',
                'documento'         => '12345678',
                'sexo'              => 'M',
                'genero'            => 'M',
                'fecha_nacimiento'  => now()->subYears(3)->subMonths(2)->toDateString(),
                'grupo_sanguineo_id' => $gruposPorCodigo->get('O+')?->id ?? $grupoAPositivo->id,
                'es_cronico'        => 0,
            ],
            [
                'nombres'           => 'María',
                'apellidos'         => 'Gómez',
                'documento'         => '87654321',
                'sexo'              => 'F',
                'genero'            => 'F',
                'fecha_nacimiento'  => now()->subMonths(9)->toDateString(),
                'grupo_sanguineo_id' => $gruposPorCodigo->get('O-')?->id ?? $grupoAPositivo->id,
                'es_cronico'        => 0,
            ],
            [
                'nombres'           => 'Carlos',
                'apellidos'         => 'Gómez',
                'documento'         => '67245356',
                'sexo'              => 'M',
                'genero'            => 'M',
                'fecha_nacimiento'  => now()->subYears(2)->subMonths(1)->toDateString(),
                'nro_hc'            => 1432567,
                'grupo_sanguineo_id' => $grupoAPositivo->id,
                'contacto_celular_codigo' => 261,
                'contacto_celular_numero' => 567234,
                'es_cronico'        => 0,
            ],
            [
                'nombres'           => 'Sofía',
                'apellidos'         => 'Martínez',
                'documento'         => '41555666',
                'sexo'              => 'F',
                'genero'            => 'F',
                'fecha_nacimiento'  => now()->subYears(7)->subMonths(4)->toDateString(),
                'grupo_sanguineo_id' => $gruposPorCodigo->get('B+')?->id ?? $grupoAPositivo->id,
                'es_cronico'        => 1, // ← crónica
            ],
            [
                'nombres'           => 'Ramón',
                'apellidos'         => 'Díaz',
                'documento'         => '20444555',
                'sexo'              => 'M',
                'genero'            => 'M',
                'fecha_nacimiento'  => now()->subYears(11)->subMonths(6)->toDateString(),
                'grupo_sanguineo_id' => $gruposPorCodigo->get('AB-')?->id ?? $grupoAPositivo->id,
                'es_cronico'        => 1, // ← crónico
            ],
            [
                'nombres'           => 'Valentina',
                'apellidos'         => 'Torres',
                'documento'         => '55100001',
                'sexo'              => 'F',
                'genero'            => 'F',
                'fecha_nacimiento'  => '2026-03-10',
                'grupo_sanguineo_id' => $gruposPorCodigo->get('A+')?->id ?? $grupoAPositivo->id,
                'es_cronico'        => 0,
            ],
            [
                'nombres'           => 'Tomás',
                'apellidos'         => 'Ríos',
                'documento'         => '55100002',
                'sexo'              => 'M',
                'genero'            => 'M',
                'fecha_nacimiento'  => '2025-07-20',
                'grupo_sanguineo_id' => $gruposPorCodigo->get('B+')?->id ?? $grupoAPositivo->id,
                'es_cronico'        => 0,
            ],
            [
                'nombres'           => 'Luciana',
                'apellidos'         => 'Fernández',
                'documento'         => '55100003',
                'sexo'              => 'F',
                'genero'            => 'F',
                'fecha_nacimiento'  => '2024-04-01',
                'grupo_sanguineo_id' => $gruposPorCodigo->get('O-')?->id ?? $grupoAPositivo->id,
                'es_cronico'        => 0,
            ],
            [
                'nombres'           => 'Agustín',
                'apellidos'         => 'López',
                'documento'         => '55100004',
                'sexo'              => 'M',
                'genero'            => 'M',
                'fecha_nacimiento'  => '2022-09-15',
                'grupo_sanguineo_id' => $gruposPorCodigo->get('A+')?->id ?? $grupoAPositivo->id,
                'es_cronico'        => 0,
            ],
            [
                'nombres'           => 'Camila',
                'apellidos'         => 'Sánchez',
                'documento'         => '55100005',
                'sexo'              => 'F',
                'genero'            => 'F',
                'fecha_nacimiento'  => '2021-01-20',
                'grupo_sanguineo_id' => $gruposPorCodigo->get('AB-')?->id ?? $grupoAPositivo->id,
                'es_cronico'        => 0,
            ],
            [
                'nombres'           => 'Mateo',
                'apellidos'         => 'Herrera',
                'documento'         => '55100006',
                'sexo'              => 'M',
                'genero'            => 'M',
                'fecha_nacimiento'  => '2018-06-10',
                'grupo_sanguineo_id' => $gruposPorCodigo->get('O+')?->id ?? $grupoAPositivo->id,
                'es_cronico'        => 1, // asma/hiperreactividad bronquial
            ],
            [
                'nombres'           => 'Isabella',
                'apellidos'         => 'Morales',
                'documento'         => '55100007',
                'sexo'              => 'F',
                'genero'            => 'F',
                'fecha_nacimiento'  => '2016-03-22',
                'grupo_sanguineo_id' => $gruposPorCodigo->get('B+')?->id ?? $grupoAPositivo->id,
                'es_cronico'        => 1, // ← crónica
            ],
        ];

        // El personal médico (Laura, Martín, Valeria, Diego) se crea en
        // PersonalSeeder junto con su registro Personal correspondiente.
        // Acá NO se agregan de nuevo: si se cargaran también en Persona
        // sin su Personal asociado, whereDoesntHave('personal') del
        // listado de pacientes no los filtraría y aparecerían como
        // pacientes duplicados.

        foreach ($pacientes as $persona) {
            // Generamos un ID gigante al azar para evitar cualquier "Duplicate entry"
            $idFalso = rand(100000, 999999);

            $datosObligatorios = [
                'created_by'  => 1,
                'modified_by' => 1,
                'deleted_by'  => 0,

                // IDs únicos con el número al azar
                'direccion_id'            => $idFalso,
                'cuenta_id'               => $idFalso,
                'direccion_nacimiento_id' => $idFalso,
                'direccion_extranjera_id' => $idFalso,

                // IDs de catálogos compartidos
                'pais_id'            => 1,
                'estado_civil_id'    => 1,
                'tipo_documento_id'  => 1,
                'estado_id'          => 1,
                'genero_id'          => 1,
                'empleador_id'       => 1,
                'nivelinstruccion_id' => 1,
                'causa_hc_pasiva_id' => 1,
                'grupo_sanguineo_id' => 1,
                'condicion_iva'      => 1,
                'religion_id'        => 1,
                'grupoEtnico_id'     => 1,
                'pais_extranjero_id' => 1,
                'pais_nacimiento_id' => 1,

                // Textos
                'apellido_materno'          => '-',
                'nombre_alias'              => '-',
                'estado_msg'                => '-',
                'contacto_telefono_carrier' => '-',
                'observaciones'             => '-',
                'codigo_ad_hoc'             => '-',
                'contacto_celular_carrier'  => '-',
                'contacto_email_direccion'  => 'test' . $idFalso . '@clindata.com',
                'social_login'              => 0,

                // Numéricos
                'cuil'                      => $idFalso,
                'nro_hc'                    => $idFalso,
                'telefono_codigo'           => 0,
                'telefono_numero'           => 0,
                'contacto_telefono_codigo'  => 0,
                'contacto_telefono_numero'  => 0,
                'contacto_telefono_prefijo' => 0,
                'contacto_celular_codigo'   => 0,
                'contacto_celular_numero'   => 0,
                'contacto_celular_prefijo'  => 0,

                // Booleanos
                'borrado_logico'             => 0,
                'usar_nombre_alias'          => 0,
                'es_cronico'                 => 0, // default; cada paciente lo sobreescribe
                'tiene_incapacidad'          => 0,
                'acepto_terminos_condiciones' => 0,
                'no_acepta_donacion_sanguinea' => 0,
                'usar_edad_aproximada'       => 0,
                'edad_aproximada'            => 0,

                // Fechas
                'last_sintys_validation' => now(),
                'fecha_edad_aproximada'  => now(),
            ];

            // El array de $persona sobreescribe los defaults, incluyendo es_cronico.
            Persona::firstOrCreate(
                ['documento' => $persona['documento']],
                array_merge($datosObligatorios, $persona)
            );
        }

        // Retirar del escenario a los tres pacientes que ya no forman parte
        // de la demo. Se conservan sus datos relacionados en la BD; solo se
        // aplica soft delete para no perder información histórica.
        DB::table('persona')
            ->whereIn('documento', self::DOCUMENTOS_PACIENTES_EXCLUIDOS)
            ->whereNull('deleted_at')
            ->update([
                'deleted_at' => now(),
                'deleted_by' => 1,
                'borrado_logico' => 1,
                'updated_at' => now(),
            ]);

        Schema::enableForeignKeyConstraints();
    }
}
