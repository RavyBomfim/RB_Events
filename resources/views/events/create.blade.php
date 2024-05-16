@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie o seu evento</h1>
    <form action="/events" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label" for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento">
        </div>
        <div class="form-group">
            <label class="form-label" for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local onde o evento ocorrerá">
        </div>
        {{-- <div class="form-group">
            <label class="form-label">O evento é privado?</label>
            <div class="radio-group">
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="yes-option" name="private" value="1"> 
                    <label class="form-check-label" for="yes-option">Sim</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="no-option" name="private" value="0" checked>
                    <label class="form-check-label" for="no-option">Não</label>
                </div>
            </div>
        </div> --}}
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
        <input type="submit" class="btn btn-primary" value="Criar evento">
    </form>
</div>

@endsection