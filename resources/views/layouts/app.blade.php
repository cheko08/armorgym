<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Armor Gym - @yield('title')</title>

    <link rel="icon" type="image/png" sizes="96x96" href="{{ url('assets/images/favicon-96x96.png') }}">
 
      <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ elixir('css/all.css') }}">

</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                  ARMOR  GYM
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                   
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Iniciar Sesión</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                               <i class="fa fa-btn fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Menu</li>
                                <li><a href="{{ url('/home') }}"><i class="fa fa-btn fa-desktop"></i>Panel de administración</a></li>
                                 <li><a href="{{ url('/miembros/acceso') }}"><i class="fa fa-btn fa-sign-in"></i>Acceso de Miembros</a></li>
                                 <li><a href="{{ url('/miembros/create') }}"><i class="fa fa-btn fa-user-plus"></i>Registrar Miembro</a></li>
                                 <li role="separator" class="divider"></li>
                                  <li class="dropdown-header">Configuración</li>
                                   <li><a href="{{ url('membresias') }}"><i class="fa fa-btn fa-credit-card"></i>Membresías</a></li>
                                 <li><a href="{{ url('sucursales') }}"><i class="fa fa-btn fa-building"></i>Sucursales</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="{{ elixir('js/all.js') }}"></script>
     @yield('scripts')
</body>
</html>
