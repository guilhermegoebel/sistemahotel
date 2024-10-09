@extends('app')
@section('title', 'Check-ins/Check-outs')
@section('h1', 'Checkin/Checkout')

@section('content')
    <a href="/checkin" class="btn btn-primary mb-3">Histórico de check-ins</a>
    <a href="/checkout" class="btn btn-primary mb-3">Histórico de check-outs</a>
    <div class="row">
        <div class="col-md-6">
            <!-- Tabela de checkin (feito pelo amigão) -->
            <h2>Check-in</h2>
            <table class="table table-striped table-bordered">
                <thead class="toast-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Check-in</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservas as $reserva)
                    @if($reserva->status == 'pendente')
                        <tr>
                            <td><b>{{ $reserva->cliente->nome }}</b></td>
                            <td>{{ $reserva->cliente->email }}</td>
                            <td>{{ $reserva->data_checkin }}</td>
                            <td>
                                <form action="{{ route('reservas.checkin', $reserva->id_reserva) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Check-in</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-6">
            <!-- Tabela de checkout (feito pelo amigão) -->
            <h2>Check-out</h2>
            <table class="table table-striped table-bordered">
                <thead class="toast-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Checkout</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservas as $reserva)
                    @if($reserva->status == 'confirmada')
                        <tr>
                            <td><b>{{ $reserva->cliente->nome }}</b></td>
                            <td>{{ $reserva->cliente->email }}</td>
                            <td>{{ $reserva->data_checkout }}</td>
                            <td>
                                <form action="{{ route('reservas.checkout', $reserva->id_reserva) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-sm">Check-out</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
