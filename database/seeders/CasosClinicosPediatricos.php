<?php

namespace Database\Seeders;

/**
 * Catálogo de "casos clínicos" pediátricos coherentes.
 *
 * Cada caso agrupa todo lo que en la vida real aparece junto en una
 * misma consulta: motivo, examen físico, funciones biológicas, estado
 * del crecimiento/desarrollo y el código CIE10 del diagnóstico que le
 * corresponde (debe existir en DiagnosticoSeeder).
 *
 * Esto reemplaza la generación anterior, donde el motivo de consulta
 * (Consultadetalle) y el diagnóstico (DiagnosticoDetalle) se elegían
 * al azar e independientemente, pudiendo quedar un motivo de "tos"
 * con un diagnóstico de "Diabetes mellitus".
 */
class CasosClinicosPediatricos
{
    /**
     * @return array<int, array{
     *   codigocie10: string,
     *   sintomas_signos: string,
     *   funciones_biologicas: string,
     *   crecimiento_desarrollo: string,
     * }>
     */
    public static function casos(): array
    {
        return [
            [
                'codigocie10' => 'J00',
                'sintomas_signos' => "Consulta por rinorrea mucosa anterior y tos productiva leve.\nAfebril. Buen estado general.\nFauces sin particularidades. Otoscopía normal bilateral.",
                'funciones_biologicas' => "Apetito conservado.\nSueño normal.\nDepositaciones normales.\nMicciones sin particularidades.",
                'crecimiento_desarrollo' => "Crecimiento y desarrollo acordes para la edad.",
            ],
            [
                'codigocie10' => 'J20',
                'sintomas_signos' => "Consulta por tos.\nAfebril y en buen estado general.\nCatarro bronquial. Sin tiraje ni retracciones.",
                'funciones_biologicas' => "Apetito conservado.\nSueño normal.\nDepositaciones normales.\nDiuresis adecuada.",
                'crecimiento_desarrollo' => "Desarrollo psicomotor normal para la edad.",
            ],
            [
                'codigocie10' => 'J21',
                'sintomas_signos' => "Consulta por tos y dificultad respiratoria.\nPatrón obstructivo leve a moderado.\nBuena tolerancia oral, sin signos de dificultad respiratoria severa.",
                'funciones_biologicas' => "Apetito levemente disminuido durante el cuadro.\nSueño interrumpido por tos.\nDepositaciones normales.",
                'crecimiento_desarrollo' => "Crecimiento sostenido dentro de los rangos normales.",
            ],
            [
                'codigocie10' => 'J4591',
                'sintomas_signos' => "Consulta por tos y agitamiento.\nPatrón obstructivo moderado a leve.\nAfebril, en regular a buen estado general.",
                'funciones_biologicas' => "No hay afectación del sueño ni de la alimentación.",
                'crecimiento_desarrollo' => "Crecimiento y desarrollo acordes para la edad.",
            ],
            [
                'codigocie10' => 'B349',
                'sintomas_signos' => "Consulta por fiebre de varios días de evolución.\nExamen físico compatible con infección viral.\nPersiste catarro bronquial. Picos febriles en descenso.",
                'funciones_biologicas' => "Apetito disminuido durante el pico febril.\nSueño interrumpido por los episodios de fiebre.\nDepositaciones normales.",
                'crecimiento_desarrollo' => "Sin compromiso del crecimiento durante el episodio agudo.",
            ],
            [
                'codigocie10' => 'H60',
                'sintomas_signos' => "Consulta por llanto inconsolable e irritabilidad.\nOtoscopía bilateral patológica compatible con otitis.\nAfebril, en buen estado general.",
                'funciones_biologicas' => "Apetito conservado.\nSueño interrumpido por dolor.\nDepositaciones y diuresis normales.",
                'crecimiento_desarrollo' => "Crecimiento y desarrollo acordes para la edad.",
            ],
            [
                'codigocie10' => 'H66',
                'sintomas_signos' => "Consulta por dolor de oído y fiebre.\nOtoscopía compatible con otitis media aguda.\nFauces levemente eritematosas.",
                'funciones_biologicas' => "Apetito disminuido durante el episodio.\nSueño interrumpido.\nDepositaciones normales.",
                'crecimiento_desarrollo' => "Desarrollo acorde a la edad, sin alteraciones.",
            ],
            [
                'codigocie10' => 'J310',
                'sintomas_signos' => "Consulta por irritación ocular asociada a cuadro respiratorio alto.\nLeve eritema peripalpebral, sin secreción.\nRinorrea de varios días de evolución.",
                'funciones_biologicas' => "Apetito y sueño conservados.\nDepositaciones normales.",
                'crecimiento_desarrollo' => "Crecimiento y desarrollo acordes para la edad.",
            ],
            [
                'codigocie10' => 'H10',
                'sintomas_signos' => "Consulta por ojos irritados.\nEritema peripalpebral leve, sin secreción purulenta.\nFauces eritematosas asociadas a cuadro respiratorio alto.",
                'funciones_biologicas' => "Funciones biológicas dentro de los parámetros normales para su edad.",
                'crecimiento_desarrollo' => "Sin alteraciones del crecimiento.",
            ],
            [
                'codigocie10' => 'A09',
                'sintomas_signos' => "Consulta por diarrea de varios días de evolución.\nDeposiciones desligadas, en buena evolución.\nAbdomen blando, depresible, no doloroso. RHA aumentados.",
                'funciones_biologicas' => "Apetito disminuido durante el cuadro.\nSueño interrumpido por dolor abdominal.\nDepositaciones aumentadas en frecuencia, consistencia disminuida.",
                'crecimiento_desarrollo' => "Sin compromiso del crecimiento durante el episodio agudo.",
            ],
            [
                'codigocie10' => 'R11',
                'sintomas_signos' => "Consulta por vómitos persistentes precedidos de náuseas.\nSin diarrea asociada.\nDeshidratación leve, con buena respuesta a rehidratación oral.",
                'funciones_biologicas' => "Apetito disminuido durante el episodio.\nDepositaciones normales.\nDiuresis conservada tras rehidratación.",
                'crecimiento_desarrollo' => "Sin compromiso del crecimiento; episodio autolimitado.",
            ],
            [
                'codigocie10' => 'N390',
                'sintomas_signos' => "Consulta por irritabilidad sin fiebre, madre refiere notar al paciente \"raro\" y molesto.\nAfebril y en buen estado general al examen.\nSe solicita sedimento de orina para descartar infección urinaria.",
                'funciones_biologicas' => "Apetito conservado.\nSueño interrumpido por irritabilidad.\nMicciones sin particularidades evidentes al interrogatorio.",
                'crecimiento_desarrollo' => "Crecimiento y desarrollo acordes para la edad.",
            ],
            [
                'codigocie10' => 'Z001',
                'sintomas_signos' => "Control de salud de rutina.\nSin síntomas agudos referidos por los padres.",
                'funciones_biologicas' => "Apetito y sueño conservados.\nDepositaciones y micciones normales.",
                'crecimiento_desarrollo' => "Crecimiento y desarrollo acordes para la edad. Peso y talla dentro de percentiles normales.",
            ],
            [
                'codigocie10' => 'Z00',
                'sintomas_signos' => "Control clínico de seguimiento tras episodio agudo previo.\nMejoría del cuadro que motivó la consulta anterior.\nAfebril, buen estado general.",
                'funciones_biologicas' => "Apetito y sueño conservados.\nDepositaciones normales.",
                'crecimiento_desarrollo' => "Evolución favorable, sin alteraciones del crecimiento.",
            ],
        ];
    }
}