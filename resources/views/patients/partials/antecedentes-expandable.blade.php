{{--
    Contenido de Antecedentes del paciente (acordeón desplegable).
    ---------------------------------------------------------------
    Se incluye desde patients/detail.blade.php.
    Recibe: $antecedentes (array armado por AntecedenteService), con
    'perinatal' (array|null) y 'patologicos' (Collection).
--}}

<div class="patient-summary-content">

    {{-- Antecedentes perinatales: cómo fue el nacimiento --}}
    <div class="patient-summary-block mb-4">
        <h5>Antecedentes perinatales</h5>

        @if ($antecedentes['perinatal'])
            @php $perinatal = $antecedentes['perinatal']; @endphp

            <div class="patient-summary-chip-grid">
                @if ($perinatal['tipo_parto'])
                    <div class="patient-summary-chip">
                        <span class="patient-summary-chip-label">Tipo de parto</span>
                        <span class="patient-summary-chip-value">{{ $perinatal['tipo_parto'] }}</span>
                    </div>
                @endif
                @if ($perinatal['edad_gestacional'])
                    <div class="patient-summary-chip">
                        <span class="patient-summary-chip-label">Edad gestacional</span>
                        <span class="patient-summary-chip-value">{{ $perinatal['edad_gestacional'] }} semanas</span>
                    </div>
                @endif
                @if ($perinatal['peso_al_nacer'])
                    <div class="patient-summary-chip">
                        <span class="patient-summary-chip-label">Peso al nacer</span>
                        <span class="patient-summary-chip-value">{{ $perinatal['peso_al_nacer'] }} kg</span>
                    </div>
                @endif
                @if ($perinatal['apgar_1'] !== null && $perinatal['apgar_5'] !== null)
                    <div class="patient-summary-chip">
                        <span class="patient-summary-chip-label">APGAR (1' / 5')</span>
                        <span class="patient-summary-chip-value">{{ $perinatal['apgar_1'] }} <small>al 1'</small> /
                            {{ $perinatal['apgar_5'] }} <small>al 5'</small></span>
                    </div>
                @endif
            </div>

            @if ($perinatal['con_patologia'])
                <div class="patient-summary-pattern mt-3 mb-0">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span>
                        @if ($perinatal['diagnosticos']->isNotEmpty())
                            {{ $perinatal['diagnosticos']->implode(', ') }}.
                        @endif
                        {{ $perinatal['comentario'] }}
                    </span>
                </div>
            @elseif($perinatal['comentario'])
                <div class="patient-summary-note mt-3">
                    <i class="bi bi-file-text"></i>
                    <span>{{ $perinatal['comentario'] }}</span>
                </div>
            @endif
        @else
            <p class="patient-tab-empty">Sin antecedentes perinatales cargados.</p>
        @endif
    </div>

    {{-- Antecedentes patológicos: qué tuvo antes y cómo fue --}}
    <div class="patient-summary-block">
        <h5>Antecedentes patológicos</h5>

        @if ($antecedentes['patologicos']->isNotEmpty())
            <ul class="patient-summary-list patient-summary-list--antecedente">
                @foreach ($antecedentes['patologicos'] as $antecedente)
                    <li class="patient-summary-list-item--stacked">
                        <div class="patient-summary-med-nombre">{{ $antecedente['nombre'] }}</div>
                        @if ($antecedente['comentario'])
                            <div class="patient-summary-med-detalle">{{ $antecedente['comentario'] }}</div>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p class="patient-tab-empty">Sin antecedentes patológicos ni heredofamiliares cargados aún para este
                paciente.</p>
        @endif
    </div>

</div>
