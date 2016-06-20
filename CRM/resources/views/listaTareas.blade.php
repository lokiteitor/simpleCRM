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
    <div class=" col-md-2 col-lg-2"></div>
    <div class=" col-md-2 col-lg-2">
        <a href='{{url("/crear/tarea")}}'>
            <button class="btn btn-default botonseccion"><span class="glyphicon glyphicon-plus">Agregar Tarea</span></button>
        </a>        
    </div>    
    <div class=" col-md-3 col-lg-3">
        <div class="form-group tituloseccion">
            <label for="orden">Ordenar por:</label>
            <select name="orden" class="form-control" required>
                <option value="titulo">Titulo</option>
                <option value="fecha">Fecha de vencimiento</option>
                <option value="cuenta">Cuenta</option>
                <option value="persona">Contacto/Posible Cliente</option>
                <option value="prioridad">Prioridad</option>
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