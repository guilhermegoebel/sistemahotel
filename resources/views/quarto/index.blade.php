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
                <td>{{ $quarto->valor }}</td>
                <td>
                    <a href="{{ route('quarto.edit', $quarto->id_quarto) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('quarto.delete', $quarto->id_quarto) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este quarto?')">Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
