<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\Personal;
use Illuminate\Database\Seeder;

class PersonalSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Persona::all() as $persona) {

            Personal::firstOrCreate(

                [
                    'persona_id' => $persona->id,
                ],

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
    }
}