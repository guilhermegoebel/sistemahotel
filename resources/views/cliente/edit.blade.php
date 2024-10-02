@extends('app')

@section('title', 'Cliente :: Editar')
@section('content')
    <div class="container">
        <h1>Editar Cliente</h1>

        <!--Veja se n tem erro -->
        @if ($errors->any())
            <div class="alert alerta-perigo">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario poggers agora -->
        <form action=" {{ route('cliente.update', $cliente->id_cliente)  }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" value="{{ $cliente->nome }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" value="{{ $cliente->cpf }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="text" name="data_nascimento" value="{{ $cliente->data_nascimento }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" value="{{ $cliente->telefone }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ $cliente->email }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" value="{{ $cliente->endereco }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>

        </form>
    </div>
@endsection
