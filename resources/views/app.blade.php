<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>


    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">


    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <title>@yield('title')</title>
    <link rel="icon" href="https://em-content.zobj.net/source/skype/289/hotel_1f3e8.png" type="image/png">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/"><img src="https://raw.githubusercontent.com/shii-ge/shii-ge/refs/heads/main/img/logo.png" style="padding-left:25px" height="40"></a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="/reservas">Reservas</a></li>
            <li class="nav-item"><a class="nav-link" href="/cliente">Clientes</a></li>
            <li class="nav-item"><a class="nav-link" href="/quartos">Quartos</a></li>
            <li class="nav-item"><a class="nav-link" href="/historico">Histórico de Check-in/Check-Out</a></li>
        </ul>
    </div>
</nav>
<div class="container" style="padding-top: 20px;">
    <h1>@yield('h1')</h1>


    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@yield('scripts')


{{-- ESSAS LINHAS CONFIGURAM OS SWALL --}}
@if(Session::has('success'))
    <script type="module">
        Swal.fire({
            icon: "success",
            title: "Sucesso!",
            text: '{{ Session::get('success') }}',
        });
    </script>
@elseif(Session::has('error'))
    <script type="module">
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Ocorreu um erro no sistema!",
            footer: '<p>Entre em contato para resolvermos o problema!</p>'
        });
    </script>
@endif


<script>
    $(document).ready(function() {
        $('.table-striped').DataTable({
            "pageLength": 10,
            "lengthMenu": [10, 25, 50, 100],
            "language": {
                "decimal": "",
                "emptyTable": "Nenhum dado disponível",
                "info": "Mostrando de _START_ a _END_ de um total de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(filtrado de um total de _MAX_ registros)",
                "infoPostFix": "",
                "thousands": ".",
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "loadingRecords": "Carregando...",
                "processing": "",
                "search": "Pesquisar:",
                "zeroRecords": "Nenhum registro correspondente encontrado",
                "paginate": {
                    "first": "Primeiro",
                    "last": "Último",
                    "next": "Próximo",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": ativar para classificar a coluna em ordem crescente",
                    "sortDescending": ": ativar para classificar a coluna em ordem decrescente"
                }
            },
            "ordering": true,
            "searching": true,
            "columnDefs": [
                { "orderable": false, "targets": -1 } // Desabilita ordenação para a coluna 'Ações'
            ]
        });
    });
</script>
</body>
</html>

