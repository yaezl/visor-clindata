<header class="topbar">

    <div>

        <div class="topbar-title">

            Sistema Hospitalario

        </div>

        <h3 class="topbar-greeting">

            Hola,
            {{ Auth::user()->name ?? 'Profesional' }}

        </h3>

    </div>

    <div class="topbar-user">

        <div class="avatar">

            {{ Str::of(Auth::user()->name ?? 'P')
                ->explode(' ')
                ->map(fn($n)=>Str::substr($n,0,1))
                ->take(2)
                ->join('')
            }}

        </div>

    </div>

</header>