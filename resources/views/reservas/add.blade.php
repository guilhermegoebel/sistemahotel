@extends('app')
@section('title', 'Criar Reserva')
@section('h1', 'Adicionar Nova Reserva')

@section('content')
    <form action="{{ route('reservas.add') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_cliente">Cliente</label>
            <select name="id_cliente" class="form-control" required>
                <option value="">Selecione um cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}">{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="data_checkin">Data de Check-in</label>
            <input type="date" name="data_checkin" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="data_checkout">Data de Check-out</label>
            <input type="date" name="data_checkout" class="form-control" required>
        </div>

        <h5>Acompanhantes</h5>
        <table class="table" id="tabelaAcompanhantes">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            <!-- Acompanhantes adicionados serão exibidos aqui -->
            </tbody>
        </table>

        <button type="button" class="btn btn-primary" onclick="abrirModal()">Adicionar Acompanhante</button>

        <div id="modalAcompanhante" class="modal">
            <div class="modal-content">
                <h4>Adicionar Acompanhante</h4>
                <label>Nome: </label>
                <input type="text" id="acompanhanteNome">
                <label>Idade: </label>
                <input type="number" id="acompanhanteIdade">
                <button type="button" onclick="adicionarAcompanhante()">Adicionar</button>
                <button type="button" onclick="fecharModal()">Fechar</button>
            </div>
        </div>

        <input type="hidden" name="acompanhantes" id="acompanhantesInput">

        <div class="form-group">
            <label for="quartos">Selecione os quartos:</label>
            @foreach($quartos as $quarto)
                <div>
                    <input type="checkbox" name="quartos[]" value="{{ $quarto->id_quarto }}">
                    {{ $quarto->tipo }} - R$ {{ number_format($quarto->valor, 2, ',', '.') }}
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Salvar Reserva</button>
        <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

    <script>
        let acompanhantes = [];

        function adicionarAcompanhante() {
            const nome = document.getElementById('acompanhanteNome').value;
            const idade = document.getElementById('acompanhanteIdade').value;

            if (nome && idade) {
                const acompanhante = { nome, idade };
                acompanhantes.push(acompanhante);

                document.getElementById('acompanhanteNome').value = '';
                document.getElementById('acompanhanteIdade').value = '';

                atualizarTabelaAcompanhantes();
                fecharModal();

                document.getElementById('acompanhantesInput').value = JSON.stringify(acompanhantes);
            }
        }

        function removerAcompanhante(index) {
            acompanhantes.splice(index, 1);
            atualizarTabelaAcompanhantes();
            document.getElementById('acompanhantesInput').value = JSON.stringify(acompanhantes);
        }

        function atualizarTabelaAcompanhantes() {
            const tabela = document.getElementById('tabelaAcompanhantes').getElementsByTagName('tbody')[0];
            tabela.innerHTML = '';

            acompanhantes.forEach((acompanhante, index) => {
                const row = tabela.insertRow();

                row.innerHTML = `
                    <td>${acompanhante.nome}</td>
                    <td>${acompanhante.idade}</td>
                    <td><button type="button" class="btn btn-danger" onclick="removerAcompanhante(${index})">Remover</button></td>
                `;
            });
        }

        function abrirModal() {
            document.getElementById('modalAcompanhante').style.display = 'block';
        }

        function fecharModal() {
            document.getElementById('modalAcompanhante').style.display = 'none';
        }
    </script>
@endsection
