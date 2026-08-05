{{--
    Contenido del Resumen del paciente (acordeón desplegable).
    ----------------------------------------------------------
    Se incluye desde patients/detail.blade.php.
    Recibe: $resumen (texto plantilla), $resumen_clinico (array armado
    por PatientSummaryService).

    Este archivo se puede editar libremente sin tocar detail.blade.php.
--}}

<div class="patient-summary-content">

    {{-- Texto resumen por plantilla (el que ya existía) --}}
    <div class="patient-summary-intro mb-3">
        <i class="bi bi-clipboard2-pulse"></i>
        <span>{{ $resumen }}</span>
    </div>

    {{-- Alerta de patrón: dato neutro, calculado por conteo simple --}}
    @if($resumen_clinico['patron_categoria'])
        <div class="patient-summary-pattern">
            <i class="bi bi-info-circle"></i>
            <span>
                Presentó {{ $resumen_clinico['patron_categoria']['cantidad'] }}
                {{ $resumen_clinico['patron_categoria']['etiqueta'] }}
                en los últimos {{ $resumen_clinico['patron_categoria']['meses'] }} meses.
            </span>
        </div>
    @endif

    <div class="patient-summary-grid">

        {{-- Diagnósticos más frecuentes --}}
        <div class="patient-summary-block">
            <h5>Diagnósticos más frecuentes</h5>

            @if($resumen_clinico['diagnosticos_frecuentes']->isNotEmpty())
                <ul class="patient-summary-list">
                    @foreach($resumen_clinico['diagnosticos_frecuentes'] as $diag)
                        <li>
                            <span>{{ $diag['nombre'] }}</span>
                            <span class="patient-summary-badge">{{ $diag['cantidad'] }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="patient-tab-empty">Sin diagnósticos registrados aún.</p>
            @endif
        </div>

        {{-- Medicación activa: para que el médico pueda consultar avance --}}
        <div class="patient-summary-block">
            <h5>Medicación activa</h5>

            @if($resumen_clinico['medicacion_activa']->isNotEmpty())
                <ul class="patient-summary-list patient-summary-list--medicacion">
                    @foreach($resumen_clinico['medicacion_activa'] as $medicacion)
                        <li>
                            <div class="patient-summary-med-row">
                                <span class="patient-summary-med-nombre">{{ $medicacion['nombre'] }}</span>
                                @if($medicacion['dosis'])
                                    <span class="patient-summary-med-dosis">{{ $medicacion['dosis'] }}</span>
                                @endif
                            </div>
                            @if($medicacion['fecha_inicio'])
                                <div class="patient-summary-med-detalle">
                                    <span>Desde {{ $medicacion['fecha_inicio']->format('d/m/Y') }}</span>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="patient-tab-empty">Sin medicación activa registrada.</p>
            @endif
        </div>

        {{-- Última consulta --}}
        <div class="patient-summary-block">
            <h5>Última consulta</h5>

            @if($resumen_clinico['ultima_consulta'])
                <p class="mb-1">
                    <strong>{{ $resumen_clinico['ultima_consulta']['fecha']->format('d/m/Y') }}</strong>
                    @if($resumen_clinico['ultima_consulta']['medico'])
                        — {{ $resumen_clinico['ultima_consulta']['medico'] }}
                    @endif
                </p>
                @if($resumen_clinico['ultima_consulta']['motivo'])
                    <p class="mb-1 text-muted">{{ $resumen_clinico['ultima_consulta']['motivo'] }}</p>
                @endif
                @if($resumen_clinico['ultima_consulta']['diagnostico'])
                    <p class="mb-0"><strong>Dx:</strong> {{ $resumen_clinico['ultima_consulta']['diagnostico'] }}</p>
                @endif
            @else
                <p class="patient-tab-empty">Sin consultas registradas.</p>
            @endif
        </div>

    </div>

</div>