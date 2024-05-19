@extends('layouts.main')

@section('title','RB Events')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
        <button type="reset">
            <ion-icon name="close-outline"></ion-icon>
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
                    @if($event->date)
                    <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                    @else
                    <p class="card-date">18/07/2024</p>
                    @endif
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-participants">
                      x Participantes  
                    </p>
                    <a href="/event/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
                </div>
            </div>
        @endforeach
    </div>
    @if(count($events) == 0 && $search) 
        <p class="search-results">Não há resultados para {{ $search }}! &nbsp;  <a href="/">Ver todos</a></p>
    @elseif(count($events) == 0)
        <p>Não há eventos disponíveis</p>
    @endif
</div>

@endsection