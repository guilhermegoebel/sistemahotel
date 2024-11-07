@extends('app')
@section('title', 'Lista de Reservas')
@section('h1', 'Reservas')

@section('content')
    <a href="{{ route('reservas.add') }}" class="btn btn-primary mb-3">Adicionar nova reserva</a>
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
                    <td>{{ \Carbon\Carbon::parse($reserva->data_checkin)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reserva->data_checkout)->format('d/m/Y') }}</td>
                    <td>{{ $reserva->status }}</td>
                    <td>
                        <a href="{{ route('reservas.show', $reserva->id_reserva) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('reservas.edit', $reserva->id_reserva) }}" class="btn btn-warning btn-sm">Editar</a>
                        @if($reserva->status === 'pendente')
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalCancelar-{{ $reserva->id_reserva }}">
                                Cancelar
                            </button>
                        @endif

                        <div class="modal fade" id="modalCancelar-{{ $reserva->id_reserva }}" tabindex="-1" aria-labelledby="modalLabelCancelar-{{ $reserva->id_reserva }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabelExcluir-{{ $reserva->id_reserva }}">Confirmar cancelamento</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Tem certeza que deseja cancelar esta reserva?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                        <form action="{{ route('reservas.cancelar', $reserva->id_reserva) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger">Sim</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                        <!-- adicionar checkin (com modal)  nas acoes da tabela-->
                        @if ($reserva->status == 'pendente')
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCheckin-{{ $reserva->id_reserva }}">
                                Check-in
                            </button>
                        @endif
                        <div class="modal fade" id="modalCheckin-{{ $reserva->id_reserva }}" tabindex="-1" aria-labelledby="modalLabelCheckin-{{ $reserva->id_reserva }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabelCheckin-{{ $reserva->id_reserva }}">Confirmar check-in</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Tem certeza que deseja fazer o check-in?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('reservas.checkin', $reserva->id_reserva) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger">Sim </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($reserva->status == 'confirmada')
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCheckout-{{ $reserva->id_reserva }}">
                                Check-out
                            </button>
                        @endif
                        <div class="modal fade" id="modalCheckout-{{ $reserva->id_reserva }}" tabindex="-1" aria-labelledby="modalLabelCheckout-{{ $reserva->id_reserva }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabelCheckout-{{ $reserva->id_reserva }}">Confirmar check-out</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Tem certeza que deseja fazer o check-out?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('reservas.checkout', $reserva->id_reserva) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger">Sim </button>
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
