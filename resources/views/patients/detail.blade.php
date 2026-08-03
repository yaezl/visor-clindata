{{--
    Vista de Detalle de Paciente
    ----------------------------
    Datos reales conectados vía PersonaController@detail -> PersonaService@buscarParaDetalle.

    Los 4 bloques (Resumen, Antecedentes, Vacunación, Control de
    crecimiento) son acordeones idénticos en look & feel. El contenido
    de cada uno vive en su propio partial bajo patients/partials/, para
    poder editarlos sin tocar este archivo.
--}}

@php
    // Resumen generado por plantilla (sin IA): concatenación de datos reales.
    $resumen = "Paciente de {$edad} años en seguimiento regular. "
        . "Presenta {$alergias_count} " . ($alergias_count === 1 ? 'alergia registrada' : 'alergias registradas')
        . ($tiene_medicacion_activa ? " y medicación activa." : " y sin medicación activa.");

    // Cada acordeón: id, icono, título y el partial que renderiza su contenido.
    $acordeones = [
        [
            'id' => 'resumen',
            'icono' => 'bi-clipboard2-pulse',
            'titulo' => 'Resumen',
            'partial' => 'patients.partials.summary-expandable',
        ],
        [
            'id' => 'antecedentes',
            'icono' => 'bi-journal-medical',
            'titulo' => 'Antecedentes',
            'partial' => 'patients.partials.antecedentes-expandable',
        ],
        [
            'id' => 'vacunacion',
            'icono' => 'bi-shield-plus',
            'titulo' => 'Vacunación',
            'partial' => 'patients.partials.vacunacion-expandable',
        ],
        [
            'id' => 'crecimiento',
            'icono' => 'bi-graph-up-arrow',
            'titulo' => 'Control de crecimiento',
            'partial' => 'patients.partials.crecimiento-expandable',
        ],
    ];
@endphp

<x-app-layout>

    {{-- Botón volver --}}
    <a href="{{ route('patients.index') }}" class="patient-back-link">
        <i class="bi bi-arrow-left"></i>
        Volver
    </a>

    {{-- ── Header de paciente ─────────────────────────────────────── --}}
    <div class="patient-detail-header">

        <div class="patient-detail-header-top">

            <div class="patient-detail-identity">

                <div class="patient-detail-avatar">
                    {{ $iniciales }}
                </div>

                <div>
                    <h2 class="patient-detail-name">{{ $persona->nombre_completo }}</h2>

                    <div class="patient-detail-meta">
                        <span>{{ $edad ?? '—' }} años</span>
                        <span class="dot"></span>
                        <span>{{ $persona->sexo === 'M' ? 'Masculino' : ($persona->sexo === 'F' ? 'Femenino' : ($persona->sexo ?? '—')) }}</span>
                        <span class="dot"></span>
                        <span class="blood-badge">{{ $grupo_sanguineo ?? '—' }}</span>
                    </div>
                </div>

            </div>

            <a href="{{ route('patients.show', $persona->id) }}" class="btn-detail-history">
                <i class="bi bi-clipboard2-heart"></i>
                Historia Clínica
            </a>

        </div>

        {{-- Fila de info clínica clave para el médico --}}
        <div class="patient-detail-info-row">

            <div class="patient-info-chip">
                <span class="patient-info-chip-label">DNI / HC</span>
                <span class="patient-info-chip-value">
                    DNI: {{ $persona->documento ?? '—' }} — HC: {{ $persona->nro_hc ?? '—' }}
                </span>
            </div>

            <div class="patient-info-chip">
                <span class="patient-info-chip-label">Patologías</span>
                <span class="patient-info-chip-value {{ $patologias->isNotEmpty() ? 'text-danger' : '' }}">
                    {{ $patologias->isNotEmpty() ? $patologias->implode(', ') : 'Sin registros' }}
                </span>
            </div>

            <div class="patient-info-chip">
                <span class="patient-info-chip-label">Última consulta</span>
                <span class="patient-info-chip-value">
                    {{ $ultima_consulta_fecha ? $ultima_consulta_fecha->format('d/m/Y') : 'Sin consultas registradas' }}
                </span>
                @if($ultima_consulta_medico)
                    <span class="patient-info-chip-sub">{{ $ultima_consulta_medico }}</span>
                @endif
            </div>

            <div class="patient-info-chip">
                <span class="patient-info-chip-label">Cant. de consultas</span>
                <span class="patient-info-chip-value">{{ $cantidad_consultas }}</span>
            </div>

        </div>

    </div>

    {{-- ── 4 acordeones: Resumen, Antecedentes, Vacunación, Crecimiento ── --}}
    @foreach($acordeones as $acordeon)

        <button
            type="button"
            class="patient-summary-toggle"
            id="toggle-{{ $acordeon['id'] }}"
            data-target="panel-{{ $acordeon['id'] }}"
            aria-expanded="false"
            aria-controls="panel-{{ $acordeon['id'] }}"
        >
            <i class="bi {{ $acordeon['icono'] }}"></i>
            {{ $acordeon['titulo'] }}
            <i class="bi bi-chevron-down"></i>
        </button>

        <div class="patient-summary-panel" id="panel-{{ $acordeon['id'] }}">
            @include($acordeon['partial'])
        </div>

    @endforeach

    {{-- ── Scripts: acordeones (vanilla JS, sin dependencias) ──────── --}}
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        const toggles = document.querySelectorAll('.patient-summary-toggle');

        toggles.forEach(toggle => {
            const panel = document.getElementById(toggle.dataset.target);

            if (!panel) {
                return;
            }

            toggle.addEventListener('click', () => {
                const abierto = panel.classList.toggle('open');

                toggle.classList.toggle('active', abierto);
                toggle.setAttribute('aria-expanded', abierto ? 'true' : 'false');
            });
        });

    });
    </script>

</x-app-layout>