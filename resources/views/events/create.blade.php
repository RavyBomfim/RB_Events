@extends('layouts.main', ['current' => 'create-event'])

@section('title', 'Criar Evento')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/event-create-edit.css') }}">
@endsection

@section('content')

<div id="event-create-container">
    <h1>{{ $title_form }}</h1>
    <p class="subtitle">Clique no ícone de imagem abaixo e adicione uma imagem para o evento.</p>
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="inputs-group">
            <div id="img-box">
                <label for="image" id="label-event-img">
                    <img src="/img/add-picture.jpg" alt="" class="image-preview">
                </label>
                <input type="file" accept="image/*" class="form-control-file" id="image" name="image">
            </div>
            <div class="inputs-box">
                <div id="title-box" class="form-group">
                    <label class="form-label" for="title">Evento:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{ old('title') }}">
                    @error('title')
                        <span class='error-message'>{{ $message }}</span>
                    @enderror
                </div>
                <div id="date-time-box">
                    <div class="form-group">
                        <label class="form-label" for="date">Data do Evento:</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
                        @error('date')
                            <span class='error-message error-sm'>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="time">Horário:</label>
                        <input type="time" class="form-control" id="time" name="time" value="{{ old('time') }}">
                        @error('time')
                            <span class='error-message error-sm'>{{ $message }}</span>
                        @enderror
                    </div>
                    @if($errors->has('date') && $errors->has('time'))
                        <span class='error-message error-md'>Defina uma data e horário para o evento.</span>
                    @elseif($errors->has('date'))
                        @error('date')
                            <span class='error-message error-md'>{{ $message }}</span>
                        @enderror
                    @elseif($errors->has('time'))
                        @error('time')
                            <span class='error-message error-md' id="error-time">{{ $message }}</span>
                        @enderror
                    @endif
                </div>
            </div>
        </div>
        <div>
            <label class="form-label" for="duration">Duração do Evento:</label>
            <div id="duration-container">
                <input type="number" class="form-control" id="duration" name="duration" placeholder="Tempo de duração do evento em minutos" value="{{ old('duration') }}">
                <span id="duration-display">{{ session('duration') }}</span>
            </div>
            @error('duration')
                <span class='error-message'>{{ $message }}</span>
            @enderror
        </div>
        <div class="inputs-group">
            <div class="form-group">
                <label class="form-label" for="city">Cidade:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Local onde o evento ocorrerá" value="{{ old('city')}}">
                @error('city')
                    <span class='error-message'>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="private">O evento é privado?</label>
                <select name="private" id="private" class="form-control">
                    <option value="0" {{ old('private', '0') == '0' ? 'selected' : '' }}>Não</option>
                    <option value="1" {{ old('private', '0') == '1' ? 'selected' : '' }}>Sim</option>
                </select>
            </div>
        </div>
        <div>
            <label class="form-label" for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Detalhes sobre o evento...">{{ old('description') }}</textarea>
        </div>
        <div id="btn-select-container">
            <div id="select-box">
                <label for="chair" class="form-label">Adicione itens de infraestrutura:</label>
                <div class="selects-group">
                    <div id="checkbox-group">
                        <label>
                            <input type="checkbox" name="items[]" value="Cadeiras" id="chair" {{is_array(old('items')) && in_array('Cadeiras', old('items')) ? 'checked' : ''}}> Cadeiras
                        </label>
                        <label>
                            <input type="checkbox" name="items[]" value="Palco" {{is_array(old('items')) && in_array('Palco', old('items')) ? 'checked' : ''}}> Palco
                        </label>
                        <label>
                            <input type="checkbox" name="items[]" value="Open food" {{is_array(old('items')) && in_array('Open food', old('items')) ? 'checked' : ''}}> Open food
                        </label>
                    </div>
                    <div id="checkbox-group">
                        <label>
                            <input type="checkbox" name="items[]" value="Bebida grátis" {{is_array(old('items')) && in_array('Bebida grátis', old('items')) ? 'checked' : ''}}> Bebida grátis
                        </label>
                        <label>
                            <input type="checkbox" name="items[]" value="Brindes" {{is_array(old('items')) && in_array('Brindes', old('items')) ? 'checked' : ''}}> Brindes
                        </label>
                    </div>
                </div>
            </div>
            <div class="container-btn">
                <button type="submit" class="btn btn-primary">Criar evento</button>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/event-create-edit.js') }}"></script>
@endsection