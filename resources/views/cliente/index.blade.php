@extends('app')
@section('title', 'Cliente Index')
@section('h1', 'Cliente :D')

@section('content')
    <a href="{{ route('cliente.add') }}" class="btn btn-primary mb-3">Adicionar novo cliente</a>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>
                    <a href="{{ route('cliente.edit', $cliente->id_cliente) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('cliente.delete', $cliente->id_cliente) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalExcluir-{{ $cliente->id_cliente }}">
                            Excluir
                        </button>

                        <div class="modal fade" id="modalExcluir-{{ $cliente->id_cliente }}" tabindex="-1" aria-labelledby="modalLabelExcluir-{{ $cliente->id_cliente }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabelExcluir-{{ $cliente->id_cliente }}">Confirmar exclusão</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Tem certeza que deseja excluir este cliente?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('cliente.delete', $cliente->id_cliente) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Sim, excluir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
