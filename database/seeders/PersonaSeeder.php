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

        // Grupo sanguíneo A+ para Carlos Gómez (si el catálogo ya trae
        // datos reales del hospital, los reutiliza; si no, crea uno mínimo).
        $grupoAPositivo = GrupoSanguineo::firstOrCreate(
            ['codigo' => 'A+'],
            [
                'nombre'       => 'A Positivo',
                'creado_en'    => now(),
                'modificado_en'=> now(),
                'borrado_logico' => 0,
            ]
        );

        // ── Pacientes de prueba ──────────────────────────────────────
        $pacientes = [
            [
                'nombres' => 'Juan',
                'apellidos' => 'Pérez',
                'documento' => '12345678',
                'sexo' => 'M',
                'genero' => 'M',
                'fecha_nacimiento' => '1985-05-20',
            ],
            [
                'nombres' => 'María',
                'apellidos' => 'Gómez',
                'documento' => '87654321',
                'sexo' => 'F',
                'genero' => 'F',
                'fecha_nacimiento' => '1992-10-15',
            ],
            [
                'nombres' => 'Carlos',
                'apellidos' => 'Gómez',
                'documento' => '67245356',
                'sexo' => 'M',
                'genero' => 'M',
                'fecha_nacimiento' => '2016-05-12',
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
                'fecha_nacimiento' => '2001-02-08',
            ],
            [
                'nombres' => 'Ramón',
                'apellidos' => 'Díaz',
                'documento' => '20444555',
                'sexo' => 'M',
                'genero' => 'M',
                'fecha_nacimiento' => '1958-11-30',
            ],
        ];

        // ── Personal médico de prueba ────────────────────────────────
        // (mismos documentos que self::DOCUMENTOS_MEDICOS)
        $medicos = [
            [
                'nombres' => 'Laura',
                'apellidos' => 'Fernández',
                'documento' => '30111222',
                'sexo' => 'F',
                'genero' => 'F',
                'fecha_nacimiento' => '1980-03-15',
            ],
            [
                'nombres' => 'Martín',
                'apellidos' => 'Suárez',
                'documento' => '30222333',
                'sexo' => 'M',
                'genero' => 'M',
                'fecha_nacimiento' => '1975-07-22',
            ],
            [
                'nombres' => 'Valeria',
                'apellidos' => 'Torres',
                'documento' => '30333444',
                'sexo' => 'F',
                'genero' => 'F',
                'fecha_nacimiento' => '1988-12-01',
            ],
        ];

        foreach (array_merge($pacientes, $medicos) as $persona) {
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