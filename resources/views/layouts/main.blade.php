<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>@yield('title')</title>
</head>

<body>
    <header class="cabecalho navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="cabecalho-logo" href="/">Home</a>
            <div class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <i class="cabecalho-botao-icone bi bi-list"></i>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarTogglerDemo02"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="cabecalho-logo offcanvas-title link-opacity-50-hover" id="navbarTogglerDemo02">Home</h5>
                    <i data-bs-dismiss="offcanvas" aria-label="Close" class="botao-fechar-navbar bi bi-x-lg"></i>
                </div>
                <div class="offcanvas-body">
                    <nav class="cabecalho-nav navbar-nav justify-content-end flex-grow-1 pe-3">
                        @auth
                            <a class="nav-link" href="/"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</a>
                        @endauth
                        <a class="nav-link" href="/" aria-current="page">Eventos</a>
                        @guest
                            <a class="nav-link" href="/login" aria-current="page">Entrar</a>
                            <a class="nav-link" href="/register" aria-current="page">Cadastrar</a>
                        @endguest
                        @auth
                            <a class="nav-link" href="/eventos/criar" aria-current="page">Criar Evento</a>
                            <a class="nav-link" href="/dashboard" aria-current="page">Meus eventos</a>
                            <form action="/logout" method="POST">
                                @csrf
                                <a class="nav-link" href="/logout" aria-current="page"
                                    onclick="event.preventDefault();this.closest('form').submit();">Sair</a>
                            </form>
                        @endauth
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="position-relative">
            @if (session('msg'))
                <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 z-3 w-75"
                    role="alert">
                    {{ session('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="content">
                @yield('content')
            </div>
        </div>
    </main>

    <footer class="footer">
        <p class="text-white">Copyright © 2024 por Gustavo Nery | Todos os direitos reservados.</p>
    </footer>

    <script src="/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
