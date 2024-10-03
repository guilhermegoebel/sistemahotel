@extends('app')

@section('title', 'Lista de Reservas')

@section('content')
    <h1>Reservas</h1>

    <a href="{{ route('reservas.create') }}" class="btn btn-primary mb-3">Adicionar Nova Reserva</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservas as $reserva)
            <tr>
                <td>{{ $reserva->id_reserva }}</td>
                <td>{{ $reserva->cliente->nome }}</td>
                <td>{{ $reserva->data_checkin }}</td>
                <td>{{ $reserva->data_checkout }}</td>
                <td>{{ $reserva->status }}</td>
                <td>
                    <a href="{{ route('reservas.show', $reserva->id_reserva) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('reservas.edit', $reserva->id_reserva) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('reservas.delete', $reserva->id_reserva) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td colspan="6">Nenhuma reserva encontrada.</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
