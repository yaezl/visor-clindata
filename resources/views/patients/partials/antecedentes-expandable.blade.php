{{--
    Contenido de Antecedentes del paciente (acordeón desplegable).
    ---------------------------------------------------------------
    Se incluye desde patients/detail.blade.php.
    Recibe: $antecedentes (array armado por AntecedenteService), con
    'perinatal' (array|null) y 'patologicos' (Collection).

    Este archivo se puede editar libremente sin tocar detail.blade.php.
--}}

<div class="patient-summary-content">

    {{-- Antecedentes perinatales: cómo fue el nacimiento --}}
    <div class="patient-summary-block mb-4">
        <h5>Antecedentes perinatales</h5>

        @if($antecedentes['perinatal'])
            @php $perinatal = $antecedentes['perinatal']; @endphp

            <ul class="patient-summary-list patient-summary-list--antecedente">
                @if($perinatal['tipo_parto'])
                    <li><span>Tipo de parto</span><span>{{ $perinatal['tipo_parto'] }}</span></li>
                @endif
                @if($perinatal['edad_gestacional'])
                    <li><span>Edad gestacional</span><span>{{ $perinatal['edad_gestacional'] }} semanas</span></li>
                @endif
                @if($perinatal['peso_al_nacer'])
                    <li><span>Peso al nacer</span><span>{{ $perinatal['peso_al_nacer'] }} kg</span></li>
                @endif
                @if($perinatal['apgar_1'] !== null && $perinatal['apgar_5'] !== null)
                    <li><span>APGAR</span><span>{{ $perinatal['apgar_1'] }} / {{ $perinatal['apgar_5'] }}</span></li>
                @endif
            </ul>

            @if($perinatal['con_patologia'])
                <div class="patient-summary-pattern mt-3 mb-0">
                    <i class="bi bi-info-circle"></i>
                    <span>
                        Con patología perinatal registrada.
                        @if($perinatal['diagnosticos']->isNotEmpty())
                            {{ $perinatal['diagnosticos']->implode(', ') }}.
                        @endif
                        @if($perinatal['comentario'])
                            {{ $perinatal['comentario'] }}
                        @endif
                    </span>
                </div>
            @elseif($perinatal['comentario'])
                <p class="text-muted mt-3 mb-0">{{ $perinatal['comentario'] }}</p>
            @endif
        @else
            <p class="patient-tab-empty">Sin antecedentes perinatales cargados.</p>
        @endif
    </div>

    {{-- Antecedentes patológicos: qué tuvo antes y cómo fue --}}
    <div class="patient-summary-block">
        <h5>Antecedentes patológicos</h5>

        @if($antecedentes['patologicos']->isNotEmpty())
            <ul class="patient-summary-list patient-summary-list--antecedente">
                @foreach($antecedentes['patologicos'] as $antecedente)
                    <li class="patient-summary-list-item--stacked">
                        <div class="patient-summary-med-nombre">{{ $antecedente['nombre'] }}</div>
                        @if($antecedente['comentario'])
                            <div class="patient-summary-med-detalle">{{ $antecedente['comentario'] }}</div>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p class="patient-tab-empty">Sin antecedentes patológicos ni heredofamiliares cargados aún para este paciente.</p>
        @endif
    </div>

</div>