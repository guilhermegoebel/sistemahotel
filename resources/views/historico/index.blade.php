@extends('app')
@section('title', 'Histórico de Check-ins/Check-outs')
@section('h1', 'Histórico')

<!--nova secao com os historicos de check-in e check-out-->
@section('content')
    <hr>
    <div class="row">
        <!-- Histórico de Check-ins -->
        <div class="col-md-6">
            <h2 style="padding-bottom: 10px;">Check-ins</h2>
            <table class="table table-striped table-bordered">
                <thead class="toast-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Data Check-in</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservas as $reserva)
                    @if($reserva->status == 'confirmada')
                        <tr>
                            <td>{{ $reserva->cliente->nome }}</td>
                            <td>{{ $reserva->cliente->email }}</td>
                            <td>{{ $reserva->cliente->telefone }}</td>
                            <td>{{ \Carbon\Carbon::parse($reserva->data_checkin)->format('d/m/Y') }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Histórico de Check-outs -->
        <div class="col-md-6">
            <h2 style="padding-bottom: 10px;">Check-outs</h2>
            <table class="table table-striped table-bordered">
                <thead class="toast-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Data Check-in</th>
                    <th>Data Check-out</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservas as $reserva)
                    @if($reserva->status == 'completa')
                        <tr>
                            <td>{{ $reserva->cliente->nome }}</td>
                            <td>{{ $reserva->cliente->email }}</td>
                            <td>{{ $reserva->cliente->telefone }}</td>
                            <td>{{ \Carbon\Carbon::parse($reserva->data_checkin)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($reserva->data_checkout)->format('d/m/Y') }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
