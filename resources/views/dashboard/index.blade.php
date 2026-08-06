<x-app-layout>

    {{-- Encabezado --}}
    <div class="dashboard-header">
        <div>
            <h2 class="dashboard-title">Pacientes del día</h2>
            <p class="dashboard-subtitle">
                {{ now()->translatedFormat('d/m/Y') }}
                &nbsp;
                <span id="reloj-dashboard" class="dashboard-time"></span>
                &nbsp;·&nbsp;
                <span class="text-muted">{{ $stats['total'] }} turnos programados</span>
            </p>
        </div>

        <a href="{{ route('calendar') }}" class="btn btn-outline-secondary btn-calendar">
            <i class="bi bi-calendar3"></i>
            Ver calendario
        </a>
    </div>

    {{-- Stats cards --}}
    <div class="stats-row">
        <x-stats-card label="Total del día" :value="$stats['total']"      color="primary" />
        <x-stats-card label="Atendidos"     :value="$stats['atendidos']"  color="success" />
        <x-stats-card label="Arribados"     :value="$stats['arribados']"  color="info"    />
        <x-stats-card label="Pendientes"    :value="$stats['pendientes']" color="warning" />
    </div>

    {{-- Tabla de pacientes --}}
    <div class="card mt-4">
        <div class="card-body p-0">
            <x-patient-table
                :patients="$turnos"
                :showControl="true"
                :showEstado="true"
            />
        </div>
    </div>

    {{-- Reloj en tiempo real --}}
    <script>
        (function () {
            const el = document.getElementById('reloj-dashboard');
            if (!el) return;

            function tick() {
                const now = new Date();
                const h = String(now.getHours()).padStart(2, '0');
                const m = String(now.getMinutes()).padStart(2, '0');
                const s = String(now.getSeconds()).padStart(2, '0');
                const ampm = now.getHours() >= 12 ? 'p. m.' : 'a. m.';
                const h12 = now.getHours() % 12 || 12;
                el.textContent = `${String(h12).padStart(2,'0')}:${m}:${s} ${ampm}`;
            }

            tick();
            setInterval(tick, 1000);
        })();
    </script>

</x-app-layout>