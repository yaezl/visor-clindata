<div class="login-card">

    <div class="login-logo">
        <img
            src="{{ asset('assets/images/logo.png') }}"
            alt="ClinData"
        >
    </div>

    <h1 class="login-title">ClinData</h1>

    <p class="login-subtitle">Sistema de Gestión Hospitalaria</p>

    {{-- Mensajes de error de sesión --}}
    @if (session('status'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" novalidate>

        @csrf

        <div class="mb-4">

            <label class="form-label text-uppercase fw-semibold small letter-spacing-1" for="username">
                Usuario
            </label>

            <input
                id="username"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                type="text"
                placeholder="Dr. Juan Perez"
                value="{{ old('email') }}"
                autofocus
                autocomplete="username"
            >

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <div class="mb-2">

            <label class="form-label text-uppercase fw-semibold small letter-spacing-1" for="password">
                Contraseña
            </label>

            <div class="password-wrapper">

                <input
                    id="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    type="password"
                    placeholder="••••••••"
                    autocomplete="current-password"
                >

                <button
                    type="button"
                    class="password-toggle"
                    tabindex="-1"
                    onclick="togglePassword()"
                    aria-label="Mostrar u ocultar contraseña"
                >
                    <i class="bi bi-eye" id="toggleIcon"></i>
                </button>

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

        </div>

        <div class="text-end mb-4">
            <a href="{{ route('password.request') }}" class="forgot-password">
                ¿Olvidaste tu contraseña?
            </a>
        </div>

        <button class="btn btn-primary w-100 login-button" type="submit">
            Iniciar Sesión
        </button>

    </form>

    <div class="login-footer">
        © {{ now()->year }} ClinData · Todos los derechos reservados
    </div>

</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('toggleIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>