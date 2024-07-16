@extends('layouts.main')
@section('title', 'Editar Evento')

@section('content')
    <div class="container">
        <h1>Editando: {{ $evento->nome }}</h1>
        <form action="/eventos/{{ $evento->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome">Nome do Evento:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $evento->nome }}" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" required>{{ $evento->descricao }}</textarea>
            </div>
            <div class="form-group">
                <label for="data">Data do Evento:</label>
                <input type="date" class="form-control" id="data" name="data" value="{{ $evento->data }}" required>
            </div>
            <div class="form-group">
                <label for="local">Local do Evento:</label>
                <input type="text" class="form-control" id="local" name="local" value="{{ $evento->local }}" required>
            </div>
            <div class="form-group">
                <label for="imagem">Imagem do Evento:</label>
                <input type="file" class="form-control-file" id="imagem" name="imagem">
            </div>
            <input type="submit" class="btn btn-primary" value="Atualizar Evento">
        </form>
    </div>
@endsection
