<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">


    <!-- Styles  tadatable -->
    <!--<link rhref="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" el="stylesheet" >-->


    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontello.css') }}">

    <!-- Iconos para tempusdominus -->
    <!-- Tempusdominus DateTime Picker-->
    <link rel="stylesheet" href="{{ asset('css/tempusdominus-bootstrap-4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap3.css') }}">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-danger shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Laravel
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownReportes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-docs"></i>Contenido
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownReportes">
                                    <a class="dropdown-item" href="{{ route('servicio.index') }}">Servicio</a>
                                    <a class="dropdown-item" href="{{ route('targeta_operaciones.index') }}">Targeta de Operaciones</a>
                                    <a class="dropdown-item" href="{{ route('bus.index') }}">Buses</a>
                                </div>
                            </li>
                           
                            <li class="nav-item dropdown">                               
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdministracion" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-sliders"></i>Configuración
                                </a>                            
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownAdministracion">
                                    <a class="dropdown-item" href="{{ route('institutional.index') }}">Institucional</a>
                                    <a class="dropdown-item" href="{{ route('zonas.index') }}">Zonas</a>
                                </div>
                            </li>
                           
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <!--<a class="dropdown-item" href="!#">Cambiar contraseña</a>-->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="p-2">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/assets/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/assets/popper.min.js') }}"></script>
    <script src="{{ asset('js/assets/bootstrap.min.js') }}"></script>
    <!--Alert-->
    <script src="{{ asset('js/assets/toastr.js') }}"></script>
    <!--Date Tables-->
    <script src="{{ asset('js/assets/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/assets/dataTables.bootstrap4.min.js') }}"></script>
    <!--Export Print DateTables-->
    <script src="{{ asset('js/assets/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/assets/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/assets/jszip.min.js') }}"></script>
    <script src="{{ asset('js/assets/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/assets/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/assets/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/assets/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/assets/buttons.colVis.min.js') }}"></script>
    <!--Tempusdominus DateTime Picker-->
    <script src="{{ asset('js/assets/moment.js') }}"></script>
    <script src="{{ asset('js/assets/es.js') }}"></script>
    <script src="{{ asset('js/assets/tempusdominus-bootstrap-4.js') }}"></script>

    @yield('scripts')
</body>
</html>
