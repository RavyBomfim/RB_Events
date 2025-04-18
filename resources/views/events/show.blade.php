@extends('layouts.main', ['current' => 'show-event'])

@section('title', $event->title)

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/event-show.css') }}">
@endsection

@section('content')

<div id="show-event-container" class="col-md-10 offset-md-1">
    <div class="row">
        <div id="show-image-container" class="col-md-6">
            @if($event->image)
                <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-fluid">
            @else
                <img src="/img/imgcard-default.webp" alt="{{$event -> title}}" class="img-fluid">
            @endif
        </div>
        <div id="show-info-container" class="col-md-6">
            <h1>{{ $event->title }}</h1>
            <div id="show-info-box">
                <div id="informs-box">
                    <p class="event-city"> <ion-icon name="location-outline"></ion-icon> {{ $event->city }}</p>
                    <p class="event-participants"> 
                        <ion-icon name="people-outline"></ion-icon> 
                        {{ count($event->users) }} 
                        @if(count($event->users) == 1) 
                            Participante
                        @else
                            Participantes  
                        @endif
                    </p>
                    <p class="event-owner"> <ion-icon name="star-outline"></ion-icon> {{ $event_owner['name'] }}</p>
                    <p class="date-time">
                        <ion-icon name='calendar-outline'></ion-icon>
                        {{ date('d/m/Y', strtotime($event->date)) }} às {{ date('H:i', strtotime($event->time)) }} horas
                    </p>
                    <p class="duration"> 
                        <ion-icon name="time-outline"></ion-icon>
                        @if($event->duration)
                            {{ $event_duration }} de duração
                        @else
                            Duração não definida
                        @endif
                    </p>
                </div>
                <div class="btn-box">
                   @if($event_conclude) 
                        <button type="button" class="btn btn-cancel" disabled>Evento Finalizado</button>
                    @else
                        @if($hasUserJoined == false)
                            <form action="{{ route('events.join', $event->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary" id="event-submit">Confirmar Presença</button>
                            </form>
                        @else
                            <form action="{{ route('events.leave', $event->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">Cancelar Presença</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div id="description-container" class="col-md-12">
            <h3>Sobre o evento</h3>
            @if($event->description || $event->items)
                <p class="event-description">{{ $event->description }}</p>
            @else
                <p class="event-description">Não há mais detalhes sobre o evento.</p>
            @endif
        </div>
        @if($event->items)
            <div id="items-list" class="col-md-12">
                <h3>O evento conta com:</h3>
                <ul>
                    @foreach($event->items as $item)
                        <li>
                            <ion-icon name="play-outline"></ion-icon>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

@endsection