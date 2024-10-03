@extends('app')

@section('title', 'Editar Reserva')

@section('content')
    <h1>Editar Reserva</h1>

    <form action="{{ route('reservas.update', $reserva->id_reserva) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="cliente">Cliente</label>
            <select name="id_cliente" class="form-control" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}" {{ $cliente->id_cliente == $reserva->id_cliente ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="data_checkin">Data de Check-in</label>
            <input type="date" name="data_checkin" class="form-control" value="{{ $reserva->data_checkin }}" required>
        </div>

        <div class="form-group">
            <label for="data_checkout">Data de Check-out</label>
            <input type="date" name="data_checkout" class="form-control" value="{{ $reserva->data_checkout }}" required>
        </div>

        <div class="form-group">
            <label for="quartos">Número de Quartos</label>
            <input type="number" name="quartos" class="form-control" value="{{ $reserva->quartos }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" value="{{ $reserva->status }}">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Reserva</button>
    </form>
@endsection
