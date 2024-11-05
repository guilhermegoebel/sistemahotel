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

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#acompanhantesModal">
            Adicionar acompanhante
        </button>

        <div class="modal fade" id="acompanhantesModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">Acompanhantes</div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Idade</th>
                                    <th>Selecionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($acompanhantes as $acompanhante)
                                    <tr>
                                        <td>{{ $acompanhante->nome }}</td>
                                        <td>{{ $acompanhante->idade }}</td>
                                        <td>
                                            <input type="checkbox" name="acompanhantes[]" value="{{ $acompanhante->id_acompanhante }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!--Formulario novo do acompanhante -->
                        <div class="title">Adicionar Acompanhante</div>
                        <div>
                            <label for="nome">Nome: </label>
                            <input type="text" name="nome" id="nome">
                        </div>
                        <div>
                            <label for="idade">Idade:</label>
                            <input type="number" name="idade" id="idade">
                        </div>
                        <button type="button" id="adicionarAcompanhante" class="btn btn-secondary">Adicionar</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

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
@endsection
