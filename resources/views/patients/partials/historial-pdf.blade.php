<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Historial Médico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .patient-info {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .patient-info-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 10px;
        }

        .patient-info-item {
            flex: 1;
            min-width: 200px;
        }

        .patient-info-label {
            font-weight: bold;
            color: #555;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .patient-info-value {
            font-size: 14px;
            color: #333;
        }

        .print-date {
            text-align: right;
            font-size: 12px;
            color: #666;
            margin-bottom: 20px;
        }

        .historial-container {
            margin-top: 20px;
        }

        .historial-mes {
            margin-bottom: 25px;
        }

        .mes-titulo {
            background-color: #e8f0fe;
            border-left: 4px solid #1976d2;
            padding: 10px 15px;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 15px;
            color: #1976d2;
        }

        .historial-item {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .item-date {
            font-weight: bold;
            font-size: 13px;
            color: #1976d2;
        }

        .item-type {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }

        .detail-section {
            margin-bottom: 12px;
            padding: 10px;
            background-color: #fafafa;
            border-radius: 3px;
        }

        .detail-title {
            font-weight: bold;
            color: #555;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .detail-content {
            font-size: 12px;
            color: #666;
            line-height: 1.5;
        }

        .diagnosis-list {
            list-style-type: none;
            padding-left: 0;
        }

        .diagnosis-item {
            background-color: #fff3e0;
            border-left: 3px solid #ff9800;
            padding: 8px 12px;
            margin-bottom: 5px;
            font-size: 12px;
            color: #333;
        }

        .study-table {
            width: 100%;
            font-size: 11px;
            margin-top: 8px;
        }

        .study-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .study-table th {
            background-color: #e8f0fe;
            color: #1976d2;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border-bottom: 2px solid #1976d2;
        }

        .study-table td {
            padding: 8px;
            border-bottom: 1px solid #e0e0e0;
        }

        .study-table tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #999;
            font-style: italic;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            color: #999;
            border-top: 1px solid #ddd;
            margin-top: 30px;
            padding-top: 10px;
        }

        @media print {
            body {
                margin: 0;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>HISTORIAL MÉDICO</h1>
    </div>

    <div class="print-date">
        <strong>Fecha de impresión:</strong> {{ $fecha_impresion }}
    </div>

    <div class="patient-info">
        <div class="patient-info-row">
            <div class="patient-info-item">
                <div class="patient-info-label">Paciente</div>
                <div class="patient-info-value">
                    {{ $inicialNombre }}.{{ $inicialApellido }}.
                </div>
            </div>

            <div class="patient-info-item">
                <div class="patient-info-label">Sexo</div>
                <div class="patient-info-value">
                    {{ $persona->sexo ?? '-' }}
                </div>
            </div>

            <div class="patient-info-item">
                <div class="patient-info-label">Fecha de Nacimiento</div>
                <div class="patient-info-value">
                    @if($persona->fecha_nacimiento)
                        {{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </div>
            </div>

            <div class="patient-info-item">
                <div class="patient-info-label">Edad</div>
                <div class="patient-info-value">
                    @if($persona->fecha_nacimiento)
                        {{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->age }} años
                    @else
                        -
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="historial-container">
        @if($historial->count())
            @foreach($historial->groupBy(function($item) {
                return $item->fecha_evento->format('Y-m');
            }) as $mes => $items)
                <div class="historial-mes">
                    <div class="mes-titulo">
                        {{ \Carbon\Carbon::parse($mes . '-01')->format('F Y') }}
                    </div>

                    @foreach($items as $evento)
                        @php
                            $consulta = $evento->consulta->first();
                            $detalle = $consulta?->consultadetalles?->first();

                            $diagnosticos = collect();

                            if ($consulta) {
                                $diagnosticos = $consulta->consultadetalles
                                    ->flatMap(fn ($d) => $d->diagnostico_detalles);
                            }

                            $estudios = $evento->informedeestudios ?? collect();
                        @endphp

                        <div class="historial-item">
                            <div class="item-header">
                                <div class="item-date">
                                    {{ $evento->fecha_evento->format('d/m/Y') }}
                                </div>
                                <div class="item-type">
                                    {{ ucfirst($evento->tipo_evento) }}
                                </div>
                            </div>

                            @if($detalle?->sintomas_signos)
                                <div class="detail-section">
                                    <div class="detail-title">
                                        Consulta
                                    </div>
                                    <div class="detail-content">
                                        {{ trim($detalle->sintomas_signos) }}
                                    </div>
                                </div>
                            @endif

                            @if($detalle?->funciones_biologicas)
                                <div class="detail-section">
                                    <div class="detail-title">
                                        Funciones Biológicas
                                    </div>
                                    <div class="detail-content">
                                        {{ trim($detalle->funciones_biologicas) }}
                                    </div>
                                </div>
                            @endif

                            @if($detalle?->cremiento_desarrollo)
                                <div class="detail-section">
                                    <div class="detail-title">
                                        Crecimiento y Desarrollo
                                    </div>
                                    <div class="detail-content">
                                        {{ trim($detalle->cremiento_desarrollo) }}
                                    </div>
                                </div>
                            @endif

                            @if($diagnosticos->isNotEmpty())
                                <div class="detail-section">
                                    <div class="detail-title">
                                        Diagnósticos
                                    </div>
                                    <div class="diagnosis-list">
                                        @foreach($diagnosticos as $diag)
                                            <div class="diagnosis-item">
                                                {{ $diag->diagnostico->nombre }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($estudios->isNotEmpty())
                                <div class="detail-section">
                                    <div class="detail-title">
                                        Estudios Realizados
                                    </div>
                                    <div class="study-table">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>Estudio</th>
                                                <th>Diagnóstico</th>
                                                <th>Profesional</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($estudios as $estudio)
                                                <tr>
                                                    <td>{{ optional($estudio->estudio)->nombre ?? '-' }}</td>
                                                    <td>{{ optional($estudio->diagnostico)->nombre ?? '-' }}</td>
                                                    <td>{{ optional(optional(optional($estudio->usuario)->personal)->persona)->nombre_completo ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <div class="empty-state">
                No hay registros en el historial médico
            </div>
        @endif
    </div>

    <div class="footer">
        <p>Documento generado automáticamente por el Sistema de Visor Clínico</p>
    </div>
</body>
</html>