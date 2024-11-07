@extends('app')
@section('title', 'Adicionar cliente')
@section('h1', 'Adicionar novo cliente')

@section('content')
    <div class="container">
        <form action=" {{ route('cliente.add')  }}" method="POST" id="form">
            @csrf

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" name="data_nascimento" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Finalizar cadastro</button>

        </form>
    </div>

    <script type="module">
        $('#form').on('submit', function() {
            Swal.fire({
                icon: 'info',
                title: 'Aguarde...',
                allowOutsideClick: false,
                showConfirmButton: false,
            });
        });
    </script>
@endsection
