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

<div class="accordion history-card historial-item"
    data-tipo="{{ strtolower($tipo) }}"
    data-fecha="{{ optional($evento->fechahora)->format('d/m/Y') }}"
    data-texto="
        {{ strtolower($diagnosticos->pluck('diagnostico.nombre')->implode(' ')) }}
        {{ strtolower($detalle?->sintomas_signos ?? '') }}
        {{ strtolower($detalle?->funciones_biologicas ?? '') }}
        {{ strtolower($detalle?->cremiento_desarrollo ?? '') }}
        {{ strtolower(trim(($medico->nombres ?? '').' '.($medico->apellidos ?? ''))) }}
        {{ optional($evento->fechahora)->format('d/m/Y') }}
    "
    id="accordion-{{ $evento->id }}">

    <div class="accordion-item">

        <h2 class="accordion-header">

            <button class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#{{ $collapseId }}">

                <div class="history-header">

                    <div class="history-row">

                        <div class="history-left">

                            <div class="history-type">{{ strtoupper($tipo) }}</div>

                            <div class="history-title">
                                {{ $diagnosticoPrincipal }}
                            </div>

                            @if($medico)
                                <div class="history-doctor">
                                    Dr./Dra. {{ $medico->nombres }} {{ $medico->apellidos }}
                                </div>
                            @endif

                        </div>

                        <div class="history-right">
                            <div class="history-date">
                                {{ optional($evento->fechahora)->format('d/m/Y') }}
                            </div>

                            <div class="history-hour">
                                {{ optional($evento->fechahora)->format('H:i') }} hs
                            </div>
                        </div>

                    </div>

                </div>

            </button>

        </h2>

        <div id="{{ $collapseId }}" class="accordion-collapse collapse">

            <div class="accordion-body">

                <div class="history-detail">

@if($detalle?->sintomas_signos)
<div class="detail-section">
    <div class="detail-title">
        <span class="material-symbols-outlined">stethoscope</span>
        Consulta
    </div>

    <div class="diagnosis-list">
        @foreach(preg_split('/\r\n|\r|\n/', trim($detalle->sintomas_signos)) as $item)
            @if(trim($item))
                <div class="diagnosis-item">{{ trim($item) }}</div>
            @endif
        @endforeach
    </div>
</div>
@endif

@if($detalle?->funciones_biologicas)
<div class="detail-section">
    <div class="detail-title">
        <span class="material-symbols-outlined">pediatrics</span>
        Funciones biológicas
    </div>

    <div class="diagnosis-list">
        @foreach(preg_split('/\r\n|\r|\n/', trim($detalle->funciones_biologicas)) as $item)
            @if(trim($item))
                <div class="diagnosis-item">{{ trim($item) }}</div>
            @endif
        @endforeach
    </div>
</div>
@endif

@if($detalle?->cremiento_desarrollo)
<div class="detail-section">
    <div class="detail-title">
        <span class="material-symbols-outlined">trending_up</span>
        Crecimiento y desarrollo
    </div>

    <div class="diagnosis-list">
        @foreach(preg_split('/\r\n|\r|\n/', trim($detalle->cremiento_desarrollo)) as $item)
            @if(trim($item))
                <div class="diagnosis-item">{{ trim($item) }}</div>
            @endif
        @endforeach
    </div>
</div>
@endif

@if($diagnosticos->isNotEmpty())
<div class="detail-section">
    <div class="detail-title">
        <span class="material-symbols-outlined">diagnosis</span>
        Diagnósticos
    </div>

    <div class="diagnosis-list">
        @foreach($diagnosticos as $diag)
            <div class="diagnosis-item">
                {{ $diag->diagnostico->nombre }}
            </div>
        @endforeach
    </div>
</div>
@endif

                </div>

            </div>

        </div>

    </div>

</div>