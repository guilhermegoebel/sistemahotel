@extends('app')
@section('title', 'Lista de Quartos')
@section('h1', 'Quartos')

@section('content')
    <a href="{{ route('quarto.add') }}" class="btn btn-primary mb-3">Adicionar novo quarto</a>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>Tipo</th>
            <th>Valor</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($quartos as $quarto)
            <tr>
                <td>{{ $quarto->tipo }}</td>
                <td>R$ {{ number_format($quarto->valor, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('quarto.edit', $quarto->id_quarto) }}" class="btn btn-primary btn-sm">Editar</a>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalExcluir-{{ $quarto->id_quarto }}">
                        Excluir
                    </button>

                    <div class="modal fade" id="modalExcluir-{{ $quarto->id_quarto }}" tabindex="-1" aria-labelledby="modalLabelExcluir-{{ $quarto->id_quarto }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabelExcluir-{{ $quarto->id_quarto }}">Confirmar exclusão</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza que deseja excluir este quarto?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('quarto.delete', $quarto->id_quarto) }}" method="POST" style="display:inline;">
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
        </tbody>
    </table>
@endsection
