@php
    $consulta = $evento->consulta->first();
    $detalle = $consulta?->consultadetalles?->first();

    $diagnosticos = collect();

    if ($consulta) {
        $diagnosticos = $consulta->consultadetalles
            ->flatMap(fn ($d) => $d->diagnostico_detalles);
    }

    $estudios = $evento->informedeestudios ?? collect();
@endphp

<div class="history-detail">

    @if($detalle?->sintomas_signos)
        <div class="detail-section">
            <div class="detail-title">
                <span class="material-symbols-outlined">stethoscope</span>
                Consulta
            </div>

            <div class="detail-content">{{ trim($detalle->sintomas_signos) }}</div>
        </div>
    @endif


    @if($detalle?->funciones_biologicas)
        <div class="detail-section">
            <div class="detail-title">
                <span class="material-symbols-outlined">pediatrics</span>
                Funciones biológicas
            </div>

            <div class="detail-content">{{ trim($detalle->funciones_biologicas) }}</div>
        </div>
    @endif


    @if($detalle?->cremiento_desarrollo)
        <div class="detail-section">
            <div class="detail-title">
                <span class="material-symbols-outlined">trending_up</span>
                Crecimiento y desarrollo
            </div>

            <div class="detail-content">{{ trim($detalle->cremiento_desarrollo) }}</div>
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


    @if($estudios->isNotEmpty())
        <div class="detail-section">
            <div class="detail-title">
                <span class="material-symbols-outlined">biotech</span>
                Estudios realizados
            </div>

            <div class="study-table">
                <table class="table table-sm mb-0">
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
                            <td>{{ optional($estudio->estudio)->nombre ?? '-' }}</td>
                            <td>{{ optional($estudio->diagnostico)->nombre ?? '-' }}</td>
                            <td>{{ optional(optional(optional($estudio->usuario)->personal)->persona)->nombre_completo ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>