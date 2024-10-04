@extends('app')

@section('title', 'Cliente Index')

@section('content')
    <h1>Cliente :D</h1>

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
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este cliente?')">Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
