<?php

namespace Database\Seeders;

use App\Models\Consultadetalle;
use App\Models\Consultum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ConsultadetalleSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Obtener todas las consultas creadas
        $consultas = Consultum::all();

        foreach ($consultas as $consulta) {
            // Crear un detalle por consulta con datos realistas
            Consultadetalle::create([
                'consulta_id' => $consulta->id,
                'dtype' => 'Consultadetalle',
                'creadopor_id' => 1,
                'modificadopor_id' => 1,
                'borradopor_id' => 0,
                'creado_en' => now(),
                'finalidad_consulta_id' => 1, // Control médico
                'causa_externa_id' => null,
                'incapacidad_id' => null,
                'cremiento_desarrollo' => $this->datosCrecimiento(),
                'funciones_biologicas' => $this->datosFunciones(),
                'sintomas_signos' => $this->datosSintomas(),
                'proxima_cita' => now()->addMonth(),
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }

    private function datosSintomas(): string
    {
        $opciones = [
            "Paciente asintomático en el momento de la consulta.\nBuen estado general.\nAfebril.",
            "Refiere tos leve de 3 días de evolución.\nRinofaringitis viral.\nSin fiebre actualmente.",
            "Dolor abdominal leve en región periumbilical.\nEvolucionó favorablemente con tratamiento sintomático.\nMayor actividad que en consulta anterior.",
            "Fiebre de 5 días de evolución.\nEstudios complementarios realizados.\nExamen físico compatible con infección viral.",
            "Paciente refiere sensación de malestar general.\nBuen estado general al examen.\nFunciones biológicas conservadas.",
        ];
        return $opciones[array_rand($opciones)];
    }

    private function datosFunciones(): string
    {
        $opciones = [
            "Apetito conservado.\nSueño normal.\nDepositaciones normales.\nMicciones sin particularidades.",
            "Apetito aumentado.\nSueño tranquilo.\nDepositaciones normales.\nMicciones frecuentes pero sin disuria.",
            "Apetito disminuido durante los últimos 2 días.\nSueño interrumpido.\nDepositaciones normales en cantidad y consistencia.\nMicciones sin alteraciones.",
            "Apetito conservado.\nSueño normal.\nDepositaciones normales.\nDiuresis adecuada.",
            "Funciones biológicas dentro de los parámetros normales para su edad.",
        ];
        return $opciones[array_rand($opciones)];
    }

    private function datosCrecimiento(): string
    {
        $opciones = [
            "Crecimiento y desarrollo adecuado para su edad.\nCurva de crecimiento dentro de los percentiles normales.",
            "Desarrollo psicomotor normal.\nCrecimiento estatural y ponderal acorde con su edad cronológica.",
            "Paciente con adecuado crecimiento lineal.\nDesarrollo madurativo normal para su edad.",
            "Evolución favorable del crecimiento.\nNo se evidencian alteraciones del desarrollo.",
            "Crecimiento sostenido dentro de los rangos normales.\nMadurez ósea concordante con la edad biológica.",
        ];
        return $opciones[array_rand($opciones)];
    }
}