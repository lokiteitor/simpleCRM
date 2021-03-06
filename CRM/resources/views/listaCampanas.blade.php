@extends('layouts.base')

@section('libs')
    @parent
    <script src='{{asset("/js/lista.js")}}'></script>
    <script src='{{asset("/js/listado.js")}}'></script>
@stop

@section('body')
@include('layouts.menu')
<div class="container-fluid">
    <div class="row">
        {{--Aqui va el buscador, realiza las consultas via ajax--}}
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control buscador" list="campañas" placeholder="Buscar Campaña" data-busqueda="campaña" name="campañas">
                    <span class="input-group-btn"><button class="btn btn-default" type="button" name="buscar">Buscar</button></span>
                </div>
            </div>
        </div>
        <div class="form-inline">
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="orden">Ordenar por:</label>
                    <select name="orden" class="form-control" required>
                        <option value="NOMBRE">Nombre</option>
                        <option value="TIPO">Tipo</option>
                        <option value="ESTADO">Estado</option>
                        <option value="INICIO">Fecha de Inicio</option>
                        <option value="FINALIZACION">Fecha de Finalizacion</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="verinactivas">
                        Ver Inactivas
                    </label>
                </div>                
            </div>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <div class="form-group">
                <button class="btn btn-default" name="ver"><span class="glyphicon glyphicon-open">Ver Campaña</span></button>
            </div>                
        </div>
    </div>
    <div class="row">
        {{-- Aqui va la tabla se llena conforme se recorren las peticiones--}}
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10">
            <div class="table-responsive">
                <table class="table table-striped table-hover" name="listado">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="check-all" value="all-select"></th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Tipo</th>
                            <th>Activo</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de Finalizacion</th>
                            <th>Creacion</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-8  col-md-9 col-lg-9"></div>
        <div class="col-xs-8 col-sm-4 col-md-3 col-lg-3">
            <ul class="pagination">
                <li><a href="#" name="prev">&laquo;</a></li>
                <li><a href="#" name="prev" class="numprev"></a></li>
                <li><a href="#" name="prev" class="numactual"></a></li>
                <li><a href="#" name="next" class="numnext"></a></li>
                <li><a href="#" name="next">&raquo;</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class=" col-md-4 col-lg-4"></div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <a href='{{url("/crear/campana")}}'><button class="btn btn-default"><span class="glyphicon glyphicon-plus">Agregar Campaña</span></button></a>
                <button name="editar" class="btn btn-default"><span class="glyphicon glyphicon-edit">Editar Campaña</span></button>
                <button  name="eliminar" class="btn btn-danger"><span class="glyphicon glyphicon-trash">Eliminar</span></button>
            </div>            
        </div>    
    </div>
</div>
@stop