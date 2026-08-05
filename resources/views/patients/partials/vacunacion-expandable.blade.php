{{--
    Panel de Vacunación — informativo, solo por edad.
    ──────────────────────────────────────────────────
    Variables que recibe:
      $vacunacion['ya_aplicadas']   Collection
      $vacunacion['este_anio']      Collection
      $vacunacion['edad_anios']     int|null
      $vacunacion['sin_fecha_nac']  bool

    Cada vacuna: ['nombre', 'dosis', 'cuando']
--}}

<div class="vac-content">

    @if ($vacunacion['sin_fecha_nac'])
        <p class="vac-aviso">
            <i class="bi bi-info-circle" aria-hidden="true"></i>
            Sin fecha de nacimiento registrada. Se muestra el calendario completo.
        </p>
    @endif

    {{-- BLOQUE 1: Deberían estar aplicadas ──────────────────────────── --}}
    @if ($vacunacion['ya_aplicadas']->isNotEmpty())
        <div class="vac-bloque">
            <p class="vac-bloque-titulo">Deberían estar aplicadas</p>

            <div class="vac-grid" role="table" aria-label="Vacunas que deberían estar aplicadas">
                {{-- Header --}}
                <div class="vac-grid-header" role="row">
                    <div role="columnheader">Vacuna</div>
                    <div role="columnheader">Edad / Momento de aplicación</div>
                    <div role="columnheader">Dosis</div>
                </div>

                {{-- Filas --}}
                @foreach ($vacunacion['ya_aplicadas'] as $vacuna)
                    <div class="vac-grid-row" role="row">
                        <div class="vac-cell-nombre" role="cell">
                            <span class="vac-icono">
                                <i class="bi bi-shield-plus" aria-hidden="true"></i>
                            </span>
                            <span class="vac-nombre">{{ $vacuna['nombre'] }}</span>
                        </div>
                        <div class="vac-cell-cuando" role="cell">
                            <i class="bi bi-calendar3" aria-hidden="true"></i>
                            {{ $vacuna['cuando'] }}
                        </div>
                        <div class="vac-cell-dosis" role="cell">
                            <span class="vac-chip">{{ $vacuna['dosis'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- BLOQUE 2: Corresponden este año ─────────────────────────────── --}}
    <div class="vac-bloque vac-bloque--este-anio">
        <p class="vac-bloque-titulo">
            Corresponden aplicarse este año
            @if (!$vacunacion['sin_fecha_nac'] && $vacunacion['edad_anios'] !== null)
                <span class="vac-edad-pill">{{ $vacunacion['edad_anios'] }} años</span>
            @endif
        </p>

        @if ($vacunacion['este_anio']->isNotEmpty())
            <div class="vac-grid vac-grid--anio" role="table" aria-label="Vacunas de este año">
                <div class="vac-grid-header" role="row">
                    <div role="columnheader">Vacuna</div>
                    <div role="columnheader">Edad / Momento de aplicación</div>
                    <div role="columnheader">Dosis</div>
                </div>

                @foreach ($vacunacion['este_anio'] as $vacuna)
                    <div class="vac-grid-row" role="row">
                        <div class="vac-cell-nombre" role="cell">
                            <span class="vac-icono vac-icono--anio">
                                <i class="bi bi-shield-plus" aria-hidden="true"></i>
                            </span>
                            <span class="vac-nombre">{{ $vacuna['nombre'] }}</span>
                        </div>
                        <div class="vac-cell-cuando" role="cell">
                            <i class="bi bi-calendar3" aria-hidden="true"></i>
                            {{ $vacuna['cuando'] }}
                        </div>
                        <div class="vac-cell-dosis" role="cell">
                            <span class="vac-chip vac-chip--anio">{{ $vacuna['dosis'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="vac-empty-anio">
                <div class="vac-empty-anio-texto">
                    <i class="bi bi-info-circle" aria-hidden="true"></i>
                    <span>
                        No corresponde aplicarse ninguna vacuna del calendario en este año de vida.
                        @if ($vacunacion['ya_aplicadas']->isNotEmpty())
                            Verificar que las anteriores estén al día.
                        @endif
                    </span>
                </div>
                <i class="bi bi-calendar2-check vac-empty-anio-icon" aria-hidden="true"></i>
            </div>
        @endif
    </div>

</div>