<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        @section('libs')
        <script src="{{asset('js/lib/jquery-2.2.2.min.js')}}"></script>
        <script src="{{asset('js/lib/jqueryui/jquery-ui.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('/js/lib/jqueryui/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{asset('/js/lib/jqueryui/jquery-ui.structure.min.css')}}">
        <link rel="stylesheet" href="{{asset('/js/lib/jqueryui/jquery-ui.theme.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/lib/bootstrap/css/bootstrap.min.css')}}">
        <script src="{{asset('css/lib/bootstrap/js/bootstrap.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('css/menulateral.css')}}">
        <link rel="stylesheet" href="{{asset('css/theme.css')}}">
        <script src="{{asset('js/main.js')}}"></script>
        <script src="{{asset('js/buscador.js')}}"></script>
        @show
        @if (isset($titulo))
            <title>{{$titulo}}</title>
        @endif
    </head>
    <body>
        @if (isset($sitio))
            <div class="container-fluid">
                <div class="row">
                    @section('titlehead')
                    <div class="col-md-2 col-lg-2"></div>
                    <div class="  col-md-3 col-lg-3">
                            <h3 class="tituloseccion">{{$sitio}}</h3>
                    </div>
                    @show
                </div>                
                
            </div>
        @endif
        
        @yield('body')
    </body>
</html>