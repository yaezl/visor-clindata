@props([
    'patients'    => collect(),
    'showControl' => true,   // true = muestra Último Control (dashboard), false = muestra Nro HC (pacientes)
])

<div class="patient-table-wrapper">
    <table class="patient-table">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>DNI</th>
                <th>{{ $showControl ? 'Último Control' : 'Nro. Historia Clínica' }}</th>
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
                    {{-- Avatar con iniciales --}}
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

                    <td class="patient-dni">
                        {{ $patient['dni']
                            ? number_format((int) str_replace('.', '', $patient['dni']), 0, ',', '.')
                            : '—' }}
                    </td>

                    <td class="patient-secondary">
                        @if ($showControl)
                            {{ $patient['control']
                                ? \Carbon\Carbon::parse($patient['control'])->format('d/m/Y')
                                : '—' }}
                        @else
                            {{ $patient['nro_hc'] ?? '—' }}
                        @endif
                    </td>

                    {{-- Flecha visible on-hover (CSS la muestra) --}}
                    <td class="patient-arrow">
                        <i class="bi bi-chevron-right"></i>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="patient-empty">Sin resultados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>