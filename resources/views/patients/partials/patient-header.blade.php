<div class="mb-4">

    <a href="{{ route('patients.detail', $persona->id) }}" class="patient-back-link">
        <span class="material-symbols-outlined">arrow_back</span>
        Volver
    </a>

    <div class="patient-detail-header">

        <div class="patient-detail-header-top">

            <div class="patient-detail-identity">

                <div class="patient-detail-avatar">
                    {{ strtoupper(substr($persona->nombres,0,1)) }}
                    {{ strtoupper(substr($persona->apellidos,0,1)) }}
                </div>

                <div>

                    <h2 class="patient-detail-name">
                        {{ $persona->nombres }}
                        {{ $persona->apellidos }}
                        {{ $persona->apellido_materno }}
                    </h2>

                    <div class="patient-detail-meta">

                        @if($persona->fecha_nacimiento)
                            <span>
                                {{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->age }} años
                            </span>

                            <span class="dot"></span>
                        @endif

                        <span>
                            {{ $persona->sexo ?? '-' }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

        <div class="patient-detail-info-row">

            <div class="patient-info-chip">

                <span class="patient-info-chip-label">
                    Documento
                </span>

                <span class="patient-info-chip-value">
                    {{ $persona->documento ?? '-' }}
                </span>

            </div>

            <div class="patient-info-chip">

                <span class="patient-info-chip-label">
                    Historia Clínica
                </span>

                <span class="patient-info-chip-value">
                    {{ $persona->nro_hc ?? '-' }}
                </span>

            </div>

            <div class="patient-info-chip">

                <span class="patient-info-chip-label">
                    Fecha de nacimiento
                </span>

                <span class="patient-info-chip-value">

                    @if($persona->fecha_nacimiento)
                        {{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->format('d/m/Y') }}
                    @else
                        -
                    @endif

                </span>

            </div>

            <div class="patient-info-chip">

                <span class="patient-info-chip-label">
                    Sexo
                </span>

                <span class="patient-info-chip-value">
                    {{ $persona->sexo ?? '-' }}
                </span>

            </div>

        </div>

    </div>

</div>