<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/materialize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontello.css') }}">
    <meta name="theme-color" content="#7CC143" />
</head>

<body class="grey lighten-3">
    <header>
        <nav class="nav-extended">
            <div class="nav-wrapper">
                <a class="brand-logo center-align">@yield('title')</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="icon-menu"></i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a><i class="icon-menu"></i></a></li>
                </ul>
            </div>
            <div class="nav-content">

            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li>
                <div class="user-view">
                    <div class="background white">
                        <!--<img src="/images/Presenters/3.png">-->
                    </div>
                    <a><img class="circle" src="/images/logo.png"></a>
                    <a><span class="green-text name">Herbalife</span></a>
                    <a><span class="green-text email">Tarija</span></a>
                </div>
            </li>
            <li><a href="{{ route('screem_institucional') }}"><i class="green-text icon-info-circled"></i>Información</a></li>
            <li><div class="divider"></div></li>
            <li><a href="{{ route('screem_productos') }}"><i class="green-text icon-basket"></i>Productos</a></li>
        </ul>
    </header>
    <main>
        <br>
        <div class="container">
            <main class="p-2">
                @yield('content')
            </main>
        </div>
    </main>


    <script src="{{ asset('js/assets/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/assets/materialize.js') }}"></script>
    <script src="{{ asset('js/assets/init.js') }}"></script>

    @yield('scripts')
</body>
</html>     