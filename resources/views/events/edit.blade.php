@extends('layouts.main', ['current' => 'update-event'])

@section('title', 'Editando ' . $event->title)

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/event-create-edit.css') }}">
@endsection

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>{{ $title_form }}</h1>
    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label" for="title">Imagem do Evento:</label> <br>
            <input type="file" class="form-control-file" id="image" name="image">
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="image-preview">
        </div>
        <div class="form-group">
            <label class="form-label" for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}" placeholder="Nome do evento">
        </div>
        <div class="form-group">
            <label class="form-label" for="date">Data do Evento:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $event->date }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="time">Horário:</label>
            <input type="time" class="form-control" id="time" name="time" value="{{ $event->time }}">
        </div>
        <div>
            <label class="form-label" for="duration">Duração do Evento:</label>
            <div id="duration-container">
                <input type="number" class="form-control" id="duration" name="duration" value="{{ $event->duration }}" placeholder="Tempo de duração do evento em minutos">
                <label id="duration-display">{{ $event_duration }}</label>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city"  value="{{ $event->city }}" placeholder="Local onde o evento ocorrerá">
        </div>
        <div class="form-group">
            <label class="form-label" for="city">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1" {{$event->private == 1 ? 'selected="selected"' : ''}}>Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Detalhes sobre o evento...">{{ $event->description }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label" for="description">Adicione itens de infraestrutura:</label>
            <div id="checkbox-group" class="form-group">
                <label>
                    <input type="checkbox" name="items[]" value="Cadeiras" {{(is_array($event->items) && in_array('Cadeiras', $event->items)) ? 'checked="checked"' : ''}}> Cadeiras
                </label>
                <label>
                    <input type="checkbox" name="items[]" value="Palco" {{(is_array($event->items) && in_array('Palco', $event->items)) ? 'checked="checked"' : ''}}> Palco
                </label>
                <label>
                    <input type="checkbox" name="items[]" value="Open food" {{(is_array($event->items) && in_array('Open food', $event->items)) ? 'checked="checked"' : ''}}> Open food
                </label>
                <label>
                    <input type="checkbox" name="items[]" value="Bebida grátis" {{(is_array($event->items) && in_array('Bebida grátis', $event->items)) ? 'checked="checked"' : ''}}> Bebida grátis
                </label>
                <label>
                    <input type="checkbox" name="items[]" value="Brindes" {{(is_array($event->items) && in_array('Brindes', $event->items)) ? 'checked="checked"' : ''}}> Brindes
                </label>
            </div>
        </div>
        <div class="container-btn">
            <button type="submit" class="btn btn-primary" id="submit-edit">Editar evento</button>
            <a href="{{ route('events.dashboard') }}" class="btn btn-light btn-cancel">Cancelar</a>
        </div>
    </form>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/event-create-edit.js') }}"></script>
@endsection