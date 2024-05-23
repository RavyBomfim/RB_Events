@extends('layouts.main')

@section('title', $event->title)

@section('content')

<div id="show-event-container" class="col-md-10 offset-md-1">
    <div class="row">
        <div id="image-container" class="col-md-6">
            @if($event->image)
                <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-fluid">
            @else
                <img src="/img/imgcard-default.webp" alt="{{$event -> title}}" class="img-fluid">
            @endif
        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{ $event->title }}</h1>
            <p class="event-city"> <ion-icon name="location-outline"></ion-icon> {{ $event->city }}</p>
            <p class="event-participants"> <ion-icon name="people-outline"></ion-icon> 27 Participantes</p>
            <p class="event-owner"> <ion-icon name="star-outline"></ion-icon> {{ $event_owner['name'] }}</p>
            <p class="date-time">
                <ion-icon name='calendar-outline'></ion-icon>
                {{ date('d/m/Y', strtotime($event->date)) }} às {{ date('H:i', strtotime($event->time)) }} horas
            </p>
            <p class="duration"> 
                <ion-icon name="time-outline"></ion-icon>
                {{ $event_duration }} de duração
            </p>
            <a href="#" class="btn btn-primary" id="event-submit">Confirmar Presença</a>
            @if($event->items)
                <h3>O evento conta com:</h3>
                <ul id="items-list">
                    @foreach($event->items as $item)
                        <li>
                            <ion-icon name="play-outline"></ion-icon>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div id="description-container" class="col-md-12">
            <h3>Sobre o evento</h3>
            <p class="event-description">{{ $event->description }} Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta maiores, tempore laborum sunt numquam, nobis maxime labore beatae exercitationem quia similique in, eos esse qui sequi ratione! Natus, ratione sapiente.</p>
        </div>
    </div>
</div>

@endsection