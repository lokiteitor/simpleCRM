<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Oportunidad proxima a cierre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-lg-2" style="background: #2063AA;"></div>
            <div class="  col-md-8 col-lg-8">
                <a href="{{ url('/') }}"><img src="{{asset('img/logo-top.jpg')}}" class='img-responsive' alt="logo"></a>
                <h1>Oportunidad proxima a cerrar</h1>
                <p>La oportunidad con titulo <strong>{{$titulo}}</strong> cerrara en los proximos dias</p>
                <p>Fecha de cierre: <strong>{{$cierre}}</strong></p>
                <p>Cliente: <strong>{{$cliente}}</strong></p>
                <p>Etapa: <strong>{{$etapa}}</strong></p>

                <p>Para obtener mas informacion visite la siguiente direccion</p>
                <a href={{$url}}>Detalles</a>
            </div>
            <div class="col-md-2 col-lg-2"></div>
        </div>
    </div>
</body>
</html>