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
                    <th scope="col">Participantes</th>
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
                        <td>
                            0
                        </td>
                        <td>
                            <a href="/events/edit/{{ $event->id }}" class="btn btn-edit btn-sm">
                                <i class="fa-solid fa-pencil"></i> 
                                Editar
                            </a>
                            <form action="/events/{{ $event->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete btn-sm">
                                    {{-- <ion-icon name="trash-outline"></ion-icon> --}}
                                    <i class="fa-solid fa-trash-can"></i> Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Vocâ ainda não possui eventos, <a href="/events/create">criar evento.</a></p>
    @endif
</div>

@endsection