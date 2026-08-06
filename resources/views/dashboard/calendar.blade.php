<x-app-layout>

    {{-- Encabezado --}}
    <div class="dashboard-header">
        <div>
            <h2 class="dashboard-title">Calendario</h2>
            <p class="dashboard-subtitle">
                {{ $hoy->translatedFormat('F Y') }}
            </p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-calendar">
            <i class="bi bi-house-door"></i>
            Volver al Inicio
        </a>
    </div>

    {{-- Calendario mensual --}}
    <div class="card">
        <div class="card-body p-4">

            {{-- Navegación mes --}}
            <div class="cal-nav">
                <a href="{{ route('calendar') }}?mes={{ $inicioMes->copy()->subMonth()->format('Y-m') }}"
                   class="cal-nav-btn">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <span class="cal-nav-title">
                    {{ ucfirst($inicioMes->translatedFormat('F Y')) }}
                </span>
                <a href="{{ route('calendar') }}?mes={{ $inicioMes->copy()->addMonth()->format('Y-m') }}"
                   class="cal-nav-btn">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>

            {{-- Grilla de días --}}
            <div class="cal-grid">

                {{-- Cabecera días de semana --}}
                @foreach (['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'] as $dia)
                    <div class="cal-weekday">{{ $dia }}</div>
                @endforeach

                {{-- Celdas vacías hasta el primer día --}}
                @for ($i = 0; $i < $inicioMes->dayOfWeek; $i++)
                    <div class="cal-day cal-day--empty"></div>
                @endfor

                {{-- Días del mes --}}
                @for ($d = 1; $d <= $finMes->day; $d++)
                    @php
                        $fecha    = $inicioMes->copy()->day($d);
                        $key      = $fecha->toDateString();
                        $esHoy    = $fecha->isSameDay($hoy);
                        $turnos   = $turnosMes[$key] ?? 0;
                        $clases   = 'cal-day';
                        if ($esHoy)   $clases .= ' cal-day--today';
                        if ($turnos)  $clases .= ' cal-day--has-turnos';
                    @endphp
                    <a href="{{ route('dashboard') }}"
                       class="{{ $clases }}"
                       title="{{ $turnos ? $turnos . ' turno' . ($turnos > 1 ? 's' : '') : '' }}">
                        <span class="cal-day__num">{{ $d }}</span>
                        @if ($turnos)
                            <span class="cal-day__dot">{{ $turnos }}</span>
                        @endif
                    </a>
                @endfor

            </div>{{-- /cal-grid --}}

            {{-- Leyenda --}}
            <div class="cal-legend">
                <span class="cal-legend-item">
                    <span class="cal-legend-dot cal-legend-dot--today"></span>
                    Hoy
                </span>
                <span class="cal-legend-item">
                    <span class="cal-legend-dot cal-legend-dot--turnos"></span>
                    Día con turnos
                </span>
            </div>

        </div>
    </div>

</x-app-layout>