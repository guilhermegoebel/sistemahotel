@extends('app')
@section('title', 'Hotel Pôr do Sol')

@section('content')
    <div class="d-flex align-items-center mb-4">
        <!-- Texto de Introdução -->
        <div class="me-4">
            <h1><b>Sistema de gerenciamento do Hotel Pôr do Sol</b></h1>
            <p>O Hotel Pôr do Sol é o destino perfeito para quem busca relaxamento e conforto. Nosso sistema de gerenciamento foi projetado para facilitar todas as operações do hotel, garantindo uma experiência fluida para hóspedes e funcionários.</p>
        </div>

        <!-- Imagem Decorativa (ao lado do texto) -->
        <img src="https://vivaomundo.com.br/wp-content/uploads/2018/11/Solar-Mirador.jpg" alt="Resort de Praia" class="img-fluid" style="max-width: 300px; float: right; border-radius: 8px;">
    </div>

    <div class="row mt-4">
        <!-- Card Adicionar Reserva -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><b>Adicionar reserva</b></h5>
                    <p class="card-text">Gerencie e adicione novas reservas para seus hóspedes, garantindo uma experiência organizada e sem falhas.</p>
                    <a href="{{ route('reservas.add') }}" class="btn btn-outline-primary">Adicionar Reserva</a>
                </div>
            </div>
        </div>

        <!-- Card Adicionar Cliente -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><b>Adicionar cliente</b></h5>
                    <p class="card-text">Cadastre novos clientes para manter seu banco de dados atualizado e garantir um serviço de qualidade.</p>
                    <a href="{{ route('cliente.add') }}" class="btn btn-outline-primary">Adicionar Cliente</a>
                </div>
            </div>
        </div>
    </div>
@endsection
