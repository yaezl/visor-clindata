@php
    use Carbon\Carbon;

    $edad = '-';

    if (!empty($persona->fecha_nacimiento)) {
        $fechaNacimiento = Carbon::parse($persona->fecha_nacimiento);

        if ($fechaNacimiento->diffInYears() >= 1) {
            $edad = (int) $fechaNacimiento->diffInYears() . ' años';
        } elseif ($fechaNacimiento->diffInMonths() >= 1) {
            $edad = (int) $fechaNacimiento->diffInMonths() . ' meses';
        } else {
            $edad = (int) $fechaNacimiento->diffInDays() . ' días';
        }
    }
@endphp

<style>
{!! file_get_contents(resource_path('css/pdf-history.css')) !!}
</style>

<div class="header">
    <h1>HISTORIAL MÉDICO</h1>
</div>

<div class="print-date">
    <strong>Fecha de impresión:</strong> {{ $fecha_impresion }}
</div>

<div class="patient-info">
    <table class="patient-grid">
        <tr>

            <td>
                <div class="patient-label">Paciente</div>
                <div class="patient-value">
                    {{ $inicialNombre }}.{{ $inicialApellido }}.
                </div>
            </td>

            <td>
                <div class="patient-label">Sexo</div>
                <div class="patient-value">
                    {{ $persona->sexo ?? '-' }}
                </div>
            </td>

            <td>
                <div class="patient-label">Fecha de nacimiento</div>
                <div class="patient-value">
                    @if($persona->fecha_nacimiento)
                        {{ Carbon::parse($persona->fecha_nacimiento)->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </div>
            </td>

            <td>
                <div class="patient-label">Edad</div>
                <div class="patient-value">
                    {{ $edad }}
                </div>
            </td>

        </tr>
    </table>
</div>

<div class="historial-container">

@if($historial->count())

    @foreach($historial->groupBy(function ($item) {
        return $item->fechahora
            ? $item->fechahora->format('Y-m')
            : 'sin-fecha';
    }) as $mes => $items)

        <div class="historial-mes">

            <div class="mes-titulo">
                {{ Carbon::parse($mes . '-01')->translatedFormat('F Y') }}
            </div>

            @foreach($items as $evento)

                @php
                    $consulta = $evento->consulta->first();
                    $detalle = $consulta?->consultadetalles?->first();

                    $diagnosticos = collect();

                    if ($consulta) {
                        $diagnosticos = $consulta->consultadetalles
                            ->flatMap(fn($d) => $d->diagnostico_detalles);
                    }

                    $estudios = $evento->informedeestudios ?? collect();
                @endphp

                <div class="historial-item">

                    <div class="item-header">

                        <div class="item-date">
                            {{ $evento->fechahora->format('d/m/Y') }}
                        </div>

                        <div class="item-type">
                            {{ ucfirst($evento->tipocontenido->nombre ?? 'Evento') }}
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
                                Estudios realizados
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