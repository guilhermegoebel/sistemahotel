@extends('app')
@section('title', 'Adicionar reserva')
@section('h1', 'Adicionar nova reserva')

@section('content')
    <form action="{{ route('reservas.add') }}" method="POST" id="form">
        @csrf

        <!-- Cliente -->
        <div class="form-group">
            <label for="id_cliente" class="col-form-label">Cliente</label>
            <div class="row align-items-center">
                <div class="col-sm-10">
                    <select name="id_cliente" class="form-control" required>
                        <option value="">Selecione um cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}"
                                {{ old('id_cliente') == $cliente->id_cliente ? 'selected' : '' }}>
                                {{ $cliente->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2 d-flex">
                    <a href="{{ route('cliente.add') }}" target="_blank" class="btn btn-outline-primary w-100">Adicionar novo cliente</a>
                </div>
            </div>
            @error('id_cliente')
            <div class="col-sm-12 text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>



        <!-- Data Check-in -->
        <div class="form-group">
            <label for="data_checkin">Data de Check-in</label>
            <input type="date" name="data_checkin" class="form-control" value="{{ old('data_checkin') }}" required>
            @error('data_checkin')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Data Check-out -->
        <div class="form-group">
            <label for="data_checkout">Data de Check-out</label>
            <input type="date" name="data_checkout" class="form-control" value="{{ old('data_checkout') }}" required>
            @error('data_checkout')
            <div class="text-danger">{{ $message }}</div>
            @enderror
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

        <!-- Modal Estilizado -->
        <div id="modalAcompanhante" class="modal">
            <div class="modal-content">
                <h4>Adicionar Acompanhante</h4>
                <label>Nome: </label>
                <input type="text" id="acompanhanteNome" class="form-control mb-2">
                <label>Idade: </label>
                <input type="number" id="acompanhanteIdade" class="form-control mb-2">
                <button type="button" class="btn btn-success mt-3" onclick="adicionarAcompanhante()">Adicionar</button>
                <button type="button" class="btn btn-secondary mt-3" onclick="fecharModal()">Fechar</button>
            </div>
        </div>

        <input type="hidden" name="acompanhantes" id="acompanhantesInput">

        <!-- Quartos -->
        <div class="form-group">
            <label for="quartos">Selecione os quartos:</label>
            @foreach($quartos as $quarto)
                <div>
                    <input type="checkbox" name="quartos[]" value="{{ $quarto->id_quarto }}"
                        {{ is_array(old('quartos')) && in_array($quarto->id_quarto, old('quartos')) ? 'checked' : '' }}>
                    {{ $quarto->tipo }} - R$ {{ number_format($quarto->valor, 2, ',', '.') }}
                </div>
            @endforeach
            @error('quartos')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            @error('quartos.*')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botões de Ação -->
        <button type="submit" class="btn btn-primary">Salvar Reserva</button>
        <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

    <script type="module">
        $('#form').on('submit', function () {
            Swal.fire({
                icon: 'info',
                title: 'Aguarde...',
                allowOutsideClick: false,
                showConfirmButton: false,
            });
        });
    </script>

    <script>
        let acompanhantes = [];

        function adicionarAcompanhante() {
            const nome = document.getElementById('acompanhanteNome').value;
            const idade = document.getElementById('acompanhanteIdade').value;

            if (nome && idade) {
                const acompanhante = {nome, idade};
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

    <style>
        /* Estilos do Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            margin: auto;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .modal-content h4 {
            margin-bottom: 15px;
            color: #333;
        }
    </style>
@endsection
