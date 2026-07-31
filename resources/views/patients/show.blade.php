<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Historial Clínico -
        {{ $persona->nombres }}
        {{ $persona->apellidos }}
    </title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Montserrat --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Google Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <style>

        :root{
            --primary:#003764;
            --secondary:#C7A36E;
            --text:#59595B;
            --background:#F7F9FB;
            --border:#E5E7EB;
        }

        body{
            background:var(--background);
            font-family:'Montserrat',sans-serif;
            color:var(--text);
        }

        .page-container{
            max-width:1300px;
            margin:auto;
            padding:40px 20px;
        }

    </style>

</head>

<body>

<div class="page-container">

    {{-- Cabecera paciente --}}
    @include('patients.partials.patient-header')

    {{-- Barra buscador --}}
    @include('patients.partials.search-bar')

    {{-- Historial --}}
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

    const filtrar = () => {

        const texto = buscador.value.toLowerCase().trim();
        const tipo = filtro.value.toLowerCase();

        // Recorremos todos los eventos
        document.querySelectorAll(".historial-item").forEach(item => {

            const contenido = (item.dataset.texto || "").toLowerCase();
            const tipoItem = (item.dataset.tipo || "").toLowerCase();

            const coincideTexto =
                texto === "" || contenido.includes(texto);

            const coincideTipo =
                tipo === "" || tipoItem.includes(tipo);

            item.style.display =
                coincideTexto && coincideTipo
                    ? ""
                    : "none";

        });

        // Mostrar u ocultar cada mes según tenga eventos visibles
        document.querySelectorAll(".historial-mes").forEach(mes => {

            const visibles = mes.querySelectorAll(
                ".historial-item:not([style*='display: none'])"
            );

            mes.style.display =
                visibles.length > 0
                    ? ""
                    : "none";

        });

    };

    buscador.addEventListener("input", filtrar);

    filtro.addEventListener("change", filtrar);

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>