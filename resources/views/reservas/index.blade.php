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

                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalExcluir-{{ $reserva->id_reserva }}">
                            Excluir
                        </button>

                        <div class="modal fade" id="modalExcluir-{{ $reserva->id_reserva }}" tabindex="-1" aria-labelledby="modalLabelExcluir-{{ $reserva->id_reserva }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabelExcluir-{{ $reserva->id_reserva }}">Confirmar exclusão</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Tem certeza que deseja excluir esta reserva?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('reservas.delete', $reserva->id_reserva) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Sim, excluir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection
