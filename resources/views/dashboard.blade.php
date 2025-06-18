<!DOCTYPE html>
<html lang="en8">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sistema gestor de pagos de matrículas" />
    <meta name="author" content="Miguel Angel Ayala Fabra" />
    <title>SGPM - @yield('title')</title>
    <link href="{{asset('template.css')}}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    @stack('css')
</head>

<body class="sb-nav-fixed">

    <x-navigation-header />

    <div id="layoutSidenav">
        <x-navigation-menu />

        <!--Contenido principal-->
        <div id="layoutSidenav_content">
            <main>
               @yield('content')                
            </main>
            
            <x-footer />
            
        </div>
    </div>
    @stack('js')
</body>

</html>