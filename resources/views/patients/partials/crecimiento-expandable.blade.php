{{--
    Panel de Control de Crecimiento
    ─────────────────────────────────
    Variables que recibe:
      $crecimiento  array  (devuelto por CrecimientoService::calcularParaPaciente)

    Estructura de $crecimiento:
      ->sin_datos          bool
      ->motivo             string|null
      ->es_pediatrico      bool
      ->edad_anios         int|null
      ->edad_meses_total   int|null
      ->ultimo_control     array { fecha, peso, talla, imc, perimetro_cefalico }
      ->historico          Collection de { fecha, fecha_iso, edad_meses, peso, talla, imc }
      ->percentiles        array { peso, talla, imc } → cada uno: { p3,p15,p50,p85,p97, valor_paciente, percentil_estimado }
      ->alertas            Collection de { tipo, mensaje }
      ->proximo_control    Carbon|null
      ->curvas_oms         array { peso: [...], talla: [...], imc: [...] }
--}}

@php
    $c = $crecimiento;
    $ult = $c['ultimo_control'] ?? null;

    // Para los chips de estado general
    $diasSinControl = $ult
        ? \Carbon\Carbon::createFromFormat('d/m/Y', $ult['fecha'])->diffInDays(\Carbon\Carbon::today())
        : null;
    $hayAlertaRoja = collect($c['alertas'] ?? [])->contains('tipo', 'danger');
@endphp

<div class="crec-panel">

    {{-- ── Sin datos ───────────────────────────────────────────── --}}
    @if ($c['sin_datos'])
        <div class="crec-empty">
            <i class="bi bi-bar-chart-line crec-empty-icon" aria-hidden="true"></i>
            <p>{{ $c['motivo'] ?? 'Aún no hay mediciones de peso y talla cargadas para este paciente.' }}</p>
        </div>

        {{-- ── Paciente no pediátrico ──────────────────────────────── --}}
    @elseif (!$c['es_pediatrico'])
        <div class="crec-empty">
            <i class="bi bi-person crec-empty-icon" aria-hidden="true"></i>
            <p>Los gráficos de percentiles OMS aplican hasta los 19 años. Este paciente tiene {{ $c['edad_anios'] }}
                años.</p>
            @if ($ult)
                <p class="crec-empty-sub">
                    Última medición: <strong>{{ $ult['fecha'] }}</strong> —
                    Peso: <strong>{{ $ult['peso'] }} kg</strong> —
                    Talla: <strong>{{ $ult['talla'] }} cm</strong> —
                    IMC: <strong>{{ $ult['imc'] ?? '—' }}</strong>
                </p>
            @endif
        </div>

        {{-- ── Panel completo ──────────────────────────────────────── --}}
    @else
        {{-- ❶ Estado general ─────────────────────────────────────── --}}
        <div class="crec-estado">
            <div class="crec-estado-badge {{ $hayAlertaRoja ? 'crec-estado-badge--alerta' : 'crec-estado-badge--ok' }}">
                <i class="bi {{ $hayAlertaRoja ? 'bi-exclamation-triangle' : 'bi-check-circle-fill' }}"
                    aria-hidden="true"></i>
            </div>
            <div class="crec-estado-info">
                <p class="crec-estado-fecha">
                    Último control: <strong>{{ $ult['fecha'] }}</strong>
                </p>
                <p class="crec-estado-label">
                    {{ $hayAlertaRoja ? 'Hay alertas para revisar.' : 'Estado general' }}
                </p>
                <p class="crec-estado-sub">
                    {{ $hayAlertaRoja ? 'Revisar alertas en la sección inferior.' : 'Crecimiento acorde para la edad.' }}
                </p>
            </div>
        </div>

        {{-- ❷ Mediciones actuales ─────────────────────────────────── --}}
        <h4 class="crec-seccion-titulo">MEDICIONES ACTUALES</h4>

        <div class="crec-chips-row">

            {{-- Peso --}}
            <div class="crec-chip">
                <div class="crec-chip-header">
                    <i class="bi bi-speedometer2" aria-hidden="true"></i>
                    <span>Peso</span>
                </div>
                <p class="crec-chip-valor">{{ $ult['peso'] }} <small>kg</small></p>
            </div>

            {{-- Talla --}}
            <div class="crec-chip">
                <div class="crec-chip-header">
                    <i class="bi bi-rulers" aria-hidden="true"></i>
                    <span>Talla</span>
                </div>
                <p class="crec-chip-valor">{{ $ult['talla'] }} <small>cm</small></p>
            </div>

            {{-- IMC --}}
            <div class="crec-chip">
                <div class="crec-chip-header">
                    <i class="bi bi-activity" aria-hidden="true"></i>
                    <span>IMC</span>
                </div>
                <p class="crec-chip-valor">{{ $ult['imc'] ?? '—' }}</p>
            </div>

            {{-- Perímetro cefálico (placeholder si no hay dato) --}}
            <div class="crec-chip crec-chip--noaplica">
                <div class="crec-chip-header">
                    <i class="bi bi-circle-half" aria-hidden="true"></i>
                    <span>Perím. cefálico</span>
                </div>
                @if ($ult['perimetro_cefalico'])
                    <p class="crec-chip-valor">{{ $ult['perimetro_cefalico'] }} <small>cm</small></p>
                @else
                    <p class="crec-chip-valor crec-chip-valor--nd">No aplica a esta edad</p>
                    <p class="crec-chip-sub">—</p>
                @endif
            </div>

        </div>

        {{-- ❸ Evolución + Últimos controles ─────────────────────── --}}
        <div class="crec-evolucion-row">

            {{-- Gráfico de línea --}}
            <div class="crec-grafico-wrap">
                <h4 class="crec-seccion-titulo">EVOLUCIÓN (GRÁFICOS)</h4>

                {{-- Tabs de parámetro --}}
                <div class="crec-tabs" role="tablist">
                    <button class="crec-tab crec-tab--active" data-param="peso" role="tab" aria-selected="true">
                        Peso
                    </button>
                    <button class="crec-tab" data-param="talla" role="tab" aria-selected="false">
                        Talla
                    </button>
                    <button class="crec-tab" data-param="imc" role="tab" aria-selected="false">
                        IMC
                    </button>
                </div>

                {{-- Canvas del gráfico --}}
                <div class="crec-canvas-wrap">
                    <canvas id="crec-chart" aria-label="Gráfico de evolución del paciente"></canvas>
                </div>

                {{-- Leyenda OMS --}}
                <p class="crec-oms-nota">
                    <i class="bi bi-info-circle" aria-hidden="true"></i>
                    Los percentiles se basan en las curvas OMS para niños de 5 a 19 años.
                </p>
            </div>

            {{-- Tabla de últimos controles --}}
            <div class="crec-tabla-wrap">
                <h4 class="crec-seccion-titulo">ÚLTIMOS CONTROLES</h4>

                <table class="crec-tabla" aria-label="Últimos controles de crecimiento">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Peso (kg)</th>
                            <th>Talla (cm)</th>
                            <th>IMC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($c['historico']->sortByDesc('fecha_iso')->take(5) as $h)
                            <tr>
                                <td>{{ $h['fecha'] }}</td>
                                <td>{{ $h['peso'] }}</td>
                                <td>{{ $h['talla'] }}</td>
                                <td>{{ $h['imc'] ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Botón ver más --}}
                @if ($c['historico']->count() > 5)
                    <button class="crec-ver-mas" id="crec-ver-mas-btn" type="button">
                        <i class="bi bi-arrow-repeat" aria-hidden="true"></i>
                        Ver evolución completa
                    </button>
                @endif
            </div>

        </div>

        {{-- ❹ Percentiles + Alertas ──────────────────────────────── --}}
        <div class="crec-bottom-row">

            {{-- Percentiles --}}
            <div class="crec-percentiles-panel">
                <h4 class="crec-seccion-titulo">PERCENTILES</h4>

                @foreach (['peso' => 'Peso', 'talla' => 'Talla', 'imc' => 'IMC'] as $key => $label)
                    @if (isset($c['percentiles'][$key]) && $c['percentiles'][$key])
                        @php $pd = $c['percentiles'][$key]; @endphp
                        <div class="crec-perc-fila">
                            <span class="crec-perc-label">{{ $label }}</span>
                            <span class="crec-perc-valor">Percentil {{ $pd['percentil_estimado'] }}</span>
                        </div>
                        <div class="crec-barra-wrap">
                            <div class="crec-barra-fill" style="width: {{ $pd['percentil_estimado'] }}%"></div>
                        </div>
                        <div class="crec-barra-labels crec-barra-labels--sm">
                            <span>0</span><span>50</span><span>100</span>
                        </div>
                    @endif
                @endforeach

                <div class="crec-interpretacion">
                    <i class="bi bi-check-circle-fill text-success" aria-hidden="true"></i>
                    Peso, talla e IMC se encuentran dentro de los percentiles esperados para la edad.
                </div>
            </div>

            {{-- Alertas --}}
            <div class="crec-alertas-panel">
                <h4 class="crec-seccion-titulo">ALERTAS</h4>

                @forelse ($c['alertas'] as $alerta)
                    <div class="crec-alerta crec-alerta--{{ $alerta['tipo'] }}">
                        @if ($alerta['tipo'] === 'success')
                            <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                        @elseif ($alerta['tipo'] === 'warning')
                            <i class="bi bi-exclamation-circle" aria-hidden="true"></i>
                        @else
                            <i class="bi bi-x-circle-fill" aria-hidden="true"></i>
                        @endif
                        {{ $alerta['mensaje'] }}
                    </div>
                @empty
                    <p class="crec-empty-sub">Sin alertas para este período.</p>
                @endforelse
            </div>

        </div>

        {{-- ❺ Próximo control ─────────────────────────────────────── --}}
        @if ($c['proximo_control'])
            <div class="crec-proximo">
                <div class="crec-proximo-icono">
                    <i class="bi bi-calendar-check" aria-hidden="true"></i>
                </div>
                <div class="crec-proximo-texto">
                    <span class="crec-proximo-label">PRÓXIMO CONTROL SUGERIDO</span>
                    <span class="crec-proximo-valor">
                        Faltan {{ $c['tiempo_restante'] }}
                    </span>
                    <span class="crec-proximo-sub">Según la edad y el estado actual del paciente.</span>
                </div>
                <div class="crec-proximo-fecha">
                    <span class="crec-proximo-mes">{{ strtoupper($c['proximo_control']->isoFormat('MMM')) }}</span>
                    <span class="crec-proximo-dia">{{ $c['proximo_control']->format('d') }}</span>
                    <span class="crec-proximo-anio">{{ $c['proximo_control']->format('Y') }}</span>
                </div>
            </div>
        @endif

    @endif {{-- fin panel completo --}}

</div>

{{-- ── Script del gráfico (Chart.js, sólo si hay datos pediátricos) ── --}}
@if (!$c['sin_datos'] && $c['es_pediatrico'] && $c['historico']->isNotEmpty())
    <script>
        (function waitForChart() {
            if (typeof Chart === 'undefined') {
                return setTimeout(waitForChart, 50);
            }

            // ── Datos del servidor ────────────────────────────────────────
            const historico = @json($c['historico']->values());
            const curvasOms = @json($c['curvas_oms']);
            const edadMeses = {{ $c['edad_meses_total'] }};

            // ── Parámetro activo por defecto ──────────────────────────────
            let paramActivo = 'peso';

            const labels_oms = {
                peso: 'Peso (kg)',
                talla: 'Talla (cm)',
                imc: 'IMC',
            };

            // ── Colores del sistema ───────────────────────────────────────
            const COLOR_PRIMARIO = '#003764';
            const COLOR_SECUNDARIO = '#C7A36E';

            // ── Canvas ────────────────────────────────────────────────────
            const ctx = document.getElementById('crec-chart');
            if (!ctx) return;

            // ── Construir datasets para el parámetro activo ───────────────
            function buildDatasets(param) {
                const curva = curvasOms[param] ?? [];

                // Convertir curva OMS a labels (años)
                const omsLabels = curva.map(p => {
                    const a = Math.floor(p.mes / 12);
                    const m = p.mes % 12;
                    return m === 0 ? `${a} años` : `${a}a ${m}m`;
                });

                // Puntos del paciente mapeados al eje de meses
                const puntosPC = historico.map(h => ({
                    x: h.edad_meses,
                    y: h[param],
                })).filter(p => p.y !== null);

                const datasets = [];

                // Curvas OMS (solo si hay datos)
                if (curva.length) {
                    const omsCurvas = [{
                            key: 'p97',
                            label: 'P97',
                            color: 'rgba(220,53,69,0.4)',
                            dash: [6, 3]
                        },
                        {
                            key: 'p85',
                            label: 'P85',
                            color: 'rgba(255,193,7,0.5)',
                            dash: [4, 3]
                        },
                        {
                            key: 'p50',
                            label: 'P50',
                            color: 'rgba(0,55,100,0.3)',
                            dash: [4, 2]
                        },
                        {
                            key: 'p15',
                            label: 'P15',
                            color: 'rgba(255,193,7,0.5)',
                            dash: [4, 3]
                        },
                        {
                            key: 'p3',
                            label: 'P3',
                            color: 'rgba(220,53,69,0.4)',
                            dash: [6, 3]
                        },
                    ];

                    omsCurvas.forEach(({
                        key,
                        label,
                        color,
                        dash
                    }) => {
                        datasets.push({
                            label,
                            data: curva.map(p => ({
                                x: p.mes,
                                y: p[key]
                            })),
                            borderColor: color,
                            borderDash: dash,
                            borderWidth: 1.5,
                            pointRadius: 0,
                            tension: 0.3,
                            fill: false,
                        });
                    });
                }

                // Línea del paciente (encima de todo)
                datasets.push({
                    label: 'Paciente',
                    data: puntosPC,
                    borderColor: COLOR_PRIMARIO,
                    backgroundColor: COLOR_PRIMARIO,
                    borderWidth: 2.5,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.3,
                    fill: false,
                    order: 0,
                });

                return datasets;
            }

            // ── Instanciar Chart ──────────────────────────────────────────
            let chart = new Chart(ctx, {
                type: 'line',
                data: {
                    datasets: buildDatasets(paramActivo),
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    },
                    scales: {
                        x: {
                            type: 'linear',
                            title: {
                                display: true,
                                text: 'Edad (meses)'
                            },
                            ticks: {
                                callback: v => {
                                    const a = Math.floor(v / 12);
                                    const m = v % 12;
                                    return m === 0 ? `${a}a` : '';
                                },
                            },
                            grid: {
                                color: 'rgba(0,0,0,.06)'
                            },
                        },
                        y: {
                            title: {
                                display: true,
                                text: labels_oms[paramActivo]
                            },
                            grid: {
                                color: 'rgba(0,0,0,.06)'
                            },
                        },
                    },
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                font: {
                                    size: 11
                                },
                                boxWidth: 20,
                                filter: item => item.label != null && (item.label === 'Paciente' || item.label
                                    .startsWith('P')),
                            },
                        },
                        tooltip: {
                            callbacks: {
                                title: items => {
                                    const mes = items[0]?.parsed?.x ?? 0;
                                    const a = Math.floor(mes / 12);
                                    const m = mes % 12;
                                    return `${a} años ${m > 0 ? m + ' meses' : ''}`;
                                },
                            },
                        },
                    },
                },
            });

            // ── Cambio de tab ─────────────────────────────────────────────
            document.querySelectorAll('.crec-tab').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.crec-tab').forEach(b => {
                        b.classList.remove('crec-tab--active');
                        b.setAttribute('aria-selected', 'false');
                    });
                    btn.classList.add('crec-tab--active');
                    btn.setAttribute('aria-selected', 'true');

                    paramActivo = btn.dataset.param;

                    chart.data.datasets = buildDatasets(paramActivo);
                    chart.options.scales.y.title.text = labels_oms[paramActivo];
                    chart.update();
                });
            });

        })();
    </script>
@endif
