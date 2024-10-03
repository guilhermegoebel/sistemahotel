@extends('app')

@section('title', 'Detalhes da Reserva')

@section('content')
    <h1>Detalhes da Reserva</h1>

    <ul>
        <li><strong>Cliente:</strong> {{ $reserva->cliente->nome }}</li>
        <li><strong>Check-in:</strong> {{ $reserva->data_checkin }}</li>
        <li><strong>Check-out:</strong> {{ $reserva->data_checkout }}</li>
        <li><strong>Número de Quartos:</strong> {{ $reserva->quartos }}</li>
        <li><strong>Status:</strong> {{ $reserva->status }}</li>
    </ul>

    <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
