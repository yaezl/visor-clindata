@props([
    'value'       => '',
    'placeholder' => 'Buscar por Nombre, DNI o Historia Clínica...',
    'action'      => '',
])

@php $searchAction = $action ?: route('patients.index'); @endphp

<form
    method="GET"
    action="{{ $searchAction }}"
    class="search-form"
    role="search"
    id="searchForm"
>
    <div class="search-input-wrapper">
        <i class="bi bi-search search-icon" aria-hidden="true"></i>
        <input
            type="search"
            name="q"
            id="searchInput"
            class="form-control search-input"
            placeholder="{{ $placeholder }}"
            value="{{ $value }}"
            autocomplete="off"
            aria-label="{{ $placeholder }}"
        >
    </div>

    <button type="button" class="btn search-filter-btn" id="botonFiltros" title="Filtros" aria-label="Abrir filtros">
        <i class="bi bi-funnel" aria-hidden="true"></i>
    </button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
(function () {
    const input = document.getElementById('searchInput');
    const form = document.getElementById('searchForm');
    const results = document.getElementById('patientsResults');

    if (!input || !form || !results) return;

    let timer = null;
    let controller = null;
    let ultimaBusqueda = input.value.trim();

    function sincronizarFiltroOculto(q) {
        const filtroForm = document.getElementById('filtrosForm');
        if (!filtroForm) return;

        let hidden = filtroForm.querySelector('input[name="q"]');
        if (q) {
            if (!hidden) {
                hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'q';
                filtroForm.appendChild(hidden);
            }
            hidden.value = q;
        } else if (hidden) {
            hidden.remove();
        }
    }

    async function buscar(q) {
        q = q.trim();
        if (q === ultimaBusqueda && results.dataset.loaded === 'true') return;
        ultimaBusqueda = q;

        if (controller) controller.abort();
        const solicitud = new AbortController();
        controller = solicitud;

        // Mantiene los filtros activos, pero reinicia la paginación al cambiar la búsqueda.
        const url = new URL(form.action, window.location.origin);
        const actual = new URL(window.location.href);
        actual.searchParams.forEach((value, key) => {
            if (!['q', 'page', 'mes', 'fecha'].includes(key)) {
                url.searchParams.set(key, value);
            }
        });

        if (q) url.searchParams.set('q', q);
        else url.searchParams.delete('q');

        url.searchParams.delete('page');
        sincronizarFiltroOculto(q);

        results.setAttribute('aria-busy', 'true');
        results.classList.add('search-results-loading');

        try {
            const response = await fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                },
                signal: solicitud.signal
            });

            if (!response.ok) throw new Error('No se pudieron cargar los resultados.');

            const html = await response.text();
            const documento = new DOMParser().parseFromString(html, 'text/html');
            const nuevosResultados = documento.getElementById('patientsResults');

            if (!nuevosResultados) throw new Error('La respuesta no contiene los resultados de pacientes.');

            results.innerHTML = nuevosResultados.innerHTML;
            results.dataset.loaded = 'true';

            const nuevaUrl = url.pathname + url.search;
            window.history.replaceState({}, '', nuevaUrl);
        } catch (error) {
            if (error.name !== 'AbortError') {
                console.error('Error al buscar pacientes:', error);
            }
        } finally {
            if (controller === solicitud) {
                results.setAttribute('aria-busy', 'false');
                results.classList.remove('search-results-loading');
            }
        }
    }

    input.addEventListener('input', function () {
        clearTimeout(timer);
        const q = this.value.trim();

        // No se exige una cantidad mínima de caracteres: también se buscan términos de una letra
        // y al borrar el texto se recupera el listado completo.
        timer = setTimeout(() => buscar(q), 300);
    });

    // Enter ejecuta la búsqueda inmediatamente, sin recargar la página.
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        clearTimeout(timer);
        buscar(input.value);
    });

    // Sincroniza el estado inicial por si la página se abrió con una búsqueda en la URL.
    sincronizarFiltroOculto(input.value.trim());
})();
});
</script>
