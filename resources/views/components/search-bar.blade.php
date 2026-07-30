@props([
    'value'       => '',
    'placeholder' => 'Buscar por Nombre, DNI o Historia Clínica...',
    'action'      => '',
])

<form
    method="GET"
    action="{{ $action ?: route('patients.index') }}"
    class="search-form"
    role="search"
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