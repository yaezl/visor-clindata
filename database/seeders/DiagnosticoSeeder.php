<?php

namespace Database\Seeders;

use App\Models\Diagnostico;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DiagnosticoSeeder extends Seeder
{
    public function run(): void
    {
        // Apagamos llaves foráneas por seguridad
        Schema::disableForeignKeyConstraints();

        // Relleno obligatorio para la tabla diagnostico según tu estructura
        $datosObligatorios = [
            'created_by' => 1,
            'modified_by' => 1,
            
            // IDs de catálogos
            'tipo_id' => 1,
            'subtipo_id' => 1,
            'clase_id' => 1,
            
            // Cadenas de texto
            'codigocie10sinonimo' => '-',
            'infoparaelpaciente' => '-',
            'codigosnomedct' => '-',
            'codigociap2' => '-',
            
            // Booleanos o números
            'es_patologico' => 1,
            'auditado' => 0,
            'borrado_logico' => 0,
        ];

        // Catálogo pediátrico. 'categoria' se usa en el Resumen del
        // paciente para detectar patrones (ej: consultas respiratorias
        // recurrentes) sin heurísticas sobre el código CIE10.
        $diagnosticos = [
            // Respiratorio
            ['codigocie10' => 'J00',   'nombre' => 'Rinofaringitis aguda (resfriado común)', 'categoria' => 'respiratorio'],
            ['codigocie10' => 'J20',   'nombre' => 'Bronquitis aguda', 'categoria' => 'respiratorio'],
            ['codigocie10' => 'J21',   'nombre' => 'Bronquiolitis aguda', 'categoria' => 'respiratorio'],
            ['codigocie10' => 'J4591', 'nombre' => 'SOB/sibilancias - hiperreactividad bronquial', 'categoria' => 'respiratorio'],
            ['codigocie10' => 'B349',  'nombre' => 'Infección viral, no especificada', 'categoria' => 'respiratorio'],

            // Otorrinolaringológico
            ['codigocie10' => 'H60',  'nombre' => 'Otitis externa', 'categoria' => 'otorrinolaringologico'],
            ['codigocie10' => 'H66',  'nombre' => 'Otitis media aguda', 'categoria' => 'otorrinolaringologico'],
            ['codigocie10' => 'J310', 'nombre' => 'Rinitis', 'categoria' => 'otorrinolaringologico'],
            ['codigocie10' => 'H10',  'nombre' => 'Conjuntivitis', 'categoria' => 'otorrinolaringologico'],

            // Digestivo
            ['codigocie10' => 'A09', 'nombre' => 'Diarrea y gastroenteritis de presunto origen infeccioso', 'categoria' => 'digestivo'],
            ['codigocie10' => 'R11', 'nombre' => 'Náusea y vómito', 'categoria' => 'digestivo'],

            // Urinario
            ['codigocie10' => 'N390', 'nombre' => 'Infección de vías urinarias, sitio no especificado', 'categoria' => 'urinario'],

            // Control / salud
            ['codigocie10' => 'Z001', 'nombre' => 'Control niño sano', 'categoria' => 'control'],
            ['codigocie10' => 'Z00',  'nombre' => 'Control clínico', 'categoria' => 'control'],
        ];

        foreach ($diagnosticos as $diag) {
            // firstOrCreate para que si ya existe, lo salte sin dar error
            Diagnostico::firstOrCreate(
                ['codigocie10' => $diag['codigocie10']],
                array_merge($datosObligatorios, $diag)
            );
        }

        // Volvemos a encender las llaves foráneas
        Schema::enableForeignKeyConstraints();
    }
}