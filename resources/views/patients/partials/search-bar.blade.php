<div class="search-form">

    <select id="tipoFiltro" class="form-select" style="max-width:180px;">
        <option value="">Todos</option>
        <option value="consulta">Consultas</option>
        <option value="internacion">Internaciones</option>
        <option value="estudio">Estudios</option>
    </select>

    <div class="search-input-wrapper">

        <span class="material-symbols-outlined search-icon">
            search
        </span>

        <input
            type="text"
            id="buscarHistorial"
            class="form-control search-input"
            placeholder="Buscar por diagnóstico, médico, síntomas o fecha...">

    </div>

    <a href="{{ route('patients.export-pdf', $persona->id) }}"
        class="btn-detail-history"
        title="Exportar historial médico a PDF">

        <span class="material-symbols-outlined">
            picture_as_pdf
        </span>

        Exportar PDF

    </a>

</div>