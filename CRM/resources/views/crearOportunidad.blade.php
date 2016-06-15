@extends('layouts.base')

@section('libs')
@parent
    <script src='{{asset("/js/lib/datetimepicker/jquery.datetimepicker.full.min.js")}}'></script>
    <link rel="stylesheet" href='{{asset("/js/lib/datetimepicker/jquery.datetimepicker.min.css")}}'>
@stop

@section('body')
@include('layouts.menu')
<div class="container-fluid">
    <form action='{{url("/crear/oportunidad")}}' method="post" class="form-horizontal" name="oportunidad">
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-4 col-lg-4">

                <div class="form-group">
                    <label for="nombre">Titulo de la oportunidad</label>
                    <input type="text" class="form-control" placeholder="Titulo de la oportunidad" name="nombre" required>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" list="cuentas" placeholder="Cuenta">
                        <span class="input-group-btn"><button class="btn btn-default" name="buscar-cuentas" type="button"><span class="glyphicon glyphicon-search">Cuentas</span></button></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" list="campaña" placeholder="Campaña de origen">
                        <span class="input-group-btn"><button class="btn btn-default" name="buscar-campaña" type="button"><span class="glyphicon glyphicon-search">Campaña</span></button></span>
                    </div>
                </div>                
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" class="form-control" required>
                        <option value="nuevo">Negocio nuevo</option>
                        <option value="existente">Negocio existente</option>
                    </select>
                </div>                  
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="atiende-correo">
                        Presupuesto confirmado
                    </label>
                </div>
                <div class="form-group">
                    <label for="cierre">Fecha de cierre</label>
                    <input type="text" class="form-control" placeholder="2016/06/24 " required name="cierre" id="cierre">
                </div>
            </div>
            <div class="col-md-1 col-lg-1"></div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="origen">Origen del cliente</label>
                    <select name="origen" class="form-control" required>
                        <option value="Anuncio">Anuncio</option>
                        <option value="Folleto">Folleto</option>
                        <option value="Referencia de empleado">Referencia de empleado</option>
                        <option value="Referencia de otro cliente">Referencia de otro cliente</option>
                        <option value="Sitio web">Sitio web</option>
                        <option value="Anuncio via email">Anuncio via email</option>
                        <option value="Busqueda web">Busqueda web</option>
                    </select>
                </div>                
                <div class="form-group">
                    <label for="etapa">Etapa</label>
                    <select name="etapa" class="form-control" required>
                        <option value="calificacion">Calificacion</option>
                        <option value="analisis">Necesita Analisis</option>
                        <option value="propuesta">Propuesta</option>
                        <option value="negociando">Negociando</option>
                        <option value="completado">Completado</option>
                        <option value="perdido">Perdido</option>
                    </select>
                </div>                
                <div class="form-group">
                    <label for="probabilidad">Probabilidad</label>
                    <input type="text" class="form-control" placeholder="Probabilidad de exito (%)" name="probabilidad">
                </div>
                <div class="form-group">
                    <label for="importe">Importe</label>
                    <input type="text" class="form-control" placeholder="Importe ($)" name="importe">
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
                <button type="button" class="btn btn-default btn-form">Cancelar</button>
                <button type="submit" class="btn btn-success btn-form">Guardar</button>
            </div>
            <div class="col-md-1 col-lg-1"></div>
        </div>
    </form>
</div>
@stop
