@extends('app')

@section('title', 'Criar Reserva')

@section('content')
    <h1>Criar Nova Reserva</h1>

    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cliente">Cliente</label>
            <select name="id_cliente" class="form-control" required>
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

        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Reserva</button>
    </form>
@endsection
