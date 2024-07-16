@extends('layouts.main')
@section('title', 'Criar evento')

@section('content')
    <div class="evento-criacao">
        <h1>Crie um evento</h1>
        <form action="/eventos" class="row g-3 evento-criacao-formulario" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <label for="nome" class="form-label">Título:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do evento">
            </div>
            <div class="col-12">
                <label for="data" class="form-label">Data do Evento:</label>
                <input type="date" class="form-control" id="data" name="data">
            </div>
            <div class="col-12">
                <label for="local" class="form-label">Local:</label>
                <input type="text" class="form-control" id="local" name="local" placeholder="Local do Evento">
            </div>
            <div class="col-md-12">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição do evento"></textarea>
            </div>
            <div class="col-md-12">
                <label for="itens" class="form-label">Adicione itens de infraestrutura:</label>
                <div class="form-grup">
                    <input type="checkbox" name="itens[]" id="itens" value="Cadeiras"> Cadeiras
                </div>
                <div class="form-grup">
                    <input type="checkbox" name="itens[]" id="itens" value="Mesas"> Mesas
                </div>
                <div class="form-grup">
                    <input type="checkbox" name="itens[]" id="itens" value="Computadores"> Computadores
                </div>
                <div class="form-grup">
                    <input type="checkbox" name="itens[]" id="itens" value="Suporte Tecnico"> Suporte Técnico
                </div>
            </div>
            <div>
                <label for="imagem" class="form-label">Imagem:</label>
                <input type="file" id="imagem" name="imagem" class="form-control-file">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Criar</button>
            </div>
        </form>
    </div>
@endsection
