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
        <i class="bi bi-search search-icon"></i>
        <input
            type="search"
            name="q"
            id="searchInput"
            class="form-control search-input"
            placeholder="{{ $placeholder }}"
            value="{{ $value }}"
            autocomplete="off"
        >
    </div>

    <button type="button" class="btn search-filter-btn" id="botonFiltros" title="Filtros">
        <i class="bi bi-funnel"></i>
    </button>
</form>

<script>
(function () {
    const input  = document.getElementById('searchInput');
    const form   = document.getElementById('searchForm');
    if (!input || !form) return;

    let debounceTimer = null;

    input.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        const q = this.value.trim();

        // Solo busca si hay 2+ caracteres o si el campo quedó vacío (para mostrar todos)
        // Espera 600ms después de que el usuario DEJA de escribir
        if (q.length === 0 || q.length >= 2) {
            debounceTimer = setTimeout(function () {
                form.submit();
            }, 500);
        }
    });
})();
</script>