@extends ('vistaInformes')

@section('botonera')
<form  class="form-inline" name="filtros">
    <div class="form-group">
        <label for="inicio">Rango:</label>
        <label for="inicio">Inicio</label>
        <input type="text" class="form-control" placeholder="Formato 2016-06-24" name="inicio">    
    </div> 
    <div class="form-group">
        <label for="fin">Fin</label>
        <input type="text" class="form-control" placeholder="Formato 2016-06-24" name="fin">    
    </div> 
    <div class="form-group">
        <button type="button" name="aplicar" class="btn btn-default btn-form">Aplicar</button>
    </div>     
</form>

@stop

@section('informe')
    <div class="table-responsive">
        <table class="table table-hover table-striped" name="resumen">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th># de Oportunidades</th>                    
                    <th>Ingresos</th>
                </tr>
            </thead>
            <tbody>
                    {{-- td 2016-06-01 -- 2016-06-07 --}}
                    {{-- td prospecto 3 clientes 4 --}}
            </tbody>
        </table>
    </div>


@stop