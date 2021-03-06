<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recordatorio de evento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-lg-2" style="background: #2063AA;"></div>
            <div class="  col-md-8 col-lg-8">
                <a href="{{ url('/') }}"><img src="{{asset('img/logo-top.jpg')}}" class='img-responsive' alt="logo"></a>
                <h1>Este es un recordatorio para el siguiente Evento</h1>
                <p>Te recuedo que tienes que tienes que acudir al siguiente evento: <strong>{{$titulo}}</strong> </p>
                <p>Asunto: <strong>{{$asunto}}</strong></p>
                <p>Horario <strong>{{$hora}}</strong></p>
                <p>Ubicacion: <strong>{{$ubicacion}}</strong></p>
                <p>Cliente: <strong>{{$cliente}}</strong></p>
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