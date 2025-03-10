<nav class="navbar navbar-expand-lg navbar-light">
    <div class="collapse navbar-collapse" id="navbar">
        <a href="{{ route('home') }}" class=" navbar-brand">
            <img src="{{ asset('img/rbevents-logo.png') }}" alt="Logo" id="logo">
        </a>
        <div id="menu-button">
            <ion-icon name="menu-outline"></ion-icon>
        </div>
        <ul id="menu" class="navbar nav">
            <li @if($current == 'home' or $current == 'show-event') class="nav-item active" @else class="nav-item" @endif>
                <a href="{{ route('home') }}" class="nav-link">Eventos</a>
            </li>
            <li @if($current == 'create-event') class="nav-item active" @else class="nav-item" @endif>
                <a href="{{ route('events.create') }}" class="nav-link">Criar Evento</a>
            </li>
            @auth
                <li @if($current == 'dashboard' or $current == 'update-event') class="nav-item active" @else class="nav-item" @endif>
                    <a href="{{ route('events.dashboard') }}" class="nav-link">Meus Eventos</a>
                </li>
                <li class="nav-item">
                    <form action="/logout" method="POST" id="form-logout">
                        @csrf
                        <a href="/logout" class="nav-link" onclick="event.preventDefault();
                        this.closest('form').submit();">Sair</a>
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