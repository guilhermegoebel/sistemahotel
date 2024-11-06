@extends('app')
@section('title', 'Detalhes da Reserva')
@section('h1', 'Detalhes da Reserva')

@section('content')
    <ul>
        <li><strong>Cliente:</strong> {{ $reserva->cliente->nome }}</li>
        <li><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($reserva->data_checkin)->format('d/m/Y') }}</li>
        <li><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($reserva->data_checkout)->format('d/m/Y') }}</li>
        <li><strong>Duração da hospedagem:</strong> {{ $diasHospedagem }} {{ $diasHospedagem > 1 ? 'dias' : 'dia' }}</li>
        <li><strong>Acompanhantes:</strong>
            <ul>
                @foreach($reserva->acompanhantes as $acompanhante)
                    <li>{{ $acompanhante->nome }} - {{ $acompanhante->idade }} anos</li>
                @endforeach
            </ul>
        </li>
        <li><strong>Quartos reservados: </strong>
            <ul>
                @foreach($reserva->quartos as $quarto)
                    <li>
                        {{ $quarto->tipo }} - R$ {{ number_format($quarto->valor, 2, ',', '.') }}
                        ({{ $diasHospedagem }} x R$ {{ number_format($quarto->valor, 2, ',', '.') }} = R$ {{ number_format($quarto->valor * $diasHospedagem, 2, ',', '.') }})
                    </li>
                @endforeach
            </ul>
        </li>
        <li><strong>Valor total da reserva:</strong> R$ {{ number_format($valorTotal, 2, ',', '.') }}</li>
        <li><strong>Status:</strong> {{ $reserva->status }}</li>
    </ul>

    <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
