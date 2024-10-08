@extends('app')
@section('title', 'Check-ins/Check-outs')
@section('h1', 'Checkin/Checkout')

@section('content')
    <a href="" class="btn btn-primary mb-3">Histórico de check-ins</a>
    <a href="" class="btn btn-primary mb-3">Histórico de check-outs</a>
    <div class="row">
        <div class="col-md-6">
            <!-- Tabela de checkin (feito pelo amigão) -->
            <h2>Check-in</h2>
            <table class="table table-striped table-bordered">
                <thead class="toast-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservas as $reserva)
                    @if($reserva->status == 'pendente')
                        <tr>
                            <td>{{ $reserva->cliente->nome }}</td>
                            <td>{{ $reserva->cliente->email }}</td>
                            <td>{{ $reserva->cliente->telefone }}</td>
                            <td>
                                <form method="post">
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
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservas as $reserva)
                    @if($reserva->status == 'confirmada')
                        <tr>
                            <td>{{ $reserva->cliente->nome }}</td>
                            <td>{{ $reserva->cliente->email }}</td>
                            <td>{{ $reserva->cliente->telefone }}</td>
                            <td>
                                <form action="{{}}" method="post">
                                    <button type="submit" class="btn btn-success btn-sm">Check-out</button>
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
