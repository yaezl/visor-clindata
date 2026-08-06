<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\GrupoSanguineo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PersonaSeeder extends Seeder
{
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
        // real (GrupoSanguineoSeeder) en vez de hardcodear IDs, que es lo
        // que dejaba a la mayoría de los pacientes con un id=1 "a ciegas"
        // sin grupo sanguíneo real asociado.
        $gruposPorCodigo = GrupoSanguineo::whereIn('codigo', ['A+', 'O+', 'O-', 'B+', 'AB-'])
            ->get()
            ->keyBy('codigo');

        $grupoAPositivo = $gruposPorCodigo->get('A+') ?? GrupoSanguineo::firstOrCreate(
            ['codigo' => 'A+'],
            [
                'nombre'       => 'A Positivo',
                'creado_en'    => now(),
                'modificado_en'=> now(),
                'borrado_logico' => 0,
            ]
        );

        // ── Pacientes de prueba
        // Edades variadas a propósito
        // para poder probar el Resumen con historias cortas y largas.
        $pacientes = [
            [
                'nombres' => 'Juan',
                'apellidos' => 'Pérez',
                'documento' => '12345678',
                'sexo' => 'M',
                'genero' => 'M',
                'fecha_nacimiento' => now()->subYears(3)->subMonths(2)->toDateString(),
                'grupo_sanguineo_id' => $gruposPorCodigo->get('O+')?->id ?? $grupoAPositivo->id,
            ],
            [
                'nombres' => 'María',
                'apellidos' => 'Gómez',
                'documento' => '87654321',
                'sexo' => 'F',
                'genero' => 'F',
                'fecha_nacimiento' => now()->subMonths(9)->toDateString(),
                'grupo_sanguineo_id' => $gruposPorCodigo->get('O-')?->id ?? $grupoAPositivo->id,
            ],
            [
                'nombres' => 'Carlos',
                'apellidos' => 'Gómez',
                'documento' => '67245356',
                'sexo' => 'M',
                'genero' => 'M',
                'fecha_nacimiento' => now()->subYears(2)->subMonths(1)->toDateString(),
                'nro_hc' => 1432567,
                'grupo_sanguineo_id' => $grupoAPositivo->id,
                'contacto_celular_codigo' => 261,
                'contacto_celular_numero' => 567234,
            ],
            [
                'nombres' => 'Sofía',
                'apellidos' => 'Martínez',
                'documento' => '41555666',
                'sexo' => 'F',
                'genero' => 'F',
                'fecha_nacimiento' => now()->subYears(7)->subMonths(4)->toDateString(),
                'grupo_sanguineo_id' => $gruposPorCodigo->get('B+')?->id ?? $grupoAPositivo->id,
            ],
            [
                'nombres' => 'Ramón',
                'apellidos' => 'Díaz',
                'documento' => '20444555',
                'sexo' => 'M',
                'genero' => 'M',
                'fecha_nacimiento' => now()->subYears(11)->subMonths(6)->toDateString(),
                'grupo_sanguineo_id' => $gruposPorCodigo->get('AB-')?->id ?? $grupoAPositivo->id,
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
                'created_by' => 1,
                'modified_by' => 1,
                'deleted_by' => 0,

                // IDs únicos con el número al azar
                'direccion_id' => $idFalso,
                'cuenta_id' => $idFalso,
                'direccion_nacimiento_id' => $idFalso,
                'direccion_extranjera_id' => $idFalso,

                // IDs de catálogos compartidos
                'pais_id' => 1,
                'estado_civil_id' => 1,
                'tipo_documento_id' => 1,
                'estado_id' => 1,
                'genero_id' => 1,
                'empleador_id' => 1,
                'nivelinstruccion_id' => 1,
                'causa_hc_pasiva_id' => 1,
                'grupo_sanguineo_id' => 1,
                'condicion_iva' => 1,
                'religion_id' => 1,
                'grupoEtnico_id' => 1,
                'pais_extranjero_id' => 1,
                'pais_nacimiento_id' => 1,

                // Textos y Cadenas
                'apellido_materno' => '-',
                'nombre_alias' => '-',
                'estado_msg' => '-',
                'contacto_telefono_carrier' => '-',
                'observaciones' => '-',
                'codigo_ad_hoc' => '-',
                'contacto_celular_carrier' => '-',
                'contacto_email_direccion' => 'test' . $idFalso . '@clindata.com',
                'social_login' => 0,

                // CAMPOS NUMÉRICOS
                'cuil' => $idFalso,
                'nro_hc' => $idFalso,
                'telefono_codigo' => 0,
                'telefono_numero' => 0,
                'contacto_telefono_codigo' => 0,
                'contacto_telefono_numero' => 0,
                'contacto_telefono_prefijo' => 0,
                'contacto_celular_codigo' => 0,
                'contacto_celular_numero' => 0,
                'contacto_celular_prefijo' => 0,

                // Booleanos / Números
                'borrado_logico' => 0,
                'usar_nombre_alias' => 0,
                'es_cronico' => 0,
                'tiene_incapacidad' => 0,
                'acepto_terminos_condiciones' => 0,
                'no_acepta_donacion_sanguinea' => 0,
                'usar_edad_aproximada' => 0,
                'edad_aproximada' => 0,

                // Fechas
                'last_sintys_validation' => now(),
                'fecha_edad_aproximada' => now(),
            ];

            // Busca por documento. Si ya existe lo ignora, si no lo inserta.
            Persona::firstOrCreate(
                ['documento' => $persona['documento']],
                array_merge($datosObligatorios, $persona)
            );
        }

        Schema::enableForeignKeyConstraints();
    }
}