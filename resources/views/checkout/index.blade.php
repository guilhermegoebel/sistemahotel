@extends('app')
@section('title', 'Check-out')
@section('h1', 'Check-out realizados')

@section('content')
    <table class="table table-striped table-bordered">
        <thead class="toast-dark">
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Data check-out</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservas as $reserva)
            @if($reserva->status == 'completa')
                <tr>
                    <td>{{ $reserva->cliente->nome }}</td>
                    <td>{{ $reserva->cliente->email }}</td>
                    <td>{{ $reserva->cliente->telefone }}</td>
                    <td>{{ $reserva->data_checkout }}</td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

@endsection
