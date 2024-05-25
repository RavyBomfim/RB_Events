@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie o seu evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label" for="title">Imagem do Evento:</label> <br>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label class="form-label" for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento">
        </div>
        <div class="form-group">
            <label class="form-label" for="date">Data do Evento:</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form-group">
            <label class="form-label" for="time">Horário:</label>
            <input type="time" class="form-control" id="time" name="time">
        </div>
        <div>
            <label class="form-label" for="duration">Duração do Evento:</label>
            <div id="duration-container">
                <input type="number" class="form-control" id="duration" name="duration" placeholder="Tempo de duração do evento em minutos">
                <label id="duration-display"></label>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local onde o evento ocorrerá">
        </div>
        <div class="form-group">
            <label class="form-label" for="city">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Detalhes sobre o evento..."></textarea>
        </div>
        <div class="form-group">
            <label class="form-label" for="description">Adicione itens de infraestrutura:</label>
            <div id="checkbox-group" class="form-group">
                <label>
                    <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
                </label>
                <label>
                    <input type="checkbox" name="items[]" value="Palco"> Palco
                </label>
                <label>
                    <input type="checkbox" name="items[]" value="Open food"> Open food
                </label>
                <label>
                    <input type="checkbox" name="items[]" value="Bebida grátis"> Bebida grátis
                </label>
                <label>
                    <input type="checkbox" name="items[]" value="Brindes"> Brindes
                </label>
            </div>
        </div>
        <div class="container-btn">
            <button type="submit" class="btn btn-primary">Criar evento</button>
        </div>
    </form>
</div>

@endsection