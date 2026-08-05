<x-app-layout>

    <div class="patient-history">

        @include('patients.partials.patient-header')

        @include('patients.partials.search-bar')

        @if($historial->count())

            @include('patients.partials.history-group')

        @else

            @include('patients.partials.empty-state')

        @endif

    </div>

    <script>

        document.addEventListener("DOMContentLoaded", () => {

            const buscador = document.getElementById("buscarHistorial");
            const filtro = document.getElementById("tipoFiltro");

            if (!buscador || !filtro) return;

            const filtrar = () => {

                const texto = buscador.value.toLowerCase().trim();

                const tipo = filtro.value.toLowerCase();

                document.querySelectorAll(".historial-item").forEach(item => {

                    const contenido = (item.dataset.texto || "").toLowerCase();

                    const tipoItem = (item.dataset.tipo || "").toLowerCase();

                    const coincideTexto =
                        texto === "" ||
                        contenido.includes(texto);

                    const coincideTipo =
                        tipo === "" ||
                        tipoItem.includes(tipo);

                    item.style.display =
                        coincideTexto && coincideTipo
                            ? ""
                            : "none";

                });

                document.querySelectorAll(".historial-mes").forEach(mes => {

                    const visibles = mes.querySelectorAll(
                        ".historial-item:not([style*='display: none'])"
                    );

                    mes.style.display =
                        visibles.length
                            ? ""
                            : "none";

                });

            };

            buscador.addEventListener("input", filtrar);

            filtro.addEventListener("change", filtrar);

        });

    </script>

</x-app-layout>