<x-app-layout>

    <div id="calendar-page" aria-busy="false">
        {{-- Encabezado --}}
        <div class="dashboard-header">
            <div>
                <h2 class="dashboard-title">Calendario</h2>
                <p class="dashboard-subtitle">
                    {{ ucfirst($inicioMes->translatedFormat('F Y')) }}
                </p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-calendar">
                <i class="bi bi-house-door"></i>
                Volver al Inicio
            </a>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="cal-layout">
                    <section class="cal-month-panel" aria-label="Calendario mensual">
                        {{-- Navegación de meses: se actualiza mediante fetch sin recargar la página --}}
                        <div class="cal-nav">
                            <a href="{{ route('calendar', ['mes' => $inicioMes->copy()->subMonth()->format('Y-m')]) }}"
                               class="cal-nav-btn" data-calendar-nav aria-label="Mes anterior" title="Mes anterior">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                            <span class="cal-nav-title">
                                {{ ucfirst($inicioMes->translatedFormat('F Y')) }}
                            </span>
                            <a href="{{ route('calendar', ['mes' => $inicioMes->copy()->addMonth()->format('Y-m')]) }}"
                               class="cal-nav-btn" data-calendar-nav aria-label="Mes siguiente" title="Mes siguiente">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>

                        <div class="cal-grid">
                            @foreach (['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'] as $dia)
                                <div class="cal-weekday">{{ $dia }}</div>
                            @endforeach

                            @for ($i = 0; $i < $inicioMes->dayOfWeek; $i++)
                                <div class="cal-day cal-day--empty" aria-hidden="true"></div>
                            @endfor

                            @for ($d = 1; $d <= $finMes->day; $d++)
                                @php
                                    $fecha = $inicioMes->copy()->day($d);
                                    $key = $fecha->toDateString();
                                    $esHoy = $fecha->isSameDay($hoy);
                                    $esSeleccionado = $fecha->isSameDay($fechaSeleccionada);
                                    $turnos = $turnosMes[$key] ?? 0;
                                    $clases = 'cal-day';
                                    if ($esHoy) $clases .= ' cal-day--today';
                                    if ($turnos) $clases .= ' cal-day--has-turnos';
                                    if ($esSeleccionado) $clases .= ' cal-day--selected';
                                @endphp
                                <button
                                    type="button"
                                    class="{{ $clases }}"
                                    data-calendar-day
                                    data-url="{{ route('calendar', ['mes' => $inicioMes->format('Y-m'), 'fecha' => $key]) }}"
                                    aria-pressed="{{ $esSeleccionado ? 'true' : 'false' }}"
                                    aria-label="{{ $fecha->isoFormat('D [de] MMMM') }}{{ $turnos ? ', ' . $turnos . ' turnos' : ', sin turnos' }}"
                                    title="{{ $turnos ? $turnos . ' turno' . ($turnos > 1 ? 's' : '') : 'Sin turnos' }}"
                                >
                                    <span class="cal-day__num">{{ $d }}</span>
                                    @if ($turnos)
                                        <span class="cal-day__dot">{{ $turnos }}</span>
                                    @endif
                                </button>
                            @endfor
                        </div>

                        <div class="cal-legend">
                            <span class="cal-legend-item">
                                <span class="cal-legend-dot cal-legend-dot--today"></span>
                                Hoy
                            </span>
                            <span class="cal-legend-item">
                                <span class="cal-legend-dot cal-legend-dot--turnos"></span>
                                Día con turnos
                            </span>
                            <span class="cal-legend-item">
                                <span class="cal-legend-dot cal-legend-dot--selected"></span>
                                Día seleccionado
                            </span>
                        </div>
                    </section>

                    <section class="cal-day-panel" aria-live="polite" aria-label="Turnos del día seleccionado">
                        <div class="cal-day-panel__header">
                            <div>
                                <h3 class="cal-day-panel__title">Turnos del día</h3>
                                <p class="cal-day-panel__date">{{ ucfirst($fechaSeleccionada->isoFormat('dddd D [de] MMMM [de] YYYY')) }}</p>
                            </div>
                            <span class="cal-day-panel__count">
                                {{ $turnosDelDia->count() }} {{ $turnosDelDia->count() === 1 ? 'turno' : 'turnos' }}
                            </span>
                        </div>

                        @if ($turnosDelDia->isEmpty())
                            <div class="cal-day-empty">
                                <i class="bi bi-calendar2-check" aria-hidden="true"></i>
                                <p>No hay turnos programados para esta fecha.</p>
                                <span>Seleccioná otro día para consultar sus turnos.</span>
                            </div>
                        @else
                            <div class="cal-appointments">
                                @foreach ($turnosDelDia as $turno)
                                    <article class="cal-appointment">
                                        <div class="cal-appointment__time">
                                            <i class="bi bi-clock" aria-hidden="true"></i>
                                            {{ $turno->hora ? \Illuminate\Support\Carbon::parse($turno->hora)->format('H:i') : '—' }}
                                        </div>
                                        <div class="cal-appointment__info">
                                            <strong>{{ $turno->persona?->nombre_completo ?? 'Paciente no disponible' }}</strong>
                                            <span>
                                                DNI:
                                                {{ $turno->persona?->documento
                                                    ? number_format((int) str_replace('.', '', $turno->persona->documento), 0, ',', '.')
                                                    : '—' }}
                                            </span>
                                            @if ($turno->observacion)
                                                <small>{{ $turno->observacion }}</small>
                                            @endif
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const page = document.getElementById('calendar-page');
            if (!page) return;

            let requestActual = null;

            async function cargarCalendario(url, actualizarHistorial = true) {
                if (requestActual) requestActual.abort();
                const solicitud = new AbortController();
                requestActual = solicitud;
                page.setAttribute('aria-busy', 'true');
                page.classList.add('cal-is-loading');

                try {
                    const response = await fetch(url, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' },
                        signal: solicitud.signal
                    });

                    if (!response.ok) throw new Error('No se pudo cargar el calendario.');

                    const html = await response.text();
                    const documento = new DOMParser().parseFromString(html, 'text/html');
                    const nuevaPagina = documento.querySelector('#calendar-page');

                    if (!nuevaPagina) throw new Error('La respuesta no contiene el calendario.');

                    page.innerHTML = nuevaPagina.innerHTML;
                    page.setAttribute('aria-busy', 'false');
                    page.classList.remove('cal-is-loading');

                    if (actualizarHistorial) {
                        const destino = new URL(url, window.location.origin);
                        window.history.pushState({}, '', destino.pathname + destino.search);
                    }
                } catch (error) {
                    if (error.name !== 'AbortError') {
                        console.error('Error al actualizar el calendario:', error);
                    }
                } finally {
                    if (requestActual === solicitud) {
                        page.setAttribute('aria-busy', 'false');
                        page.classList.remove('cal-is-loading');
                    }
                }
            }

            document.addEventListener('click', function (event) {
                const dia = event.target.closest('[data-calendar-day]');
                if (dia && page.contains(dia)) {
                    event.preventDefault();
                    cargarCalendario(dia.dataset.url);
                    return;
                }

                const navegacion = event.target.closest('[data-calendar-nav]');
                if (navegacion && page.contains(navegacion)) {
                    event.preventDefault();
                    cargarCalendario(navegacion.href);
                }
            });

            window.addEventListener('popstate', function () {
                cargarCalendario(window.location.href, false);
            });
        })();
    </script>

</x-app-layout>