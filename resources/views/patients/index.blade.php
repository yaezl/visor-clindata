<x-app-layout>

    {{-- Barra de búsqueda --}}
    <x-search-bar
        :value="request('q', '')"
        placeholder="Buscar por Nombre, DNI o Historia Clínica..."
    />

    {{-- Resultados --}}
    @php
        $hayFiltros = request()->filled('q')
            || request()->filled('sexo')
            || request()->filled('edad_desde')
            || request()->filled('edad_hasta')
            || request()->filled('obra_social');
    @endphp

    @if ($hayFiltros)
        <p class="search-results-label mt-3">
            {{ $personas->total() }} resultado{{ $personas->total() !== 1 ? 's' : '' }}
            @if (request()->filled('q'))
                para <strong>"{{ request('q') }}"</strong>
            @endif
            {{-- Chips de filtros activos --}}
            @if (request()->filled('sexo') || request()->filled('edad_desde') || request()->filled('edad_hasta') || request()->filled('obra_social'))
                &nbsp;·&nbsp;
                @if (request()->filled('sexo'))
                    <span class="filter-chip">
                        Sexo: {{ request('sexo') === 'M' ? 'Masculino' : 'Femenino' }}
                        <a href="{{ request()->fullUrlWithoutQuery(['sexo']) }}" class="filter-chip-remove" title="Quitar filtro"><i class="bi bi-x"></i></a>
                    </span>
                @endif
                @if (request()->filled('edad_desde') || request()->filled('edad_hasta'))
                    <span class="filter-chip">
                        Edad: {{ request('edad_desde', '0') }}–{{ request('edad_hasta', '120') }} años
                        <a href="{{ request()->fullUrlWithoutQuery(['edad_desde','edad_hasta']) }}" class="filter-chip-remove" title="Quitar filtro"><i class="bi bi-x"></i></a>
                    </span>
                @endif
                @if (request()->filled('obra_social'))
                    <span class="filter-chip">
                        Obra social: {{ request('obra_social') }}
                        <a href="{{ request()->fullUrlWithoutQuery(['obra_social']) }}" class="filter-chip-remove" title="Quitar filtro"><i class="bi bi-x"></i></a>
                    </span>
                @endif
            @endif
        </p>
    @endif

    {{-- Tabla --}}
    <div class="card mt-3">
        <div class="card-body p-0">
            <x-patient-table
                :patients="$personas->getCollection()->toArray()"
                :showControl="false"
            />
        </div>
    </div>

    {{-- Paginación --}}
    @if ($personas->hasPages())
        <div class="mt-3 d-flex justify-content-center">
            {{ $personas->links() }}
        </div>
    @endif

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
                        <input type="radio" name="sexo" value="M" {{ request('sexo') === 'M' ? 'checked' : '' }}>
                        <i class="bi bi-gender-male"></i> Masculino
                    </label>
                    <label class="filtro-radio-label {{ request('sexo') === 'F' ? 'active' : '' }}">
                        <input type="radio" name="sexo" value="F" {{ request('sexo') === 'F' ? 'checked' : '' }}>
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
                        <input
                            type="number"
                            name="edad_desde"
                            class="form-control filtro-input-num"
                            min="0" max="120"
                            placeholder="0"
                            value="{{ request('edad_desde', '') }}"
                        >
                    </div>
                    <span class="filtro-rango-sep">—</span>
                    <div>
                        <label class="filtro-sublabel">Hasta</label>
                        <input
                            type="number"
                            name="edad_hasta"
                            class="form-control filtro-input-num"
                            min="0" max="120"
                            placeholder="120"
                            value="{{ request('edad_hasta', '') }}"
                        >
                    </div>
                </div>
            </div>

            {{-- ── Obra social ───────────────────────── --}}
            <div class="filtro-grupo">
                <label class="filtro-label" for="filtroObraSocial">Obra social / financiador</label>
                <input
                    type="text"
                    id="filtroObraSocial"
                    name="obra_social"
                    class="form-control filtro-input-text"
                    placeholder="Ej: OSDE, PAMI, Particular..."
                    value="{{ request('obra_social', '') }}"
                    autocomplete="off"
                >
            </div>

            {{-- ── Acciones ──────────────────────────── --}}
            <div class="filtros-actions">
                <a href="{{ route('patients.index', array_filter(['q' => request('q')])) }}"
                   class="btn filtros-btn-limpiar">
                    Limpiar filtros
                </a>
                <button type="submit" class="btn filtros-btn-aplicar">
                    Aplicar
                </button>
            </div>
        </form>

    </aside>

    <script>
    (function () {
        const btnAbrir  = document.getElementById('botonFiltros');
        const btnCerrar = document.getElementById('cerrarFiltros');
        const panel     = document.getElementById('filtrosPanel');
        const overlay   = document.getElementById('filtrosOverlay');

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

        if (btnAbrir)  btnAbrir.addEventListener('click', abrirPanel);
        if (btnCerrar) btnCerrar.addEventListener('click', cerrarPanel);
        if (overlay)   overlay.addEventListener('click', cerrarPanel);

        // Cerrar con Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') cerrarPanel();
        });

        // Marcar radio buttons activos visualmente al cambiar
        document.querySelectorAll('.filtro-radio-label input[type="radio"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                document.querySelectorAll('.filtro-radio-label').forEach(function (lbl) {
                    lbl.classList.remove('active');
                });
                if (this.checked) {
                    this.closest('.filtro-radio-label').classList.add('active');
                }
            });
        });
    })();
    </script>

</x-app-layout>