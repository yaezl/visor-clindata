<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\Personal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class PersonalSeeder extends Seeder
{
    /**
     * Documentos de las Personas que son PERSONAL MÉDICO.
     * Importante: un paciente (Persona) NO debe estar acá.
     * Si necesitás agregar más médicos, sumá su documento a esta lista
     * (y asegurate de que exista/se cree como Persona antes de este seeder).
     */
    protected array $documentosPersonalMedico = [
        '11223344', // Dra. Laura Fernández (admin/usuario legacy, no atiende pacientes)
        '20111333', // Dr. Martín Suárez (atiende pacientes)
        '27222444', // Dra. Valeria Torres (atiende pacientes)
        '20333555', // Dr. Diego Ramírez (atiende pacientes)
    ];

    /**
     * Documentos de TODO el personal médico (admin + tratantes), accesible
     * desde otros seeders sin instanciar esta clase.
     */
    public const DOCUMENTOS_PERSONAL_MEDICO = [
        '11223344',
        '20111333',
        '27222444',
        '20333555',
    ];

    /**
     * Documentos de médicos que SÍ pueden quedar asignados como
     * profesional tratante en consultas (excluye a la admin).
     */
    public const DOCUMENTOS_MEDICOS_TRATANTES = [
        '20111333',
        '27222444',
        '20333555',
    ];

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Nos aseguramos de que exista la Persona "Dra. Laura Fernández"
        // (es personal médico, no un paciente, así que no toca PersonaSeeder).
        $idFalso = rand(100000, 999999);

        $medico = Persona::firstOrCreate(
            ['documento' => '11223344'],
            [
                'nombres'   => 'Laura',
                'apellidos' => 'Fernández',
                'sexo'      => 'F',
                'genero'    => 'F',
                'genero_id' => 1,
                'fecha_nacimiento' => '1980-03-10',

                'created_by' => 1,
                'modified_by' => 1,
                'deleted_by' => 0,

                'direccion_id' => $idFalso,
                'cuenta_id' => $idFalso,
                'direccion_nacimiento_id' => $idFalso,
                'direccion_extranjera_id' => $idFalso,

                'pais_id' => 1,
                'estado_civil_id' => 1,
                'tipo_documento_id' => 1,
                'estado_id' => 1,
                'empleador_id' => 1,
                'nivelinstruccion_id' => 1,
                'causa_hc_pasiva_id' => 1,
                'grupo_sanguineo_id' => 1,
                'condicion_iva' => 1,
                'religion_id' => 1,
                'grupoEtnico_id' => 1,
                'pais_extranjero_id' => 1,
                'pais_nacimiento_id' => 1,

                'apellido_materno' => '-',
                'nombre_alias' => '-',
                'estado_msg' => '-',
                'contacto_telefono_carrier' => '-',
                'observaciones' => '-',
                'codigo_ad_hoc' => '-',
                'contacto_celular_carrier' => '-',
                'contacto_email_direccion' => 'laura.fernandez' . $idFalso . '@clindata.com',
                'social_login' => 0,

                'cuil' => $idFalso,
                'nro_hc' => null,
                'telefono_codigo' => 0,
                'telefono_numero' => 0,
                'contacto_telefono_codigo' => 0,
                'contacto_telefono_numero' => 0,
                'contacto_telefono_prefijo' => 0,
                'contacto_celular_codigo' => 0,
                'contacto_celular_numero' => 0,
                'contacto_celular_prefijo' => 0,

                'borrado_logico' => 0,
                'usar_nombre_alias' => 0,
                'es_cronico' => 0,
                'tiene_incapacidad' => 0,
                'acepto_terminos_condiciones' => 0,
                'no_acepta_donacion_sanguinea' => 0,
                'usar_edad_aproximada' => 0,
                'edad_aproximada' => 0,

                'last_sintys_validation' => now(),
                'fecha_edad_aproximada' => now(),
            ]
        );

        // Médicos que sí atienden pacientes (aparte de la admin).
        $medicosTratantes = [
            [
                'documento' => '20111333',
                'nombres'   => 'Martín',
                'apellidos' => 'Suárez',
                'sexo'      => 'M',
                'fecha_nacimiento' => '1975-07-22',
            ],
            [
                'documento' => '27222444',
                'nombres'   => 'Valeria',
                'apellidos' => 'Torres',
                'sexo'      => 'F',
                'fecha_nacimiento' => '1988-12-01',
            ],
            [
                'documento' => '20333555',
                'nombres'   => 'Diego',
                'apellidos' => 'Ramírez',
                'sexo'      => 'M',
                'fecha_nacimiento' => '1979-04-18',
            ],
        ];

        foreach ($medicosTratantes as $datosMedico) {
            $idFalsoMedico = rand(100000, 999999);

            Persona::firstOrCreate(
                ['documento' => $datosMedico['documento']],
                [
                    'nombres'   => $datosMedico['nombres'],
                    'apellidos' => $datosMedico['apellidos'],
                    'sexo'      => $datosMedico['sexo'],
                    'genero'    => $datosMedico['sexo'],
                    'genero_id' => 1,
                    'fecha_nacimiento' => $datosMedico['fecha_nacimiento'],

                    'created_by' => 1,
                    'modified_by' => 1,
                    'deleted_by' => 0,

                    'direccion_id' => $idFalsoMedico,
                    'cuenta_id' => $idFalsoMedico,
                    'direccion_nacimiento_id' => $idFalsoMedico,
                    'direccion_extranjera_id' => $idFalsoMedico,

                    'pais_id' => 1,
                    'estado_civil_id' => 1,
                    'tipo_documento_id' => 1,
                    'estado_id' => 1,
                    'empleador_id' => 1,
                    'nivelinstruccion_id' => 1,
                    'causa_hc_pasiva_id' => 1,
                    'grupo_sanguineo_id' => 1,
                    'condicion_iva' => 1,
                    'religion_id' => 1,
                    'grupoEtnico_id' => 1,
                    'pais_extranjero_id' => 1,
                    'pais_nacimiento_id' => 1,

                    'apellido_materno' => '-',
                    'nombre_alias' => '-',
                    'estado_msg' => '-',
                    'contacto_telefono_carrier' => '-',
                    'observaciones' => '-',
                    'codigo_ad_hoc' => '-',
                    'contacto_celular_carrier' => '-',
                    'contacto_email_direccion' => strtolower($datosMedico['nombres']) . $idFalsoMedico . '@clindata.com',
                    'social_login' => 0,

                    'cuil' => $idFalsoMedico,
                    'nro_hc' => null,
                    'telefono_codigo' => 0,
                    'telefono_numero' => 0,
                    'contacto_telefono_codigo' => 0,
                    'contacto_telefono_numero' => 0,
                    'contacto_telefono_prefijo' => 0,
                    'contacto_celular_codigo' => 0,
                    'contacto_celular_numero' => 0,
                    'contacto_celular_prefijo' => 0,

                    'borrado_logico' => 0,
                    'usar_nombre_alias' => 0,
                    'es_cronico' => 0,
                    'tiene_incapacidad' => 0,
                    'acepto_terminos_condiciones' => 0,
                    'no_acepta_donacion_sanguinea' => 0,
                    'usar_edad_aproximada' => 0,
                    'edad_aproximada' => 0,

                    'last_sintys_validation' => now(),
                    'fecha_edad_aproximada' => now(),
                ]
            );
        }

        // Ahora sí: creamos el registro Personal SOLO para las personas
        // que están en la lista de documentos de personal médico.
        $personas = Persona::whereIn('documento', $this->documentosPersonalMedico)->get();

        foreach ($personas as $persona) {
            Personal::firstOrCreate(
                ['persona_id' => $persona->id],
                [
                    'matricula_provincial' => 'MP-' . $persona->id,
                    'matricula_nacional'   => 'MN-' . $persona->id,

                    'created_by'  => 1,
                    'modified_by' => 1,
                    'deleted_by'  => 0,

                    'mail_institucion' => 'medico' . $persona->id . '@clindata.com',

                    'borrado_logico' => 0,

                    'legajo' => 'LEG-' . $persona->id,

                    'universidad' => 'Universidad Nacional',

                    'codigo_ad_hoc' => null,
                    'colegiatura' => null,
                    'link_videollamada' => null,
                    'codigoProvinciaMatricula' => null,
                    'damsuId' => null,
                    'idCondicionIva' => null,
                ]
            );
        }
        // Creamos el Usuario legacy "sistema" para la Dra. Fernández,
        // que después usamos como created_by/modified_by en otros seeders
        // (persona, grupo_sanguineo, etc.) en vez de un ID inventado.
        $usuarioExistente = DB::table('usuario')->where('username', 'laura.fernandez')->first();

        if (!$usuarioExistente) {
            $personalDeLaura = Personal::where('persona_id', $medico->id)->first();

            DB::statement(
                "INSERT INTO usuario (username, password, created_at, created_by, updated_at, modified_by, deleted_at, deleted_by, personal_id, borrado_logico, last_login, log_attempt, blocked_account, codigo_ad_hoc, cambiar_password)
                 VALUES ('laura.fernandez', ?, NOW(), 0, NOW(), 0, NULL, NULL, ?, 0, NULL, 0, 0, NULL, 0)",
                [bcrypt('password'), $personalDeLaura->id]
            );

            $usuarioId = DB::table('usuario')->where('username', 'laura.fernandez')->value('id');

            DB::table('usuario')->where('id', $usuarioId)->update([
                'created_by' => $usuarioId,
                'modified_by' => $usuarioId,
            ]);
        }

    }
}