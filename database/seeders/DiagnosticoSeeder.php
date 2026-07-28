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

        // Lista de diagnósticos a insertar
        $diagnosticos = [
            ['codigocie10' => 'J45', 'nombre' => 'Asma'],
            ['codigocie10' => 'I10', 'nombre' => 'Hipertensión esencial'],
            ['codigocie10' => 'E11', 'nombre' => 'Diabetes mellitus tipo 2'],
            ['codigocie10' => 'J00', 'nombre' => 'Resfriado común'],
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