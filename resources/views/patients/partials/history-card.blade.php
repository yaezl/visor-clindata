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

$tipo = $evento->tipocontenido->nombre ?? 'Consulta';

$iconos = [
    'Consulta' => 'stethoscope',
    'Estudio' => 'biotech',
    'Internación' => 'local_hospital',
];

$icono = $iconos[$tipo] ?? 'description';

$diagnosticoPrincipal = $diagnosticos->first()?->diagnostico?->nombre
    ?? 'Sin diagnóstico registrado';

@endphp

<div
    class="accordion history-card historial-item"

    data-tipo="{{ strtolower($tipo) }}"

    data-fecha="{{ optional($evento->fechahora)->format('d/m/Y') }}"

    data-texto="
        {{ strtolower($diagnosticos->pluck('diagnostico.nombre')->implode(' ')) }}
        {{ strtolower($detalle?->sintomas_signos ?? '') }}
        {{ strtolower($detalle?->funciones_biologicas ?? '') }}
        {{ strtolower($detalle?->cremiento_desarrollo ?? '') }}
        {{ optional($evento->fechahora)->format('d/m/Y') }}
    "

    id="accordion-{{ $evento->id }}">

    <div class="accordion-item">

        <h2 class="accordion-header">

            <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#{{ $collapseId }}">

                <div class="history-header">

                    <div class="history-row">

                        <div>

                            <div class="history-type">
                                {{ strtoupper($tipo) }}
                            </div>

                            <div class="history-title">
                                {{ $diagnosticoPrincipal }}
                            </div>

                            @if($medico)
                                <div class="history-doctor">
                                    Dr./Dra.
                                    {{ $medico->nombres }}
                                    {{ $medico->apellidos }}
                                </div>
                            @endif

                        </div>

                        <div class="history-right">

                            <div class="history-date">
                                {{ optional($evento->fechahora)->format('d/m/Y') }}
                            </div>

                            <div class="history-hour">
                                {{ optional($evento->fechahora)->format('H:i') }}
                            </div>

                        </div>

                    </div>

                </div>
            </button>

        </h2>

        <div
            id="{{ $collapseId }}"
            class="accordion-collapse collapse">

            <div class="accordion-body">

                <div class="history-detail">

                    @include('patients.partials.history-detail')

                </div>

            </div>

        </div>

    </div>

</div>