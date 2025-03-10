@extends('layouts.main', ['current' => 'update-event'])

@section('title', 'Editando ' . $event->title)

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/event-create-edit.css') }}">
@endsection

@section('content')

<div id="event-create-container">
    <h1>{{ $title_form }}</h1>
    <p class="subtitle">Para mudar a imagem do evento, clique na imagem atual e selecione uma nova.</p>
    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="inputs-group">
            <div id="img-box">
                <label for="image" id="label-event-img">
                    @if($event->image)
                        <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="image-preview">
                    @else
                        <img src="{{ asset('img/imgcard-default.webp') }}" alt="{{ $event->title }}" class="image-preview">
                    @endif
                </label> 
                <input type="file" accept="image/*" class="form-control-file" id="image" name="image">
            </div>
            <div class="inputs-box">
                <div id="title-box" class="form-group">
                    <label class="form-label" for="title">Evento:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $event->title) }}" placeholder="Nome do evento">
                </div>
                <div id="date-time-box">
                    <div class="form-group">
                        <label class="form-label" for="date">Data do Evento:</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $event->date) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="time">Horário:</label>
                        <input type="time" class="form-control" id="time" name="time" value="{{ old('time', $event->time) }}">
                    </div>
                </div>
            </div>
        </div>
        <div>
            <label class="form-label" for="duration">Duração do Evento:</label>
            <div id="duration-container">
                <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration', $event->duration) }}" placeholder="Tempo de duração do evento em minutos">
                <span id="duration-display">{{ session('duration', $event_duration) }}</span>
            </div>
        </div>
        <div class="inputs-group">
            <div class="form-group">
                <label class="form-label" for="city">Cidade:</label>
                <input type="text" class="form-control" id="city" name="city"  value="{{ $event->city }}" placeholder="Local onde o evento ocorrerá">
            </div>
            <div class="form-group">
                <label class="form-label" for="private">O evento é privado?</label>
                <select name="private" id="private" class="form-control">
                    <option value="0">Não</option>
                    <option value="1" {{ old('private', $event->private) == 1 ? 'selected="selected"' : '' }}>Sim</option>
                </select>
            </div>
        </div>
        <div>
            <label class="form-label" for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Detalhes sobre o evento...">{{ old('description', $event->description) }}</textarea>
        </div>
        <div id="btn-select-container">
            <div>
                <label for="chair" class="form-label">Adicione itens de infraestrutura:</label>
                <div class="selects-group">
                    <div id="checkbox-group">
                        <label>
                            <input type="checkbox" name="items[]" value="Cadeiras" {{(is_array(old('items', $event->items)) && in_array('Cadeiras', old('items', $event->items))) ? 'checked' : ''}} id="chair"> Cadeiras
                        </label>
                        <label>
                            <input type="checkbox" name="items[]" value="Palco" {{(is_array(old('items',$event->items)) && in_array('Palco', old('items', $event->items))) ? 'checked' : ''}}> Palco
                        </label>
                        <label>
                            <input type="checkbox" name="items[]" value="Open food" {{(is_array(old('items', $event->items)) && in_array('Open food', old('items', $event->items))) ? 'checked' : ''}}> Open food
                        </label>
                    </div>
                    <div id="checkbox-group">
                        <label>
                            <input type="checkbox" name="items[]" value="Bebida grátis" {{(is_array(old('items', $event->items)) && in_array('Bebida grátis', old('items', $event->items))) ? 'checked' : ''}}> Bebida grátis
                        </label>
                        <label>
                            <input type="checkbox" name="items[]" value="Brindes" {{(is_array(old('items', $event->items)) && in_array('Brindes', old('items', $event->items))) ? 'checked' : ''}}> Brindes
                        </label>
                    </div>
                </div>
            </div>
            <div class="container-btn">
                <button type="submit" class="btn btn-primary" id="submit-edit">Editar evento</button>
                <a href="{{ route('events.dashboard') }}" class="btn btn-light btn-cancel">Cancelar</a>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/event-create-edit.js') }}"></script>
@endsection