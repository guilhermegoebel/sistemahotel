@extends('app')
@section('title', 'Detalhes da Reserva')
@section('h1', 'Detalhes da Reserva')

@section('content')
    <ul>
        <li><strong>Cliente:</strong> {{ $reserva->cliente->nome }}</li>
        <li><strong>Check-in:</strong> {{ $reserva->data_checkin->format('d/m/Y') }}</li>
        <li><strong>Check-out:</strong> {{ $reserva->data_checkout->format('d/m/Y') }}</li>
        <li><strong>Quartos reservados: </strong>
            <ul>
                @foreach($reserva->quartos as $quarto)
                    <li> {{ $quarto->tipo }} - R$ {{ number_format($quarto->valor, 2, ',', '.') }}</li>
                @endforeach
            </ul>
        </li>
        <li><strong>Valor:</strong> R$ {{ number_format($reserva->valor, 2, ',', '.') }}</li>
        <li><strong>Status:</strong> {{ $reserva->status }}</li>
    </ul>

    <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
