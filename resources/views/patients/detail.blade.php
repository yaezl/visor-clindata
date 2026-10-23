{{--
    Vista de Detalle de Paciente
    ----------------------------
    El header se carga sincrónicamente (liviano: sin eventohcs ni antecedentes).
    Los 4 paneles se cargan lazy vía fetch cuando el usuario los abre por
    primera vez — cada uno tiene su propia ruta en web.php.
--}}

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
                        <span>{{ $edad ?? '—' }}</span>
                        <span class="dot"></span>
                        <span>{{ $persona->sexo === 'M' ? 'Masculino' : ($persona->sexo === 'F' ? 'Femenino' : ($persona->sexo ?? '—')) }}</span>
                        <span class="dot"></span>
                        <span class="blood-badge">{{ $grupo_sanguineo ?? '—' }}</span>
                        <span class="dot"></span>
                        <span>{{ $persona->plans->first()?->obra_social?->nombre ?? '—' }}</span>
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

    {{-- ── 4 acordeones con carga lazy ────────────────────────────── --}}
    @php
        $acordeones = [
            [
                'id'    => 'resumen',
                'icono' => 'bi-clipboard2-pulse',
                'titulo' => 'Resumen',
                'url'   => route('patients.panel.resumen', $persona->id),
            ],
            [
                'id'    => 'antecedentes',
                'icono' => 'bi-journal-medical',
                'titulo' => 'Antecedentes',
                'url'   => route('patients.panel.antecedentes', $persona->id),
            ],
            [
                'id'    => 'vacunacion',
                'icono' => 'bi-shield-plus',
                'titulo' => 'Vacunación',
                'url'   => route('patients.panel.vacunacion', $persona->id),
            ],
            [
                'id'    => 'crecimiento',
                'icono' => 'bi-graph-up-arrow',
                'titulo' => 'Control de crecimiento',
                'url'   => route('patients.panel.crecimiento', $persona->id),
            ],
        ];
    @endphp

    @foreach($acordeones as $acordeon)

        <button
            type="button"
            class="patient-summary-toggle"
            id="toggle-{{ $acordeon['id'] }}"
            data-target="panel-{{ $acordeon['id'] }}"
            data-url="{{ $acordeon['url'] }}"
            aria-expanded="false"
            aria-controls="panel-{{ $acordeon['id'] }}"
        >
            <i class="bi {{ $acordeon['icono'] }}"></i>
            {{ $acordeon['titulo'] }}
            <i class="bi bi-chevron-down toggle-chevron"></i>
        </button>

        <div class="patient-summary-panel" id="panel-{{ $acordeon['id'] }}">
            {{-- El contenido se inyecta vía fetch al primer clic --}}
        </div>

    @endforeach

    <script>
    document.addEventListener('DOMContentLoaded', () => {

        const toggles = document.querySelectorAll('.patient-summary-toggle');

        toggles.forEach(toggle => {
            const panel  = document.getElementById(toggle.dataset.target);
            const url    = toggle.dataset.url;
            let cargado  = false;

            if (!panel) return;

            toggle.addEventListener('click', async () => {
                const abierto = panel.classList.toggle('open');

                toggle.classList.toggle('active', abierto);
                toggle.setAttribute('aria-expanded', abierto ? 'true' : 'false');

                // Cargar contenido solo la primera vez que se abre
                if (abierto && !cargado) {
                    panel.innerHTML = `
                        <div class="panel-loading">
                            <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                            <span>Cargando...</span>
                        </div>`;

                    try {
                        const res  = await fetch(url, {
                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        });

                        if (!res.ok) throw new Error(`HTTP ${res.status}`);

                        panel.innerHTML = await res.text();
                        cargado = true;

                        // Re-inicializar scripts dentro del panel si los hay
                        // (por ejemplo, los gráficos de crecimiento)
                        panel.querySelectorAll('script').forEach(oldScript => {
                            const newScript = document.createElement('script');
                            newScript.textContent = oldScript.textContent;
                            oldScript.replaceWith(newScript);
                        });

                    } catch (err) {
                        panel.innerHTML = `
                            <div class="panel-error">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                No se pudo cargar el panel. Intentá de nuevo.
                                <button class="btn btn-sm btn-link" onclick="this.closest('.patient-summary-panel').previousElementSibling.click(); this.closest('.patient-summary-panel').previousElementSibling.click();">
                                    Reintentar
                                </button>
                            </div>`;
                    }
                }
            });
        });

    });
    </script>

</x-app-layout>