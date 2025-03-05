@extends('layouts.main', ['current' => 'home'])

@section('title','RB Events')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
        <button type="reset" id="btn-search-reset">
            <ion-icon name="close-outline"></ion-icon>
        </button>
        <button type="submit" class="btn" id="btn-search-submit">
            <ion-icon name="search-outline"></ion-icon>
        </button>
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if($search)
        <h2 class="search-results">Resultados de: {{ $search }}</h2> <br>
    @else
        <h2 class="title">Próximos eventos</h2>
        <p class="subtitle">Veja os eventos para os próximos dias</p>
    @endif
    <div id="cards-container" class="row">
        @foreach($events as $event)
            <div class="card col-md-3">
                @if($event->image)
                    <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
                @else
                    <img src="/img/imgcard-default.webp" alt="{{ $event->title }}">
                @endif
                <div class="card-body">
                    <p class="card-date">@if($event->date) {{ date('d/m/Y', strtotime($event->date)) }} @endif <ion-icon name="calendar-outline"></ion-icon></p>
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-participants">
                        {{ count($event->users) }} 
                        @if(count($event->users) == 1) 
                            Participante
                        @else
                            Participantes  
                        @endif
                    </p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">Saber mais</a>
                </div>
            </div>
        @endforeach
    </div>
    @if(count($events) == 0 && $search) 
        <p class="search-results">
            Sem resultados para <span>{{ $search }}</span>!  
            <a href="/">Ver todos</a></p>
    @elseif(count($events) == 0)
        <p>Não há eventos disponíveis</p>
    @endif
</div>

@endsection