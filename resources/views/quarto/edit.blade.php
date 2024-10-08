@extends('app')
@section('title', 'Editar quarto')
@section('h1', 'Editar Quarto')
@section('content')
    <div class="container">

        <form action=" {{ route('quarto.update', $quarto->id_quarto)  }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" name="tipo" value="{{ $quarto->tipo }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="text" id="valor" name="valor" value="{{ $quarto->valor }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>

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
