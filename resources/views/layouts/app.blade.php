<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- FontAwesome Icons -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>

<body>
    <div id="app">
        <nav class="navbar shadow-md">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasmenu"
                    aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <main class="py-4">
            @include('sweetalert::alert')
            @yield('content')
        </main>
    </div>

    <!-- offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasmenu" aria-labelledby="offcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvas">SISEAD</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled">
                <li>
                    <button class="btn btn-primary w-100 mb-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseStudents" aria-expanded="false" aria-controls="collapseStudents">
                        Estudiantes
                    </button>
                    <div class="collapse mb-3" id="collapseStudents">
                        <div class="card card-body">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="btn-group w-100">
                                        <a href="{{url('estudiante/')}}" class="btn btn-primary" type="button">Datos de
                                            Estudiantes</a>
                                        <a href="{{url('estudiante/create')}}" class="btn btn-primary"
                                            type="button">+</a>

                                    </div>
                                </li>
                                <li><a href="{{url('inscripcion/')}}" class="btn btn-primary w-100"
                                        type="button">Inscripción de Materias</a></li>
                                <li><button class="btn btn-secondary w-100">Horarios</button></li>
                                <li><a href="{{url('notas/')}}" class="btn btn-primary w-100" type="button">Notas</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li>
                <li>
                    <button class="btn btn-primary w-100 mb-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseProffesors" aria-expanded="false" aria-controls="collapseStudents">
                        Profesores
                    </button>
                    <div class="collapse mb-3" id="collapseProffesors">
                        <div class="card card-body">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="btn-group w-100" role="group" aria-label="Basic example">
                                        <a href="{{url('profesor/')}}" class="btn btn-primary" type="button">Datos de
                                            Profesores</a>
                                        <a href="{{url('profesor/create')}}" class="btn btn-primary" type="button">+</a>
                                    </div>
                                </li>
                                <li><a href="{{url('profesor/edit/subject')}}" class="btn btn-primary w-100"
                                        type="button">Asignación de Materias</a></li>
                                <li><button class="btn btn-secondary w-100">Horarios</button></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li><a class="btn btn-primary w-100 mb-2" href="{{url('params')}}">Parámetros del sistema</a></li>
            </ul>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="lightSwitch">
                <label class="form-check-label" for="lightSwitch">lightSwitch</label>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">TOGGLER</button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto list-unstyled">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
    <!-- offcanvas end -->
    @stack('script-seccion-materia')
</body>
</html>