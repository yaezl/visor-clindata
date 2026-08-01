<x-app-layout>

    {{-- Encabezado --}}
    <div class="dashboard-header">
        <div>
            <h2 class="dashboard-title">Pacientes del día</h2>
            <p class="dashboard-subtitle">
                {{ now()->translatedFormat('d/m/Y') }}
                &nbsp;·&nbsp;
                <span class="text-muted">{{ $stats['total'] }} turnos programados</span>
            </p>
        </div>

        <a href="#" class="btn btn-outline-secondary btn-calendar">
            <i class="bi bi-calendar3"></i>
            Ver calendario
        </a>
    </div>

    {{-- Stats cards --}}
    <div class="stats-row">
        <x-stats-card
            label="Total del día"
            :value="$stats['total']"
            color="primary"
        />
        <x-stats-card
            label="Atendidos"
            :value="$stats['atendidos']"
            color="success"
        />
        <x-stats-card
            label="Pendientes"
            :value="$stats['pendientes']"
            color="warning"
        />
    </div>

    {{-- Tabla de pacientes --}}
    <div class="card mt-4">
        <div class="card-body p-0">
            <x-patient-table
                :patients="$turnos"
                :showControl="true"
            />
        </div>
    </div>

</x-app-layout>