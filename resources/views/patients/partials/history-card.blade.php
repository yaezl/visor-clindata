@php

$consulta = $evento->consulta->first();

$detalle = $consulta?->consultadetalles?->first();

$medico = $consulta?->personal?->persona;

$diagnosticos = collect();

if ($consulta) {
    $diagnosticos = $consulta->consultadetalles
        ->flatMap(fn ($detalle) => $detalle->diagnostico_detalles);
}

$collapseId = 'evento-'.$evento->id;

@endphp

<div
    class="accordion mb-3 historial-item"

    data-tipo="{{ strtolower($evento->tipocontenido->nombre ?? 'consulta') }}"

    data-fecha="{{ \Carbon\Carbon::parse($evento->fechahora)->format('d/m/Y') }}"

    data-texto="
        {{ strtolower($diagnosticos->pluck('diagnostico.nombre')->implode(' ')) }}
        {{ strtolower($detalle?->sintomas_signos ?? '') }}
        {{ strtolower($detalle?->funciones_biologicas ?? '') }}
        {{ strtolower($detalle?->cremiento_desarrollo ?? '') }}
        {{ \Carbon\Carbon::parse($evento->fechahora)->format('d/m/Y') }}
    "

    id="accordion-{{ $evento->id }}">

    <div class="accordion-item border-0 shadow-sm rounded-4 overflow-hidden">

        <h2 class="accordion-header">

            <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#{{ $collapseId }}">

                <div class="w-100">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <span
                                class="badge rounded-pill"
                                style="background:#003764;">

                                {{ $evento->tipocontenido->nombre ?? 'Consulta' }}

                            </span>

                        </div>

                        <small class="text-muted">

                            {{ \Carbon\Carbon::parse($evento->fechahora)->format('d/m/Y H:i') }}

                        </small>

                    </div>

                    <h5
                        class="fw-bold mt-3 mb-2"
                        style="color:#003764;">

                        {{ $diagnosticos->first()?->diagnostico?->nombre ?? 'Sin diagnóstico registrado' }}

                    </h5>

                    @if($medico)

                        <div class="text-muted">

                            Dr./Dra.

                            {{ $medico->apellidos }}

                            {{ $medico->nombres }}

                        </div>

                    @endif

                    @if($diagnosticos->isNotEmpty())

                        <div class="mt-3">

                            @foreach($diagnosticos as $diag)

                                <span
                                    class="badge rounded-pill me-2 mb-2"
                                    style="
                                        background:#C7A36E;
                                        color:white;
                                    ">

                                    {{ $diag->diagnostico->nombre }}

                                </span>

                            @endforeach

                        </div>

                    @endif

                </div>

            </button>

        </h2>

        <div
            id="{{ $collapseId }}"
            class="accordion-collapse collapse">

            <div class="accordion-body">

                @include('patients.partials.history-detail')

            </div>

        </div>

    </div>

</div>