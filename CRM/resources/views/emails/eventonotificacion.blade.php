<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Evento a realizarse el dia de hoy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-lg-2" style="background: #2063AA;"></div>
            <div class="  col-md-8 col-lg-8">
                <a href="{{ url('/') }}"><img src="{{asset('img/logo-top.jpg')}}" class='img-responsive' alt="logo"></a>
                <h1>Tienes un evento que se realizara el dia de hoy</h1>
                <p>El evento con titulo <strong>{{$titulo}}</strong> se realizara el dia de hoy</p>
                <p>Asunto: <strong>{{$asunto}}</strong></p>
                <p>Cliente: <strong>{{$cliente}}</strong></p>
                <p>Horario: <strong>{{$hora}}</strong></p>
                <p>Ubicacion: <strong>{{$ubicacion}}</strong></p>
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