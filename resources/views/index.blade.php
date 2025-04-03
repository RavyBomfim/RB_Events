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
        <a href="{{ route('home') }}" id="btn-search-reset" class="btn">
            <ion-icon name="close-outline"></ion-icon>
        </a>
        <button type="submit" class="btn" id="btn-search-submit">
            <ion-icon name="search-outline"></ion-icon>
        </button>
    </form>
</div>

<div class="col-md-12">
    <div class="events-container">
        <h2 class="title">Próximos eventos</h2>
        @if(count($next_events) > 0)
            @if($search)
                <p class="subtitle">Resultados de <span>{{ $search }}</span> para os próximos eventos.</p>
            @else
                <p class="subtitle">Veja os eventos que estão para acontecer</p>
            @endif
        @else 
            @if($search)
                <p class="search-results">Sem resultados para <span>{{ $search }}</span></p>
            @else
                <p>Não há próximos eventos disponíveis</p>
            @endif
        @endif
        <div class="cards-container row">
            @foreach($next_events as $event)
                <div class="card col-md-3">
                    @if($event->image)
                        <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="image-card">
                    @else
                        <img src="/img/imgcard-default.webp" alt="{{ $event->title }}" class="image-card">
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
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-know-more">
                            Saber mais
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="paginate">
            {{ $next_events->appends(request()->except('next-events-page'))->links() }}
        </div>
    </div>

    <div class="events-container">
        <h2 class="title">Eventos Passados</h2>
        @if(count($last_events) > 0)
            @if($search)
                <p class="subtitle">Resultados de <span class>{{ $search }}</span> para os eventos passados</p>
            @else
                <p class="subtitle">Confira os eventos que já aconteceram</p>
            @endif
        @else 
            @if($search)
                <p class="search-results">Sem resultados para <span>{{ $search }}</span></p>
            @else
                <p>Não há eventos passados disponíveis</p>
            @endif
        @endif
        <div class="cards-container row">
            @foreach($last_events as $event)
                <div class="card col-md-3">
                    @if($event->image)
                        <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="image-card">
                    @else
                        <img src="/img/imgcard-default.webp" alt="{{ $event->title }}" class="image-card">
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
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-know-more">Saber mais</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="paginate">
            {{ $last_events->appends(request()->except('last-events-page'))->links() }}
        </div>
    </div>
</div>

@endsection