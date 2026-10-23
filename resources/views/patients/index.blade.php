<x-app-layout>

    {{-- Barra de búsqueda --}}
    <x-search-bar :value="request('q', '')" placeholder="Buscar por Nombre, DNI o Historia Clínica..." />

    <div id="patientsResults" aria-live="polite" aria-busy="false">
        {{-- Resultados --}}
        @php
            $hayFiltros =
                request()->filled('q') ||
                request()->filled('sexo') ||
                request()->filled('edad_desde') ||
                request()->filled('edad_hasta') ||
                request()->filled('obra_social') ||
                request()->filled('grupo_sanguineo') ||
                request()->filled('es_cronico') ||
                request()->filled('hc_estado');

            // Código del grupo sanguíneo seleccionado para el chip.
            $grupoSanguineoLabel = null;

            $obraSocialLabel = null;
            if (request()->filled('obra_social')) {
                $obraSocialLabel =
                    $obrasSociales->firstWhere('id', (int) request('obra_social'))?->nombre ??
                    'ID ' . request('obra_social');
            }

            if (request()->filled('grupo_sanguineo')) {
                $grupoSanguineoLabel =
                    $gruposSanguineos->firstWhere('id', (int) request('grupo_sanguineo'))?->codigo ??
                    'ID ' . request('grupo_sanguineo');
            }

            // Etiquetas para el chip de estado de HC.
            $hcEstadoLabels = ['vigente' => 'HC vigente', 'cerrada' => 'HC cerrada'];
        @endphp

        @if ($hayFiltros)
            <p class="search-results-label mt-3">
                {{ $personas->total() }} resultado{{ $personas->total() !== 1 ? 's' : '' }}
                @if (request()->filled('q'))
                    para <strong>"{{ request('q') }}"</strong>
                @endif
                {{-- Chips de filtros activos --}}
                @if (request()->filled('sexo') ||
                        request()->filled('edad_desde') ||
                        request()->filled('edad_hasta') ||
                        request()->filled('obra_social') ||
                        request()->filled('grupo_sanguineo') ||
                        request()->filled('es_cronico') ||
                        request()->filled('hc_estado'))
                    &nbsp;·&nbsp;
                    @if (request()->filled('sexo'))
                        <span class="filter-chip">
                            Sexo: {{ request('sexo') === 'M' ? 'Masculino' : 'Femenino' }}
                            <a href="{{ request()->fullUrlWithoutQuery(['sexo']) }}" class="filter-chip-remove"
                                title="Quitar filtro"><i class="bi bi-x"></i></a>
                        </span>
                    @endif
                    @if (request()->filled('edad_desde') || request()->filled('edad_hasta'))
                        <span class="filter-chip">
                            Edad: {{ request('edad_desde', '0') }}–{{ request('edad_hasta', '120') }} años
                            <a href="{{ request()->fullUrlWithoutQuery(['edad_desde', 'edad_hasta']) }}"
                                class="filter-chip-remove" title="Quitar filtro"><i class="bi bi-x"></i></a>
                        </span>
                    @endif
                    @if ($obraSocialLabel)
                        <span class="filter-chip">
                            <i class="bi bi-building-heart me-1"></i>{{ $obraSocialLabel }}
                            <a href="{{ request()->fullUrlWithoutQuery(['obra_social']) }}" class="filter-chip-remove"
                                title="Quitar filtro"><i class="bi bi-x"></i></a>
                        </span>
                    @endif
                    @if ($grupoSanguineoLabel)
                        <span class="filter-chip">
                            <i class="bi bi-droplet-fill me-1"></i>{{ $grupoSanguineoLabel }}
                            <a href="{{ request()->fullUrlWithoutQuery(['grupo_sanguineo']) }}"
                                class="filter-chip-remove" title="Quitar filtro"><i class="bi bi-x"></i></a>
                        </span>
                    @endif
                    @if (request()->filled('es_cronico'))
                        <span class="filter-chip">
                            <i
                                class="bi bi-activity me-1"></i>{{ request('es_cronico') === '1' ? 'Crónico' : 'No crónico' }}
                            <a href="{{ request()->fullUrlWithoutQuery(['es_cronico']) }}" class="filter-chip-remove"
                                title="Quitar filtro"><i class="bi bi-x"></i></a>
                        </span>
                    @endif
                    @if (request()->filled('hc_estado'))
                        <span class="filter-chip">
                            <i
                                class="bi bi-folder2 me-1"></i>{{ $hcEstadoLabels[request('hc_estado')] ?? request('hc_estado') }}
                            <a href="{{ request()->fullUrlWithoutQuery(['hc_estado']) }}" class="filter-chip-remove"
                                title="Quitar filtro"><i class="bi bi-x"></i></a>
                        </span>
                    @endif
                @endif
            </p>
        @endif

        {{-- Tabla --}}
        <div class="card mt-3">
            <div class="card-body p-0">
                <x-patient-table :patients="$personas->getCollection()->toArray()" :showControl="false" />
            </div>
        </div>

        {{-- Paginación --}}
        @if ($personas->hasPages())
            <div class="mt-3 d-flex justify-content-center">
                {{ $personas->links() }}
            </div>
        @endif
    </div>{{-- /patientsResults --}}

    {{-- ═══════════════════════════════════════════
         PANEL DE FILTROS (drawer derecho)
         ═══════════════════════════════════════════ --}}
    <div id="filtrosOverlay" class="filtros-overlay" aria-hidden="true"></div>

    <aside id="filtrosPanel" class="filtros-panel" aria-label="Filtros de búsqueda" aria-hidden="true">

        <div class="filtros-header">
            <h2 class="filtros-title"><i class="bi bi-funnel me-2"></i>Filtros</h2>
            <button type="button" class="filtros-close" id="cerrarFiltros" aria-label="Cerrar filtros">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <form method="GET" action="{{ route('patients.index') }}" id="filtrosForm" class="filtros-body">
            {{-- Conservar el término de búsqueda --}}
            @if (request()->filled('q'))
                <input type="hidden" name="q" value="{{ request('q') }}">
            @endif

            {{-- ── Sexo ──────────────────────────────── --}}
            <div class="filtro-grupo">
                <label class="filtro-label">Sexo</label>
                <div class="filtro-opciones-row">
                    <label class="filtro-radio-label {{ request('sexo') === 'M' ? 'active' : '' }}">
                        <input type="radio" name="sexo" value="M"
                            {{ request('sexo') === 'M' ? 'checked' : '' }}>
                        <i class="bi bi-gender-male"></i> Masculino
                    </label>
                    <label class="filtro-radio-label {{ request('sexo') === 'F' ? 'active' : '' }}">
                        <input type="radio" name="sexo" value="F"
                            {{ request('sexo') === 'F' ? 'checked' : '' }}>
                        <i class="bi bi-gender-female"></i> Femenino
                    </label>
                </div>
            </div>

            {{-- ── Rango de edad ─────────────────────── --}}
            <div class="filtro-grupo">
                <label class="filtro-label">Rango de edad</label>
                <div class="filtro-rango-row">
                    <div>
                        <label class="filtro-sublabel">Desde</label>
                        <input type="number" name="edad_desde" class="form-control filtro-input-num" min="0"
                            max="120" placeholder="0" value="{{ request('edad_desde', '') }}">
                    </div>
                    <span class="filtro-rango-sep">—</span>
                    <div>
                        <label class="filtro-sublabel">Hasta</label>
                        <input type="number" name="edad_hasta" class="form-control filtro-input-num" min="0"
                            max="120" placeholder="120" value="{{ request('edad_hasta', '') }}">
                    </div>
                </div>
            </div>

            {{-- ── Obra social / financiador ─────────── --}}
            <div class="filtro-grupo">
                <label class="filtro-label" for="filtroObraSocial">Obra social / financiador</label>
                <select id="filtroObraSocial" name="obra_social" class="form-select filtro-input-text">
                    <option value="">Todas</option>
                    @foreach ($obrasSociales as $os)
                        <option value="{{ $os->id }}"
                            {{ request('obra_social') == $os->id ? 'selected' : '' }}>
                            {{ $os->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- ── Grupo sanguíneo ───────────────────── --}}
            @if ($gruposSanguineos->isNotEmpty())
                <div class="filtro-grupo">
                    <label class="filtro-label">Grupo sanguíneo</label>
                    <div class="filtro-opciones-row filtro-opciones-grid">
                        @foreach ($gruposSanguineos as $grupo)
                            <label
                                class="filtro-radio-label filtro-radio-compact {{ request('grupo_sanguineo') == $grupo->id ? 'active' : '' }}">
                                <input type="radio" name="grupo_sanguineo" value="{{ $grupo->id }}"
                                    {{ request('grupo_sanguineo') == $grupo->id ? 'checked' : '' }}>
                                {{ $grupo->codigo }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- ── Paciente crónico ──────────────────── --}}
            <div class="filtro-grupo">
                <label class="filtro-label">Paciente crónico</label>
                <div class="filtro-opciones-row">
                    <label class="filtro-radio-label {{ request('es_cronico') === '1' ? 'active' : '' }}">
                        <input type="radio" name="es_cronico" value="1"
                            {{ request('es_cronico') === '1' ? 'checked' : '' }}>
                        <i class="bi bi-activity"></i> Sí
                    </label>
                    <label class="filtro-radio-label {{ request('es_cronico') === '0' ? 'active' : '' }}">
                        <input type="radio" name="es_cronico" value="0"
                            {{ request('es_cronico') === '0' ? 'checked' : '' }}>
                        <i class="bi bi-dash-circle"></i> No
                    </label>
                </div>
            </div>

            {{-- ── Acciones ──────────────────────────── --}}
            <div class="filtros-actions">
                <a href="{{ route('patients.index', array_filter(['q' => request('q')])) }}"
                    class="btn filtros-btn-limpiar">
                    Limpiar filtros
                </a>
                <button type="submit" class="btn filtros-btn-aplicar filtros-btn-aplicar--primary">
                    Aplicar
                </button>
            </div>
        </form>

    </aside>

    <script>
        (function() {
            const btnAbrir = document.getElementById('botonFiltros');
            const btnCerrar = document.getElementById('cerrarFiltros');
            const panel = document.getElementById('filtrosPanel');
            const overlay = document.getElementById('filtrosOverlay');

            function abrirPanel() {
                panel.classList.add('open');
                overlay.classList.add('visible');
                panel.setAttribute('aria-hidden', 'false');
                overlay.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }

            function cerrarPanel() {
                panel.classList.remove('open');
                overlay.classList.remove('visible');
                panel.setAttribute('aria-hidden', 'true');
                overlay.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            if (btnAbrir) btnAbrir.addEventListener('click', abrirPanel);
            if (btnCerrar) btnCerrar.addEventListener('click', cerrarPanel);
            if (overlay) overlay.addEventListener('click', cerrarPanel);

            // Cerrar con Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') cerrarPanel();
            });

            // Marcar radio buttons activos visualmente al cambiar.
            // Cada grupo (mismo name) se gestiona de forma independiente
            // para no desactivar radios de otros grupos.
            document.querySelectorAll('.filtro-radio-label input[type="radio"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    const grupoName = this.name;
                    document.querySelectorAll(`.filtro-radio-label input[name="${grupoName}"]`).forEach(
                        function(r) {
                            r.closest('.filtro-radio-label').classList.remove('active');
                        });
                    if (this.checked) {
                        this.closest('.filtro-radio-label').classList.add('active');
                    }
                });
            });
        })();
    </script>

</x-app-layout>
