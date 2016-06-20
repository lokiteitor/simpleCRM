@extends('layouts.base')

@section('libs')
    @parent
    <link rel="stylesheet" href='{{asset("js/lib/fullcalendar/fullcalendar.min.css")}}'>
    <script src='{{asset("js/lib/moment.min.js")}}'></script>
    <script src='{{asset("js/lib/fullcalendar/fullcalendar.min.js")}}'></script>
    <script src='{{asset("js/eventos.js")}}'></script>
@stop

@section('body')
@include('layouts.menu')
@section("titlehead")
    @parent
    <div class=" col-md-4 col-lg-4"></div>
    <div class=" col-md-2 col-lg-2">
        <a href='{{url("/crear/evento")}}'>
            <button class="btn btn-default botonseccion"><span class="glyphicon glyphicon-plus">Agregar evento</span></button>
        </a>        
    </div>
    <div class=" col-md-1 col-lg-1"></div>
@stop

<div class="row">
    <div class="  col-md-2 col-lg-2"></div>
    <div class="  col-md-10 col-lg-10">
        <div id="calendario"></div>
    </div>
</div>
@stop