@extends('app')
@section('title', 'Adicionar Quartos')
@section('h1', 'Adicionar Quarto')
@section('content')
    <div class="container">

        <form action=" {{ route('quarto.create') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" name="tipo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="text" id="valor" name="valor" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Finalizar</button>

        </form>
    </div>
@endsection

@section('scripts')
    <script type="module">
        $(document).ready(function(){
            $('#valor').mask('000.000.000,00', {reverse: true});
        });
    </script>
@endsection
