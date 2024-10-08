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
    <title>@yield('title')</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/"><img src="https://raw.githubusercontent.com/shii-ge/shii-ge/refs/heads/main/img/logo.png" style="padding-left:25px" height="40"></a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="/reservas">Reservas</a></li>
            <li class="nav-item"><a class="nav-link" href="/cliente">Clientes</a></li>
            <li class="nav-item"><a class="nav-link" href="/checkin">Check-in</a></li>
            <li class="nav-item"><a class="nav-link" href="/checkout">Check-out</a></li>
            <li class="nav-item"><a class="nav-link" href="/quartos">Quartos</a></li>
            <li class="nav-item"><a class="nav-link" href="/checkinout">[en costrussao...]</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <h1>@yield('h1')</h1>

    <!-- Veja se nao tem acerto (retorno de função) -->
    @if(session('success'))
        <div class="alert alerta-poggers" style="background: rgba(161,224,154,0.69); color: #043f04; font-weight: bold; border-radius: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <!--Veja se nao tem erro (retorno de função) -->
    @if(session('error'))
        <div class="alert alerta-perigo" style="background: rgba(243,140,155,0.69); color: #650b0b; font-weight: bold; border-radius: 10px;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Veja se nao tem erro (requisição)-->
    @if ($errors->any())
        <div class="alert alert-deubarba" style= "background: rgba(243,140,155,0.69); color: #650b0b; font-weight: bold; border-radius: 10px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@yield('scripts')
</body>
</html>
