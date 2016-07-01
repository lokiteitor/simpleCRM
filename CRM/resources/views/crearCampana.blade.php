@extends('layouts.base')

@section('libs')
@parent
    <script src='{{asset("/js/lib/datetimepicker/jquery.datetimepicker.full.min.js")}}'></script>
    <link rel="stylesheet" href='{{asset("/js/lib/datetimepicker/jquery.datetimepicker.min.css")}}'>
    @if ($edicion)
        <script src='{{asset("/js/cookiemanager.js")}}'></script>
        <script src='{{asset("/js/editar.js")}}'></script>
    @endif    
@stop


@section('body')
@include('layouts.menu')

@section("titlehead")
@parent
<div class=" col-md-2 col-lg-2"></div>
<div class=" col-md-2 col-lg-2">
    @if (isset($edicion) && $edicion == true)
        <button type="button" name="next" class="btn btn-default botonseccion btn-form"><span class="glyphicon glyphicon-chevron-right"></span></button>
        <button type="button" name="prev" class="btn btn-default botonseccion btn-form"><span class="glyphicon glyphicon-chevron-left"></span></button>
    @endif        
</div>
@stop

<div class="container-fluid">
    <form action='{{url("/crear/campana")}}' method="post" class="form-horizontal" name="campaña">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="nombre">Nombre de la campaña</label>
                    {{  $errors->first('nombre') }}
                    <input type="text" class="form-control" placeholder="Nombre de la Campaña" name="nombre" required>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="activo">
                        Activo
                    </label>
                </div>
                <div class="form-group">
                    {{  $errors->first('tipo') }}
                    <label for="tipo">Tipo</label>
                    <select name="tipo" class="form-control" required>
                        <option value="Email">Email</option>
                        <option value="Referencia">Programa de referencia</option>
                        <option value="Busqueda">Busqueda</option>
                        <option value="Social Media">Social Media</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="form-group">
                    {{  $errors->first('otro') }}
                    <input type="text" class="form-control" placeholder="Tipo personalizado" name="otro">
                </div>                
            </div>
            <div class="col-md-1 col-lg-1"></div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    {{  $errors->first('estado') }}
                    <select name="estado" class="form-control" name="estado" required>
                        <option value="En progreso">En progreso</option>
                        <option value="Completada">Completada</option>
                        <option value="Abortada">Abortada</option>
                        <option value="Planeando">Planeando</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inicio">Fecha de inicio</label>
                    {{  $errors->first('inicio') }}
                    <input type="text" class="form-control" placeholder="Formato: 2016-06-24 " required name="inicio" id="inicio">
                </div>  
                <div class="form-group">
                    <label for="finalizacion">Fecha de finalizacion</label>
                    {{  $errors->first('finalizacion') }}
                    <input type="text" class="form-control" placeholder="Formato: 2016-06-24 " required name="finalizacion" id="finalizacion">
                </div>                                  
            </div>
        </div>
        <div class="row">
            <hr class="featurette-divider section">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-4 col-lg-4">
                <h3>Planificacion</h3>
                <div class="form-group">
                    <label for="ingresos">Ingresos Esperados </label>
                    {{  $errors->first('ingresos') }}
                    <input type="text" class="form-control" placeholder="Formato: 1000.00" name="ingresos">
                </div>
                <div class="form-group">
                    <label for="real">Coste real</label>
                    {{  $errors->first('real') }}
                    <input type="text" class="form-control" placeholder="Formato: 1000.00" name="real">
                </div>
            </div>
            <div class="col-md-1 col-lg-1"></div>
            <div class="col-md-4 col-lg-4">
                <br>
                <br>
                <br>
                <div class="form-group">
                    <label for="coste">Coste Presepuestado</label>
                    {{  $errors->first('coste') }}
                    <input type="text" class="form-control" placeholder="$1000.00" name="coste">
                </div>
                <div class="form-group">
                    <label for="codigo postal">Respuesta esperada</label>
                    <input type="text" class="form-control" placeholder="Buena" name="respuesta">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-9 col-lg-9">
                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion" rows="5" class="form-control"></textarea>
            </div>
            <div class="col-md-1 col-lg-1"></div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6"></div>
            <div class="col-md-4 col-lg-4">
                <button type="button" name="cancel" class="btn btn-default btn-form">Cancelar</button>
                <button type="submit" class="btn btn-success btn-form">Guardar</button>
            </div>
            <div class="col-md-1 col-lg-1"></div>
        </div>
    </form>
</div>
@stop
