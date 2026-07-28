<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PersonaSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Lista de pacientes (Agregamos el género aquí)
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
            ]
        ];

        foreach ($pacientes as $paciente) {
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

            // Magia pura: Busca por documento. Si ya existe (Juan), lo ignora. Si no (María), lo inserta.
            Persona::firstOrCreate(
                ['documento' => $paciente['documento']], 
                array_merge($datosObligatorios, $paciente)
            );
        }

        Schema::enableForeignKeyConstraints();
    }
}