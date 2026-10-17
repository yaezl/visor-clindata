<header class="topbar">

    <div>

        <div class="topbar-title">

            Sistema Hospitalario

        </div>

        <h3 class="topbar-greeting">

            Hola,
            {{ Auth::user()->personal?->persona?->nombres ?? 'Profesional' }}
            {{ Auth::user()->personal?->persona?->apellidos ?? '' }}
        </h3>

    </div>

    <div class="topbar-user">

        <div class="avatar">

            @php
                $nombres   = Auth::user()->personal?->persona?->nombres ?? 'P';
                $apellidos = Auth::user()->personal?->persona?->apellidos ?? '';
                $iniciales = strtoupper(
                    substr($nombres, 0, 1) . substr($apellidos, 0, 1)
                );
            @endphp
            {{ $iniciales }}

        </div>

    </div>

</header>