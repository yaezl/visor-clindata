{{--
    Vista de Detalle de Paciente
    ----------------------------
    Datos reales conectados vía PersonaController@detail -> PersonaService@buscarParaDetalle.
--}}

@php
    // Resumen generado por plantilla (sin IA): concatenación de datos reales.
    $resumen = "Paciente de {$edad} años en seguimiento regular. "
        . "Presenta {$alergias_count} " . ($alergias_count === 1 ? 'alergia registrada' : 'alergias registradas')
        . ($tiene_medicacion_activa ? " y medicación activa." : " y sin medicación activa.");
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

    {{-- ── 4 tabs principales ─────────────────────────────────────── --}}
    <div class="patient-main-tabs" role="tablist">

        <button type="button" class="patient-main-tab" data-tab="resumen">
            <i class="bi bi-clipboard2-pulse"></i>
            Resumen
        </button>

        <button type="button" class="patient-main-tab" data-tab="antecedentes">
            <i class="bi bi-journal-medical"></i>
            Antecedentes
        </button>

        <button type="button" class="patient-main-tab" data-tab="vacunacion">
            <i class="bi bi-shield-plus"></i>
            Vacunación
        </button>

        <button type="button" class="patient-main-tab" data-tab="crecimiento">
            <i class="bi bi-graph-up-arrow"></i>
            Control de crecimiento
        </button>

    </div>

    {{-- ── Panel de contenido según tab activo ────────────────────── --}}
    <div class="patient-tab-panel" data-panel="resumen">
        <h4>Resumen</h4>
        <p class="mb-0">{{ $resumen }}</p>
    </div>

    <div class="patient-tab-panel d-none" data-panel="antecedentes">
        <h4>Antecedentes</h4>
        <p class="patient-tab-empty">
            Sin antecedentes patológicos ni heredofamiliares cargados aún para este paciente.
        </p>
    </div>

    <div class="patient-tab-panel d-none" data-panel="vacunacion">
        <h4>Alertas de vacunación</h4>
        <p class="patient-tab-empty">
            No hay alertas de vacunación cargadas para este paciente.
        </p>
    </div>

    <div class="patient-tab-panel d-none" data-panel="crecimiento">
        <h4>Control de crecimiento y desarrollo</h4>
        <p class="patient-tab-empty">
            Aún no hay mediciones de peso y talla cargadas para este paciente.
        </p>
    </div>

    {{-- ── Scripts: tabs (vanilla JS, sin dependencias) ────────────── --}}
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        const tabs = document.querySelectorAll('.patient-main-tab');
        const panels = document.querySelectorAll('.patient-tab-panel');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.dataset.tab;

                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                panels.forEach(p => {
                    p.classList.toggle('d-none', p.dataset.panel !== target);
                });
            });
        });

    });
    </script>

</x-app-layout>