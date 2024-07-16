@extends('layouts.main')
@section('title', $evento->nome)

@section('content')
    <div class="container-show">
        <div class="row g-5">
            <div class="col-md-8">
                <article>
                    <h1>{{ $evento->nome }}</h1>
                    <p class="evento-date">Criado em {{ date('d/m/y', strtotime($evento->created_at)) }}</p>
                    <p class="evento-date"><i class="bi bi-people-fill"></i> {{ count($evento->users) }} Participantes</p>
                    <hr>
                    <img src="/img/eventos/{{ $evento->imagem }}" alt="{{ $evento->nome }}" class="img-fluid">
                    <div class="container-sobre">
                        <h3>Sobre o evento:</h3>
                        <p class="evento-description">{{ $evento->descricao }}</p>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">
                    @if (!$hasUserJoined)
                        <form action="/eventos/join/{{ $evento->id }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success botao-confirmar">Confirmar Presença</button>
                        </form>
                    @else
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <div>
                                Você já está participando deste evento.
                            </div>
                        </div>
                    @endif
                    <h3>O evento conta com:</h3>
                    <ul class="lista-itens">
                        @foreach ($evento->itens as $item)
                            <li><i class="bi bi-caret-right-fill"></i> {{ $item }}</li>
                        @endforeach
                    </ul>
                    <h3>Data do inicio do evento:</h3>
                    <p><i class="bi bi-calendar-check"></i> {{ date('d/m/y', strtotime($evento->data)) }}</p>
                    <h3>Local do evento:</h3>
                    <p><i class="bi bi-geo-alt"></i> {{ $evento->local }}</p>
                    <h3>Evento criado por:</h3>
                    <p><i class="bi bi-person-circle"></i> {{ $eventoDono['name'] }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
