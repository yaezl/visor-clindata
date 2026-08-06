@props([
    'patients'    => collect(),
    'showControl' => true,    // true = Último Control (dashboard), false = Nro HC (pacientes)
    'showEstado'  => false,   // true = columna Estado (solo dashboard)
])

<div class="patient-table-wrapper">
    <table class="patient-table">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>DNI</th>
                @if ($showEstado)
                    <th>Turno</th>
                @endif
                <th>{{ $showControl ? 'Último Control' : 'Nro. Historia Clínica' }}</th>
                @if ($showEstado)
                    <th>Estado</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($patients as $patient)
                <tr
                    class="patient-row"
                    @if(isset($patient['id']))
                        onclick="window.location='{{ route('patients.detail', $patient['id']) }}'"
                        style="cursor:pointer"
                    @endif
                >
                    {{-- Avatar + nombre --}}
                    <td>
                        <div class="patient-cell">
                            <span class="patient-avatar">
                                {{ mb_strtoupper(
                                    collect(explode(' ', $patient['name'] ?? ''))
                                        ->filter()
                                        ->map(fn($w) => mb_substr($w, 0, 1))
                                        ->take(2)
                                        ->join('')
                                ) }}
                            </span>
                            <span class="patient-name">{{ $patient['name'] ?? '—' }}</span>
                        </div>
                    </td>

                    {{-- DNI --}}
                    <td class="patient-dni">
                        {{ $patient['dni']
                            ? number_format((int) str_replace('.', '', $patient['dni']), 0, ',', '.')
                            : '—' }}
                    </td>

                    {{-- Hora de turno (solo dashboard) --}}
                    @if ($showEstado)
                        <td class="patient-hora">
                            <strong>{{ $patient['hora'] ?? '—' }}</strong>
                        </td>
                    @endif

                    {{-- Último control / Nro HC --}}
                    <td class="patient-secondary">
                        @if ($showControl)
                            {{ isset($patient['control']) && $patient['control']
                                ? \Carbon\Carbon::parse($patient['control'])->format('d/m/Y')
                                : '—' }}
                        @else
                            {{ $patient['nro_hc'] ?? '—' }}
                        @endif
                    </td>

                    {{-- Badge de estado (solo dashboard) --}}
                    @if ($showEstado)
                        <td class="patient-estado">
                            <span class="estado-badge {{ $patient['estado_css'] ?? 'badge-pendiente' }}">
                                <span class="estado-dot"></span>
                                {{ $patient['estado_label'] ?? 'Pendiente' }}
                            </span>
                        </td>
                    @endif

                    {{-- Ícono hover: estetoscopio --}}
                    <td class="patient-arrow">
                        <i class="fa-solid fa-stethoscope"></i>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $showEstado ? 6 : 4 }}" class="patient-empty">
                        Sin pacientes programados para hoy
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>