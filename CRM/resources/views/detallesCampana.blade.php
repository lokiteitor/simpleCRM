@extends('layouts.base')

@section('libs')
    @parent
    <script src='{{asset("/js/cookiemanager.js")}}'></script>
    <script src='{{asset("/js/detalles.js")}}'></script>    
@stop

@section('body')
@include('layouts.menu')
@section("titlehead")
@parent
<div class=" col-md-2 col-lg-2"></div>
<div class=" col-md-2 col-lg-2">
    <button type="button" name="next" class="btn btn-default botonseccion btn-form"><span class="glyphicon glyphicon-chevron-right"></span></button>
    <button type="button" name="prev" class="btn btn-default botonseccion btn-form"><span class="glyphicon glyphicon-chevron-left"></span></button>
</div>
@stop

<div class="container-fluid">
    <div class="row campana" >
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-4 col-lg-4">
            <p class="lead" name="nombre"></p>
            <ul class="list-inline">
                <li><strong>Tipo: </strong></li>
                <li name="tipo"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Activo: </strong> </li>
                <li name="activo"></li>
            </ul>                          
             
        </div>
        <div class="col-md-1 col-lg-1"></div>
        <div class="col-md-4 col-lg-4">
            <br>            
            <ul class="list-inline">
                <li><strong>Fecha de inicio: </strong> </li>
                <li name="inicio"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Fecha de finalizacion: </strong> </li>
                <li name="finalizacion"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Estado: </strong> </li>
                <li name="estado"></li>
            </ul>                                                          
        </div>
    </div>
    <br>
    <div class="row campana" >
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-4 col-lg-4">
            <p class="lead">Planificacion</p>
            <ul class="list-inline">
                <li><strong>Ingresos esperados: </strong> </li>
                <li name="ingresos"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Coste real: </strong> </li>
                <li name="coste"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Coste Presupuestado: </strong> </li>
                <li name="presupuestado"></li>
            </ul> 
            <ul class="list-inline">
                <li><strong>Coste Real: </strong> </li>
                <li name="real"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Respuesta esperada: </strong> </li>
                <li name="respuesta"></li>
            </ul>                                                        
            <h4>Descripcion:</h4>                        
        </div>
        <div class="col-md-6 col-lg-6"></div>
    </div>
    <div class="row campana">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-8 col-lg-8">
            <textarea name="descripcion" rows="5" class="form-control"></textarea>
        </div>
        <div class="col-md-2 col-lg-2"></div>
    </div>

    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-2 col-lg-2">
            <p class="lead">Oportunidades</p>
        </div>
        <div class="col-md-8 col-lg-8"></div>
    </div>    
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10 table-responsive">
            <table class="table table-stripped" name="oportunidades">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Titulo</th>
                        <th>Etapa</th>
                        <th>Tipo</th>
                        <th>Fecha de cierre</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>    
        </div>
    </div>            
</div>
@stop