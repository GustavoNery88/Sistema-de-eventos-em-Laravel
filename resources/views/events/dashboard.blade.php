@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
    <div class="dashboard">
        <h2>Meus Eventos</h2>
        @if(count($eventos) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Participantes</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventos as $evento)
                        <tr>
                            <td>{{ $evento->nome }}</td>
                            <td>{{ date('d/m/Y', strtotime($evento->data)) }}</td>
                            <td>{{count($evento->users)}}</td>
                            <td>
                                <a href="/eventos/{{ $evento->id }}" class="btn btn-info">Ver</a>
                                <a href="/eventos/{{ $evento->id }}/edit" class="btn btn-warning">Editar</a>
                                <form action="/eventos/{{ $evento->id }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja deletar este evento?')">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não tem eventos criados.</p>
        @endif
    </div>

    <div>
        <h2>Eventos que estou participando</h2>
        @if(count($eventosComoParticipante) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventosComoParticipante as $evento)
                        <tr>
                            <td>{{ $evento->nome }}</td>
                            <td>{{ date('d/m/Y', strtotime($evento->data)) }}</td>
                            <td>
                                <a href="/eventos/{{ $evento->id }}" class="btn btn-info">Ver</a>
                                <form action="/eventos/leave/{{ $evento->id }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Sair do evento</button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você não participou de nenhum evento.</p>
        @endif
    </div>
@endsection
