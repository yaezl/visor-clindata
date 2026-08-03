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

    <div class="history-month historial-mes">

        <div class="month-divider">

            <div class="month-divider-line"></div>

            <div class="month-badge">

                {{ strtoupper($meses[$fecha->month]) }}

                {{ $fecha->year }}

            </div>

            <div class="month-divider-line"></div>

        </div>

        @foreach($eventos->sortByDesc('fechahora') as $evento)

            @include('patients.partials.history-card',[
                'evento'=>$evento
            ])

        @endforeach

    </div>

@endforeach