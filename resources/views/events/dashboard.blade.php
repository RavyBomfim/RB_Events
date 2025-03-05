@extends('layouts.main', ['current' => 'dashboard'])

@section('title', 'Meus eventos')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')

<div class="dashboard-container">
    <div class="card border col-md-10 mx-10 p-0 offset-md-1 dashboard-events">
        <div class="card-header ">
            <h2 class="card-title">Meus eventos</h2>
        </div>
        <div class="card-body p-0">
            @if(count($events) > 0)
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col" class="participants">Participantes</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td class="title-photo-box">
                                    <a href="{{route('events.show', $event->id )}}">
                                        @if($event->image)
                                            <img src="/img/events/{{ $event->image }}">
                                        @else
                                            <img src="/img/imgcard-default.webp">
                                        @endif
                                        {{ $event->title }}
                                    </a>
                                </td>
                                <td class="participants">
                                    {{ count($event->users) }}
                                </td>
                                <td>
                                    <div class="btn-box">
                                        <a href="{{route('events.edit', $event->id )}}" class="btn btn-edit btn-sm">
                                            <i class="fa-solid fa-pencil"></i> 
                                            <span class="participants">Editar</span> 
                                        </a>
                                        <form action="{{route('events.delete', $event->id )}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-delete btn-sm" data-event-id="{{ $event->id }}">
                                                <i class="fa-solid fa-trash-can"></i> 
                                                <span class="participants">Excluir</span>
                                            </button>
                                            <div class="modal fade" id="modal-delete{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <p>Tem certeza que deseja excluir <span>{{ $event->title }}</span>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Vocâ ainda não possui eventos, <a href="{{route('events.create')}}">criar evento</a>.</p>
            @endif
        </div>
    </div>

    <div class="card border col-md-10 p-0 offset-md-1 dashboard-events">
        <div class="card-header">
            <h2 class="card-title">Eventos como participante</h2>
        </div>
        <div class="card-body p-0">
            @if(count($eventsAsParticipant) > 0)
                <table class="table m-0" id="event-as-participant">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col" class="participants">Participantes</th>
                            <th scope="col" class="participants">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eventsAsParticipant as $event)
                            <tr>
                                <td class="title-photo-box">
                                    <a href="{{route('events.show', $event->id )}}">
                                        @if($event->image)
                                            <img src="/img/events/{{ $event->image }}">
                                        @else
                                            <img src="/img/imgcard-default.webp">
                                        @endif
                                        {{ $event->title }}
                                    </a>
                                </td>
                                <td class="participants">
                                    {{ count($event->users) }}
                                </td>
                                <td class="participants">
                                    <div class="btn-box">
                                        <form action="{{route('events.leave', $event->id )}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-cancel-participation btn-sm">
                                                <i class="fas fa-times-circle"></i>
                                                Cancelar Participação
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Vocâ ainda não se inscreveu em nenhum evento, <a href="/">veja todos os eventos</a>.</p>
            @endif
        </div>
    </div>
</div>

@endsection