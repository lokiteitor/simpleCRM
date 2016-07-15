@extends('layouts.base')
@section('libs')
    @parent
    <script src='{{asset("/js/cards.js")}}'></script>
    <link rel="stylesheet" href='{{asset("/css/cartas.css")}}'>
@stop
@section('body')
@include('layouts.menu')
<div class="container-fluid">
    @section("titlehead")
    @parent
    <div class=" col-md-2 col-lg-2">
    </div>
    <div class=" col-md-2 col-lg-2">
        <a href='{{url("/crear/oportunidad")}}'>
            <button class="btn btn-default botonseccion"><span class="glyphicon glyphicon-plus">Agregar Oportunidad</span></button>
        </a>                
    </div>
    <div class=" col-md-3 col-lg-3">
        <div class="form-group tituloseccion">
            <label for="orden">Ordenar por:</label>
            <select name="orden" class="form-control" required>
                <option value="TITULO">Nombre</option>
                <option value="TIPO">Tipo</option>
                <option value="ETAPA">Etapa</option>
                <option value="PROBABILIDAD">Probabilidad</option>
                <option value="created_at">Fecha de creacion</option>
                <option value="CIERRE">Fecha de cierre</option>
                <option value="Factura">Factura/Remision</option>
            </select>
        </div>            
    </div>
    @stop
    <div class=" col-md-2 col-lg-2"></div>
    {{--Aqui van las cartas de oportunidadades--}}
    <div name="col1" class="col-md-3 col-lg-3"></div>
    <div name="col2" class="col-md-3 col-lg-3"></div>
    <div name="col3" class="col-md-3 col-lg-3"></div>
    <div class="col-md-1 col-lg-1"></div>
</div>
@stop