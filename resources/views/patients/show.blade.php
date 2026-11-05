<x-app-layout>

    <div class="patient-history">

        @include('patients.partials.patient-header')

        @include('patients.partials.search-bar')

        @if($historial->count())

            @include('patients.partials.history-group')

            <div id="sinResultados" class="history-no-results d-none">
                No hay registros que coincidan con la búsqueda.
            </div>

            <div class="history-more">
                <button type="button" id="verMas" class="btn-ver-mas d-none"></button>
            </div>

        @else

            @include('patients.partials.empty-state')

        @endif

    </div>

    <script>

        document.addEventListener("DOMContentLoaded", () => {

            const POR_PAGINA = 10;

            const buscador      = document.getElementById("buscarHistorial");
            const desde         = document.getElementById("fechaDesde");
            const hasta         = document.getElementById("fechaHasta");
            const btnLimpiar    = document.getElementById("limpiarFiltros");
            const selTodos      = document.getElementById("seleccionarTodos");
            const resumen       = document.getElementById("resumenResultados");
            const btnVerMas     = document.getElementById("verMas");
            const sinResultados = document.getElementById("sinResultados");
            const form          = document.getElementById("exportForm");
            const inputIds      = document.getElementById("idsExportar");
            const btnTexto      = document.getElementById("btnExportarTexto");

            const items = Array.from(document.querySelectorAll(".historial-item"));
            const meses = Array.from(document.querySelectorAll(".historial-mes"));

            if (!buscador || !items.length) return;

            let limite = POR_PAGINA;
            let coincidentes = items;

            // Ids seleccionados para exportar (persisten aunque cambien los filtros)
            const seleccionados = new Set();

            const checkDe = item => item.querySelector(".historial-check");

            // Si el navegador restauró checkboxes marcados (atrás/adelante), los tomamos
            items.forEach(item => {
                if (checkDe(item).checked) seleccionados.add(item.dataset.id);
            });

            const coincide = item => {

                const texto = buscador.value.toLowerCase().trim();
                const contenido = (item.dataset.texto || "").toLowerCase();
                const fecha = item.dataset.fecha || ""; // YYYY-MM-DD

                return (texto === "" || contenido.includes(texto))
                    && (!desde.value || fecha >= desde.value)
                    && (!hasta.value || fecha <= hasta.value);

            };

            const actualizarSeleccion = () => {

                const marcados = coincidentes
                    .filter(item => seleccionados.has(item.dataset.id)).length;

                selTodos.disabled = coincidentes.length === 0;
                selTodos.checked = coincidentes.length > 0 && marcados === coincidentes.length;
                selTodos.indeterminate = marcados > 0 && marcados < coincidentes.length;

                btnTexto.textContent = seleccionados.size
                    ? `Exportar selección (${seleccionados.size})`
                    : "Exportar todo";

            };

            const aplicar = (resetear = true) => {

                if (resetear) limite = POR_PAGINA;

                coincidentes = items.filter(coincide);

                const visibles = new Set(coincidentes.slice(0, limite));

                items.forEach(item => {
                    item.classList.toggle("d-none", !visibles.has(item));
                });

                meses.forEach(mes => {
                    mes.classList.toggle(
                        "d-none",
                        !mes.querySelector(".historial-item:not(.d-none)")
                    );
                });

                const restantes = coincidentes.length - visibles.size;

                btnVerMas.classList.toggle("d-none", restantes <= 0);
                btnVerMas.textContent = `Ver más (${restantes} restantes)`;

                sinResultados.classList.toggle("d-none", coincidentes.length > 0);

                resumen.textContent = `${coincidentes.length} de ${items.length} registros`;

                actualizarSeleccion();

            };

            // Filtros
            buscador.addEventListener("input", () => aplicar());
            desde.addEventListener("change", () => aplicar());
            hasta.addEventListener("change", () => aplicar());

            // Limpiar búsqueda y fechas sin alterar las consultas seleccionadas.
            btnLimpiar?.addEventListener("click", () => {
                buscador.value = "";
                desde.value = "";
                hasta.value = "";
                aplicar();
            });

            // Ver más
            btnVerMas.addEventListener("click", () => {
                limite += POR_PAGINA;
                aplicar(false);
            });

            // Checkbox de cada consulta
            items.forEach(item => {
                checkDe(item).addEventListener("change", e => {
                    if (e.target.checked) seleccionados.add(item.dataset.id);
                    else seleccionados.delete(item.dataset.id);
                    actualizarSeleccion();
                });
            });

            // Seleccionar todos los resultados (los que matchean búsqueda/fechas,
            // estén o no desplegados con "Ver más")
            selTodos.addEventListener("change", () => {
                coincidentes.forEach(item => {
                    checkDe(item).checked = selTodos.checked;
                    if (selTodos.checked) seleccionados.add(item.dataset.id);
                    else seleccionados.delete(item.dataset.id);
                });
                actualizarSeleccion();
            });

            // Exportar: sin selección se manda vacío y se exporta todo
            form.addEventListener("submit", () => {
                inputIds.value = Array.from(seleccionados).join(",");
            });

            aplicar();

        });

    </script>

</x-app-layout>
