<x-app-layout>

    {{-- Barra de búsqueda --}}
    <x-search-bar
        :value="request('q', '')"
        placeholder="Buscar por Nombre, DNI o Historia Clínica..."
    />

    {{-- Resultados --}}
    @if (request()->filled('q'))
        <p class="search-results-label mt-3">
            {{ $personas->total() }} resultado{{ $personas->total() !== 1 ? 's' : '' }}
            para <strong>"{{ request('q') }}"</strong>
        </p>
    @endif

    {{-- Tabla --}}
    <div class="card mt-3">
        <div class="card-body p-0">
            <x-patient-table
                :patients="$personas->getCollection()->toArray()"
                :showControl="false"
            />
        </div>
    </div>

    {{-- Paginación --}}
    @if ($personas->hasPages())
        <div class="mt-3 d-flex justify-content-center">
            {{ $personas->links() }}
        </div>
    @endif

</x-app-layout>