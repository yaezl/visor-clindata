@php

$consulta = $evento->consulta->first();

$detalle = $consulta?->consultadetalles?->first();

$diagnosticos = collect();

if ($consulta) {
    $diagnosticos = $consulta->consultadetalles
        ->flatMap(fn ($d) => $d->diagnostico_detalles);
}

$estudios = $evento->informedeestudios ?? collect();

function lista($texto)
{
    if (!$texto) return [];

    return collect(preg_split('/\r\n|\r|\n/', $texto))
        ->map(fn($item) => trim($item))
        ->filter()
        ->values();
}

@endphp

<div class="container-fluid px-0">

    {{-- Síntomas --}}
    @if($detalle && $detalle->sintomas_signos)

        <div class="mb-4">

            <h6 class="fw-bold text-primary mb-3">
                Síntomas y signos
            </h6>

            <ul class="mb-0">

                @foreach(lista($detalle->sintomas_signos) as $item)

                    <li>{{ $item }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- Funciones biológicas --}}
    @if($detalle && $detalle->funciones_biologicas)

        <div class="mb-4">

            <h6 class="fw-bold text-primary mb-3">
                Funciones biológicas
            </h6>

            <ul class="mb-0">

                @foreach(lista($detalle->funciones_biologicas) as $item)

                    <li>{{ $item }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- Crecimiento --}}
    @if($detalle && $detalle->cremiento_desarrollo)

        <div class="mb-4">

            <h6 class="fw-bold text-primary mb-3">
                Crecimiento y desarrollo
            </h6>

            <ul class="mb-0">

                @foreach(lista($detalle->cremiento_desarrollo) as $item)

                    <li>{{ $item }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- Diagnósticos --}}
    @if($diagnosticos->count())

        <div class="mb-4">

            <h6 class="fw-bold text-primary mb-3">
                Diagnósticos
            </h6>

            <div>

                @foreach($diagnosticos as $diag)

                    <span
                        class="badge rounded-pill me-2 mb-2"
                        style="background:#003764;">

                        {{ $diag->diagnostico->nombre }}

                    </span>

                @endforeach

            </div>

        </div>

    @endif

    {{-- Estudios --}}
    @if($estudios->count())

        <div class="mb-4">

            <h6 class="fw-bold text-primary mb-3">
                Estudios realizados
            </h6>

            <div class="table-responsive">

                <table class="table table-sm align-middle">

                    <thead>

                        <tr>

                            <th>Estudio</th>
                            <th>Diagnóstico</th>
                            <th>Profesional</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($estudios as $estudio)

                            <tr>

                                <td>

                                    {{ optional($estudio->estudio)->nombre ?? '-' }}

                                </td>

                                <td>

                                    {{ optional($estudio->diagnostico)->nombre ?? '-' }}

                                </td>

                                <td>

                                    {{ optional(optional(optional($estudio->usuario)->personal)->persona)->apellidos }}
                                    {{ optional(optional(optional($estudio->usuario)->personal)->persona)->nombres }}

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    @endif

    {{-- Próxima cita --}}
    @if($detalle && $detalle->proxima_cita)

        <div>

            <h6 class="fw-bold text-primary mb-3">
                Próxima cita
            </h6>

            <div class="alert alert-light border mb-0">

                {{ \Carbon\Carbon::parse($detalle->proxima_cita)->format('d/m/Y') }}

            </div>

        </div>

    @endif

</div>