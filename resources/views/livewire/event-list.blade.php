<div>
    <div id="search-container" class="col-md-12 mb-4">
        <h1>Busque um evento</h1>
        <input type="text" wire:model.debounce.500ms="search" id="search" class="form-control" placeholder="Procurar...">
    </div>

    <div id="events-container" class="col-md-12">
        <h2 class="title">Próximos eventos</h2>
        @if($nextEvents->count())
            @if($search)
                <p class="subtitle">Resultados de <span>{{ $search }}</span> para os próximos eventos.</p>
            @else
                <p class="subtitle">Veja os eventos que estão para acontecer</p>
            @endif
            <div id="cards-container" class="row">
                @foreach($nextEvents as $event)
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
                {{ $nextEvents->links() }}
            </div>
        @else 
            <p>Não há próximos eventos disponíveis</p>
        @endif
    </div>

    <div id="events-container" class="col-md-12 mt-5">
        <h2 class="title">Eventos Passados</h2>
        @if($lastEvents->count())
            @if($search)
                <p class="subtitle">Resultados de <span>{{ $search }}</span> para os eventos passados.</p>
            @else
                <p class="subtitle">Confira os eventos que já aconteceram</p>
            @endif
            <div id="cards-container" class="row">
                @foreach($lastEvents as $event)
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
                {{ $lastEvents->links() }}
            </div>
        @else 
            <p>Não há eventos passados disponíveis</p>
        @endif
    </div>
</div>

