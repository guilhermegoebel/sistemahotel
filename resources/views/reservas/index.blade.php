@extends('app')
@section('title', 'Lista de Reservas')
@section('h1', 'Reservas')

@section('content')
    <a href="{{ route('reservas.add') }}" class="btn btn-primary mb-3">Adicionar Nova Reserva</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Cliente</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @if($reservas->isEmpty())
            <tr>
                <td colspan="5">Nenhuma reserva encontrada.</td>
            </tr>
        @else
            @foreach($reservas as $reserva)
                <tr>
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
                        @if($reserva->status == 'pendente')
                            <form action="{{ route('reservas.checkin', $reserva->id_reserva) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Check-in</button>
                            </form>
                        @elseif($reserva->status == 'confirmada')
                            <form action="{{ route('reservas.checkout', $reserva->id_reserva) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm">Check-out</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection
