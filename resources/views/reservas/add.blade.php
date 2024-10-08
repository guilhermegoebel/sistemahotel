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

        <div class="form-group">
            <label for="quartos">Número de Quartos</label>
            <input type="number" name="quartos" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Reserva</button>
        <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
