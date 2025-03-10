<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Fonte do Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">


    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Shortcut icon -->
    <link rel="shortcut icon" href="{{ asset('img/rbevents-icon.png') }}" style="width: 300%">

    <!-- CSS da aplicação -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <!-- CSS das páginas -->
    @yield('styles')
    <!-- CSS para responsividade -->
    <link rel="stylesheet" href="{{ asset('css/responsivity.css') }}">

</head>
<body>
    <header>
        @component('mycomponents.navbar', ['current' => $current])
        @endcomponent
    </header>

    <main>
        <div class="container-fluid">
            <div class="row">
                @if(session('msg'))
                    <p class="msg">{{ session('msg') }}</p>
                @elseif(session('msg_fail'))
                    <p class="msg msg-fail">{{ session('msg_fail') }}</p>
                @endif
                @yield('content')
            </div>
        </div>
    </main>

    <footer>
        <p>RB Events &copy; 2024</p>
    </footer>

    <!-- Ion icon -->
    <script  type = "module"  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" > </script> 
    <script  nomodule  src = "https://unpkg .com/ionicons@7.1.0/dist/ionicons/ionicons.js" > </script>

    <!-- Font awesome -->
    <script src="{{ asset('js/fontawesome.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- JS da aplicação -->
    <script src="{{ asset('js/script.js') }}"></script>

    @yield('scripts')
    
</body>
</html>