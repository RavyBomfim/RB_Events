<nav class="navbar navbar-expand-lg navbar-light" id="navbar-container">
    <div class="collapse navbar-collapse" id="navbar">
        <a href="{{ route('home') }}" class=" navbar-brand">
            <img src="{{ asset('img/rbevents-logo.png') }}" alt="Logo" id="logo">
        </a>
        <div id="menu-button">
            <ion-icon name="menu-outline"></ion-icon>
        </div>
        <ul id="menu" @if($current != 'home') class="navbar nav menu-mobile" @else class="navbar nav" @endif>
            @auth
                <li class="nav-item profile-box hidden-option">
                    <a href="{{ route('profile.show') }}" class="nav-link">
                        <div class="link-profile">
                            @if(auth()->user()->profile_photo_path)
                                <img class="profile-photo" src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Foto de Perfil">
                            @else
                                <img class="profile-photo" src="{{ asset('img/profile.png') }}">
                            @endif
                            <div class="user-email-box">
                                <span>{{ auth()->user()->name }}</span>
                                <p class="email">{{ auth()->user()->email }}</p>
                                {{-- <p>201916360010@ifba.edu.br</p> --}}
                            </div>
                        </div>
                        <i class="fa-solid fa-gear"></i>
                    </a>
                </li>
            @endauth
            <li @if($current == 'home' or $current == 'show-event') class="nav-item active" @else class="nav-item" @endif>
                <a href="{{ route('home') }}" class="nav-link">Início</a>
            </li>
            <li @if($current == 'create-event') class="nav-item active" @else class="nav-item" @endif>
                <a href="{{ route('events.create') }}" class="nav-link">Criar Evento</a>
            </li>
            @auth
                <li class="nav-item accordion-box">
                    <div class="accordion" id="accordion-my-events">
                        <div class="accordion-item">
                            <div @if($current == 'my-events' or $current == 'update-event') class="active" @endif>
                                <button class="accordion-button nav-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="btn-my-events">
                                    Meus Eventos
                                </button>
                            </div>
                            <ul id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordion-my-events">
                                <li @if($option == 'belongs-to-me' or $current == 'update-event') class="nav-item active" @else class="nav-item" @endif> 
                                    <a href="{{ route('events.my-events') }}" class="nav-link">Pertencem a Mim</a>
                                </li>
                                <li @if($option == 'as-participant') class="nav-item active" @else class="nav-item" @endif>
                                    <a href="{{ route('events.as-participant') }}" class="nav-link">Como Participante</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-item" id="profile-photo-nav">
                    <div id="open-lateral-menu">
                        @if(auth()->user()->profile_photo_path)
                            <img class="profile-photo" src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Foto de Perfil">
                        @else
                            <img class="profile-photo" src="{{ asset('img/profile.png') }}">
                        @endif
                        <div id="lateral-menu-icon"><i class="fa-solid fa-bars"></i></div>
                    </div>
                    <ul id="lateral-menu"> 
                        <li class="nav-option profile-box">
                            <a href="{{ route('profile.show') }}" class="nav-link">
                                <div class="link-profile">
                                    @if(auth()->user()->profile_photo_path)
                                        <img class="profile-photo" src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Foto de Perfil">
                                    @else
                                        <img class="profile-photo" src="{{ asset('img/profile.png') }}">
                                    @endif
                                    <div class="user-email-box">
                                        <span>{{ auth()->user()->name }}</span>
                                        <p class="email">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-option">
                            <form action="/logout" method="POST" class="form-logout">
                                @csrf
                                <a href="/logout" onclick="event.preventDefault();
                                this.closest('form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    Sair
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="nav-item hidden-option">
                    <form action="/logout" method="POST" class="form-logout">
                        @csrf
                        <a href="/logout" onclick="event.preventDefault();
                        this.closest('form').submit();" class="nav-link">
                            Sair
                        </a>
                    </form>
                </li>
            @endauth
            @guest
                <li class="nav-item">
                    <a href="/login" class="nav-link">Entrar</a>
                </li>
                <li class="nav-item">
                    <a href="/register" class="nav-link">Cadastrar</a>
                </li>
            @endguest
        </ul>
    </div>
</nav>