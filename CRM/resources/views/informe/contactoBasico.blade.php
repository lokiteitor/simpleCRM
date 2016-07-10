@extends('vistaInformes')

@section('botonera')
<form  action={{$action}} class="form-inline" name="filtros" method="get">
    <div class="form-group">
        <label for="inicio">Rango:</label>
        <label for="inicio">Inicio</label>
        <input type="text" class="form-control" placeholder="Formato 2016-06-24" name="inicio">    
    </div> 
    <div class="form-group">
        <label for="fin">Fin</label>
        <input type="text" class="form-control" placeholder="Formato 2016-06-24" name="fin">    
    </div> 
    @if($cantidad)
        <div class="form-group">
            <label for="lapso">Lapso a evaluar</label>
            <input type="text" class="form-control" placeholder="Cantidad" name="cantidad">    
        </div>
    @endif

    <div class="form-group">
        <button type="submit" name="aplicar" class="btn btn-default btn-form">Aplicar</button>
    </div> 
</form>

@stop

@section('informe')
    <div class="table-responsive">
        <table class="table table-hover table-striped" name="resumen">
            <thead>
                <tr>
                    @foreach ($tab as $head)
                        <th>{{$head}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($informe as $fila)
                    <tr>
                        @foreach($fila as $columna)
                            <td>{{$columna}}</td>
                        @endforeach
                    </tr>                                           
                @endforeach               
            </tbody>
        </table>
    </div>
@stop