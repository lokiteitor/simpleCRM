@extends('layouts.base')

@section('libs')
    @parent
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>
    <script type="text/javascript" src='{{asset("js/informe.js")}}'></script>
    <script src='{{asset("/js/lib/datetimepicker/jquery.datetimepicker.full.min.js")}}'></script>
    <link rel="stylesheet" href='{{asset("/js/lib/datetimepicker/jquery.datetimepicker.min.css")}}'>


@stop

@section('body')
@include('layouts.menu')
    
<div class="container-fluid">

    @if ($botonera)
    <div class="row">
        <div class="  col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10">
            {{-- Botonera --}}
            @yield ('botonera')    
        </div>    
    </div>
    @endif

    @if ($grafico)    
    <div class="row">
        <div class="  col-md-2 col-lg-2"></div>
        <div class="  col-md-7 col-lg-7">
            {{-- Grafico si existe --}}            
            @yield('grafico')                        
        </div>
        <div class="col-md-3 col-lg-3">
            @yield('graficosControl')
        </div>    
    </div>        
    @endif

    <div class="row">
        <div class="  col-md-2 col-lg-2"></div>
        {{-- Informe tabular --}}
        @yield ('informe')
    </div>
</div>    
@stop