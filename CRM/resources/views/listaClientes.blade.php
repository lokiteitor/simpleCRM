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
        <div class="col-md-4 col-lg-4">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" list="clientes" placeholder="Buscar">
                    <span class="input-group-btn"><button class="btn btn-default" type="button">Buscar</button></span>
                </div>
            </div>
            <datalist id="clientes"></datalist>
        </div>
        <div class="form-inline">
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="orden">Ordenar por:</label>
                    <select name="orden" class="form-control" required>
                        <option value="nombre">Nombre</option>
                        <option value="apellido">Apellido</option>
                        <option value="fecha">Fecha de creacion</option>
                        <option value="empresa">Empresa</option>
                        <option value="estado">Estado del cliente</option>
                        <option value="calificacion">Calificacion del cliente</option>
                        <option value="origen">Origen del cliente</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-group">
                <a href='{{url("/detalles/cliente")}}'><button class="btn btn-default"><span class="glyphicon glyphicon-open">Ver Cliente</span></button></a>
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
                            <th>Nombre del cliente</th>
                            <th>Correo electronico</th>
                            <th>Telefono</th>
                            <th>Fecha de creacion</th>
                            <th>Empresa</th>
                            <th>Estado del cliente</th>
                            <th>Calificacion</th>
                            <th>Origen</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 col-lg-9"></div>
        <div class="col-md-3 col-lg-3">
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
        <div class="col-md-4 col-lg-4"></div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <a href='{{url("/crear/cliente")}}'><button class="btn btn-default"><span class="glyphicon glyphicon-plus">Agregar Cliente</span></button></a>
                <button name="editar" class="btn btn-default"><span class="glyphicon glyphicon-edit">Editar Cliente</span></button>
                <button  name="eliminar" class="btn btn-danger"><span class="glyphicon glyphicon-trash">Eliminar</span></button>
            </div>            
        </div>    
    </div>
</div>
@stop