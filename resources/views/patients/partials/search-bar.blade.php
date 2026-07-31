<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body">

        <div class="row g-3 align-items-center">

            {{-- Filtro --}}
            <div class="col-lg-2 col-md-3">

                <select
                    class="form-select rounded-3 border-2"
                    id="tipoFiltro">

                    <option value="">
                        Todos
                    </option>

                    <option value="consulta">
                        Consultas
                    </option>

                    <option value="diagnostico">
                        Diagnósticos
                    </option>

                    <option value="laboratorio">
                        Estudios
                    </option>

                    <option value="vacunas">
                        Vacunas
                    </option>

                    <option value="internacion">
                        Internaciones
                    </option>

                </select>

            </div>

            {{-- Buscador --}}
            <div class="col-lg-8 col-md-6">

                <div class="input-group">

                    <span class="input-group-text bg-white border-end-0">

                        <span class="material-symbols-outlined">
                            search
                        </span>

                    </span>

                    <input
                        type="text"
                        class="form-control border-start-0 ps-0"
                        id="buscarHistorial"
                        placeholder="Buscar por diagnóstico, síntomas, evolución o fecha...">

                </div>

            </div>

            {{-- PDF --}}
            <div class="col-lg-2 col-md-3">

                <button
                    class="btn w-100 rounded-3 fw-semibold"

                    style="
                        background:#003764;
                        color:white;
                    ">

                    <span class="material-symbols-outlined align-middle me-1">
                        picture_as_pdf
                    </span>

                    PDF

                </button>

            </div>

        </div>

    </div>

</div>