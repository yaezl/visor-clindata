<header class="topbar">

    <div>

        <div class="topbar-title">

            Sistema Hospitalario

        </div>

        <h3 class="topbar-greeting">

            Hola,
            {{ Str::of(Auth::user()->name ?? 'Profesional')->replace('.', ' ')->title() }}

        </h3>

    </div>

    <div class="topbar-user">

        <div class="avatar">

            @php
                $iniciales = strtoupper(
                    collect(explode(' ', str_replace('.', ' ', Auth::user()->name ?? 'P')))
                        ->map(fn($n) => substr($n, 0, 1))
                        ->take(2)
                        ->join('')
                );
            @endphp
            {{ $iniciales }}

        </div>

    </div>

</header>