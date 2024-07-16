@extends('layouts.main')
@section('title', 'HDC Eventos')

@section('content')

    <div class="col-md-12 search-container">
        <h1>
            Busque um evento
        </h1>
        <form action="/" method="GET" class="formulario-pesquisa">
            <input type="text" name="search" id="search" class="form-control" placeholder="Pesquisar...">
        </form>
    </div>

    <div class="col-md-12 eventos-container">
        @if ($search)
            <h2>Buscando por: {{ $search }}</h2>
        @else
            <h2>Próximos Eventos</h2>
            <p>Veja os eventos dos proximos dias</p>
        @endif
        <div class="cards-container">
            @foreach ($eventos as $evento)
                <div class="card" style="width: 18rem;">
                    <img src="/img/eventos/{{ $evento->imagem }}" alt="{{ $evento->nome }}" class="card-img-top"
                        width="200" height="200">
                    <div class="card-body">
                        <h5 class="card-title">{{ $evento->nome }}</h5>
                        <p class="card-text">{{count($evento->users)}} Participantes</p>
                        <a href="{{ route('eventos.show', $evento->id) }}" class="card-link btn btn-warning mb-2">Saber
                            mais</a>
                        <p class="card-text"><small
                                class="text-body-secondary card-data">{{ date('d/m/y', strtotime($evento->data)) }}</small>
                        </p>
                    </div>
                </div>
            @endforeach

            @if (count($eventos) == 0)
                <p>Não há eventos disponiveis!</p>
            @endif
        </div>
    </div>

@endsection
