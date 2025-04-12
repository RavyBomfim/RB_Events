@extends('layouts.main', ['current' => 'my-events', 'option' => 'as-participant'])

@section('title', 'Meus eventos')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')

<div class="dashboard-container">
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
                                <td class="as-participant">
                                    <div class="btn-box">
                                        @if($events_conclude[$event->id])
                                            <button type="button" class="btn btn-delete btn-sm" disabled>
                                                <i class="fa-solid fa-check"></i>
                                                <span class="txt-button">Evento Finalizado</span> 
                                            </button>
                                        @else
                                            <form action="{{route('events.leave', $event->id )}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-delete btn-cancel-participation btn-sm" data-event-id="{{ $event->id }}">
                                                    <i class="fas fa-times-circle"></i>
                                                    <span class="txt-button">Cancelar Presença</span>
                                                </button>
                                                <div class="modal fade" id="modal-delete{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Tem certeza que deseja cancelar a participação em <span>{{ $event->title }}</span>?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary">Confirmar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if($eventsAsParticipant->lastPage() > 1)
                            <tr id="table-paginate">
                                <td colspan="3">
                                    {{ $eventsAsParticipant->links() }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            @else
                <div class="informs-box">
                    <p>Você ainda não se inscreveu em nenhum evento.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Ver eventos</a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection