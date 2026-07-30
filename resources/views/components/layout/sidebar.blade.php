<aside class="sidebar">

    <div class="sidebar-header">
        {{-- Logo: si tenés el SVG podés reemplazar esto con <img src="..."> --}}
        <div class="sidebar-brand">
            <span class="sidebar-brand-icon">
                <img src="{{ asset('assets/images/logo.png') }}" alt="ClinData">
            </span>
            <span class="sidebar-brand-text">ClinData</span>
        </div>
    </div>

    <nav class="sidebar-nav">

        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>
            <span>Inicio</span>
        </a>

        <a href="{{ route('patients.index') }}"
            class="sidebar-link {{ request()->routeIs('patients.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            <span>Pacientes</span>
        </a>

    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-link border-0 bg-transparent w-100 text-start">
                <i class="bi bi-box-arrow-left"></i>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </div>

</aside>
