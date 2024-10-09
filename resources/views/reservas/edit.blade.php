@extends('app')
@section('title', 'Editar Reserva')
@section('h1', 'Reservas')

@section('content')
    <div class="container">
        <!-- Forla Mário (Que mário?)-->
        <form action="{{ route('reservas.update', $reserva->id_reserva) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="cliente">Cliente</label>
                <select name="id_cliente" class="form-control" required>
                    @foreach($clientes as $cliente)
                        <option
                            value="{{ $cliente->id_cliente }}" {{ $cliente->id_cliente == $reserva->id_cliente ? 'selected' : '' }}>
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="data_checkin">Data de Check-in</label>
                <input type="date" name="data_checkin" class="form-control" value="{{ $reserva->data_checkin }}"
                       required>
            </div>

            <div class="form-group">
                <label for="data_checkout">Data de Check-out</label>
                <input type="date" name="data_checkout" class="form-control" value="{{ $reserva->data_checkout }}"
                       required>
            </div>

            <label for="quartos">Selecione os quartos:</label>
            @foreach($quartos as $quarto)
                <div>
                    <input type="checkbox" name="quartos[]" value="{{ $quarto->id_quarto }}"
                        {{ in_array($quarto->id_quarto, $quartosSelecionados) ? 'checked' : '' }}>
                    {{ $quarto->tipo }} - R$ {{ number_format($quarto->valor, 2 , ',', '.') }}
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Atualizar Reserva</button>
        </form>
    </div>
@endsection
