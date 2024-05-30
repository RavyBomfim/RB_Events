@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offser-md-1 dashboard-title-container">
    <h1>Meus eventos</h1>
</div>

<div class="col-md-10 offser-md-1 dashboard-events-container">
    @if(count($events) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col" class="participants">Participantes</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td scope="rol">{{ $loop->index + 1 }}</td>
                        <td>
                            <a href="/event/{{ $event->id }}">{{ $event->title }}</a>
                        </td>
                        <td class="participants">
                            {{ count($event->users) }}
                        </td>
                        <td>
                            <div class="btn-container">
                                <a href="/events/edit/{{ $event->id }}" class="btn btn-edit btn-sm">
                                    <i class="fa-solid fa-pencil"></i> 
                                    <span class="participants">Editar</span> 
                                </a>
                                <form action="/events/{{ $event->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete btn-sm">
                                        {{-- <ion-icon name="trash-outline"></ion-icon> --}}
                                        <i class="fa-solid fa-trash-can"></i> 
                                        <span class="participants">Excluir</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Vocâ ainda não possui eventos, <a href="/events/create">criar evento</a>.</p>
    @endif
</div>

<div class="col-md-10 offser-md-1 dashboard-title-container">
    <h1>Eventos como participante</h1>
</div>

<div class="col-md-10 offser-md-1 dashboard-events-container">
    @if(count($eventsAsParticipant) > 0)
        <table class="table" id="event-as-participant">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col" class="participants">Participantes</th>
                    <th scope="col" class="participants">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eventsAsParticipant as $event)
                    <tr>
                        <td scope="rol">{{ $loop->index + 1 }}</td>
                        <td>
                            <a href="/event/{{ $event->id }}">{{ $event->title }}</a>
                        </td>
                        <td class="participants">
                            {{ count($event->users) }}
                        </td>
                        <td class="participants">
                            <div class="btn-container">
                                <form action="/event/leave/{{ $event->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-cancel-participation btn-sm">
                                        <i class="fas fa-times-circle"></i>
                                        Cancelar Participação</button>
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

@endsection