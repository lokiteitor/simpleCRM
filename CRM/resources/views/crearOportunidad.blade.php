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
<div class="container-fluid">
    <form action='{{url("/crear/oportunidad")}}' method="post" class="form-horizontal" name="oportunidad">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-4 col-lg-4">

                <div class="form-group">
                    <label for="nombre">Titulo de la oportunidad</label>
                    {{  $errors->first('titulo') }}
                    <input type="text" class="form-control" placeholder="Titulo de la oportunidad" name="titulo" required>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control buscador" list="cliente" name='cliente' placeholder="Cliente al que pertenece la oportunidad" data-busqueda="cliente">
                        <span class="input-group-btn"><button class="btn btn-default" name="buscar-cliente" type="button"><span class="glyphicon glyphicon-search">Cliente</span></button></span>
                        <datalist id="cliente"></datalist>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control buscador" list="campaña" name='campaña' placeholder="Campaña de origen" data-busqueda="campaña">
                        <span class="input-group-btn"><button class="btn btn-default" name="buscar-campaña" type="button"><span class="glyphicon glyphicon-search">Campaña</span></button></span>
                        <datalist id="campaña"></datalist>
                    </div>

                </div>                
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    {{  $errors->first('tipo') }}
                    <select name="tipo" class="form-control" required>
                        <option value="Negocio Nuevo">Negocio nuevo</option>
                        <option value="Negocio Existente">Negocio existente</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inversion">Inversion</label>
                    {{  $errors->first('inversion') }}
                    <input type="text" class="form-control" placeholder="Formato: 100.00" name="inversion">

                </div>                  
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="presupuesto">
                        Presupuesto confirmado
                    </label>
                </div>

            </div>
            <div class="col-md-1 col-lg-1"></div>
            <div class="col-md-4 col-lg-4">           
                <div class="form-group">
                    <label for="etapa">Etapa</label>
                    {{  $errors->first('etapa') }}
                    <select name="etapa" class="form-control" required>
                        <option value="Calificacion">Calificacion</option>
                        <option value="Necesita Analisis">Necesita Analisis</option>
                        <option value="Propuesta">Propuesta</option>
                        <option value="Negociando">Negociando</option>
                        <option value="Completada">Completada</option>
                        <option value="Perdida">Perdida</option>
                    </select>
                </div>                
                <div class="form-group">
                    <label for="probabilidad">Probabilidad</label>
                    {{  $errors->first('probabilidad') }}
                    <input type="text" class="form-control" placeholder="Probabilidad de exito (%) Formato: 080 " name="probabilidad">
                </div>
                <div class="form-group">
                    <label for="factura">Factura o Remision</label>
                    {{  $errors->first('factura') }}
                    <input type="text" class="form-control" placeholder="Factura o Remision a la que perteneze" name="factura">
                </div>                
                <div class="form-group">
                    <label for="importe">Importe</label>
                    {{  $errors->first('importe') }}
                    <input type="text" class="form-control" placeholder="Importe ($) Formato: 600.00" name="importe">
                </div>
                <div class="form-group">
                    <label for="cierre">Fecha de cierre</label>
                    {{  $errors->first('cierre') }}
                    <input type="text" class="form-control" placeholder="Formato: 2016-06-24 " required name="cierre" id="cierre">
                </div>                
            </div>
        </div>
        <div class="row">
            <hr class="featurette-divider section">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-4 col-lg-4">
                <h3>Informacion de Adicional</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-9 col-lg-9">
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
