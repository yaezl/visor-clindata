<div class="mb-4">

    {{-- Botón volver --}}
    <a href="{{ route('patients.index') }}"
       class="text-decoration-none d-inline-flex align-items-center mb-4"
       style="color: var(--primary); font-weight:600;">

        <span class="material-symbols-outlined me-2">
            arrow_back
        </span>

        Volver

    </a>

    {{-- Cabecera del paciente --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        <div class="card-body p-4">

            <div class="row align-items-center">

                {{-- Avatar --}}
                <div class="col-auto">

                    <div
                        class="rounded-circle d-flex justify-content-center align-items-center"

                        style="
                            width:70px;
                            height:70px;
                            background:#003764;
                            color:white;
                            font-size:28px;
                            font-weight:700;
                        ">

                        {{ strtoupper(substr($persona->nombres,0,1)) }}
                        {{ strtoupper(substr($persona->apellidos,0,1)) }}

                    </div>

                </div>

                {{-- Datos --}}
                <div class="col">

                    <h2
                        class="fw-bold mb-1"
                        style="color:#003764;">

                        {{ $persona->nombres }}
                        {{ $persona->apellidos }}
                        {{ $persona->apellido_materno }}

                    </h2>

                    <div class="row mt-3">

                        <div class="col-md-3">

                            <small class="text-muted">
                                Documento
                            </small>

                            <div class="fw-semibold">

                                {{ $persona->documento ?? '-' }}

                            </div>

                        </div>

                        <div class="col-md-3">

                            <small class="text-muted">
                                Historia Clínica
                            </small>

                            <div class="fw-semibold">

                                {{ $persona->nro_hc ?? '-' }}

                            </div>

                        </div>

                        <div class="col-md-3">

                            <small class="text-muted">
                                Fecha de nacimiento
                            </small>

                            <div class="fw-semibold">

                                @if($persona->fecha_nacimiento)

                                    {{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->format('d/m/Y') }}

                                @else

                                    -

                                @endif

                            </div>

                        </div>

                        <div class="col-md-3">

                            <small class="text-muted">
                                Sexo
                            </small>

                            <div class="fw-semibold">

                                {{ $persona->sexo ?? '-' }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>