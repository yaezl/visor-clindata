<div class="search-form">

    <div class="search-input-wrapper">

        <span class="material-symbols-outlined search-icon">
            search
        </span>

        <input
            type="text"
            id="buscarHistorial"
            class="form-control search-input"
            placeholder="Buscar por diagnóstico, médico o síntomas...">

    </div>

    <div class="date-filter">
        <label for="fechaDesde">Desde</label>
        <input type="date" id="fechaDesde" class="form-control">
    </div>

    <div class="date-filter">
        <label for="fechaHasta">Hasta</label>
        <input type="date" id="fechaHasta" class="form-control">
    </div>

    <button type="button" id="limpiarFiltros" class="btn-clear-filters">
        <span class="material-symbols-outlined">filter_alt_off</span>
        <span>Limpiar filtros</span>
    </button>

    {{-- POST: los ids seleccionados se cargan por JS en #idsExportar --}}
    <form id="exportForm"
        method="POST"
        action="{{ route('patients.export-pdf', $persona->id) }}"
        class="m-0">

        @csrf

        <input type="hidden" name="ids" id="idsExportar" value="">

        <button type="submit"
            class="btn-detail-history"
            title="Sin selección se exporta todo el historial">

            <span class="material-symbols-outlined">
                picture_as_pdf
            </span>

            <span id="btnExportarTexto">Exportar todo</span>

        </button>

    </form>

</div>

<div class="history-toolbar">

    <label class="select-all">
        <input type="checkbox" id="seleccionarTodos" class="form-check-input">
        <span>Seleccionar todos los resultados</span>
    </label>

    <span id="resumenResultados" class="history-toolbar-info"></span>

</div>
