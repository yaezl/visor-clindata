@php

$historialAgrupado = $historial
    ->groupBy(function ($evento) {
        return \Carbon\Carbon::parse($evento->fechahora)->format('Y-m');
    });

@endphp

@foreach($historialAgrupado as $periodo => $eventos)

    @php

        $fecha = \Carbon\Carbon::createFromFormat('Y-m', $periodo);

        $meses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        ];

    @endphp

    <div class="mb-5 historial-mes">

        <div
            class="d-flex align-items-center mb-4">

            <div
                style="
                    width:8px;
                    height:34px;
                    background:#003764;
                    border-radius:8px;
                    margin-right:14px;
                ">
            </div>

            <h3
                class="fw-bold m-0"
                style="
                    color:#003764;
                    font-size:28px;
                ">

                {{ $meses[$fecha->month] }}
                {{ $fecha->year }}

            </h3>

        </div>

        @foreach($eventos->sortByDesc('fechahora') as $evento)

            @include('patients.partials.history-card',[
                'evento'=>$evento
            ])

        @endforeach

    </div>

@endforeach