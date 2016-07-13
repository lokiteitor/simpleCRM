<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tarea proxima a cierre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-lg-2" style="background: #2063AA;"></div>
            <div class="  col-md-8 col-lg-8">
                <a href="{{ url('/') }}"><img src="{{asset('img/logo-top.jpg')}}" class='img-responsive' alt="logo"></a>
                <h1>Tienes una tarea que vencera el dia de hoy</h1>
                <p>La tarea con titulo <strong>{{$titulo}}</strong> cerrara el dia de hoy</p>
                <p>Asunto: <strong>{{$asunto}}</strong></p>
                <p>Fecha de vencimiento: <strong>{{$vencimiento}}</strong></p>
                <p>Cliente: <strong>{{$cliente}}</strong></p>
                <p>Estado: <strong>{{$estado}}</strong></p>
                <p>Descripcion: </p>
                <p>{{$descripcion}}</p>

                <p>Para obtener mas informacion visite la siguiente direccion</p>
                <a href={{$url}}>Detalles</a>
            </div>
            <div class="col-md-2 col-lg-2"></div>
        </div>
    </div>
</body>
</html>