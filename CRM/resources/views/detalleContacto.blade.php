@extends('layouts.base')
@section('body')
@include('layouts.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-4 col-lg-4">
            <p class="lead" name="nombre">Nombre Apellido</p>
            <ul class="list-inline">
                <li><strong>Telefono: </strong> </li>
                <li name="telefono"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Celular: </strong> </li>
                <li name="celular"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Correo: </strong> </li>
                <li name="correo"></li>
            </ul>                        
            <ul class="list-inline">
                <li><strong>Empresa: </strong> </li>
                <li name="empresa"></li>
            </ul>            
        </div>
        <div class="col-md-1 col-lg-1"></div>
        <div class="col-md-4 col-lg-4">
            <br>
            <br>
            <ul class="list-inline">
                <li><strong>Calle: </strong> </li>
                <li name="calle"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Colonia: </strong> </li>
                <li name="colonia"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Localidad: </strong> </li>
                <li name="localidad"></li>
            </ul>                                    
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-4 col-lg-4">
            <p class="lead">Caracteristicas del contacto</p>
            <ul class="list-inline">
                <li><strong>Origen del contacto: </strong> </li>
                <li name="origen"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Calificacion del contacto: </strong> </li>
                <li name="calificacion"></li>
            </ul>
            <h4>Notas:</h4>                        
        </div>
        <div class="col-md-6 col-lg-6"></div>
    </div>
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-8 col-lg-8">
            <textarea name="notas" rows="5" class="form-control"></textarea>
        </div>
        <div class="col-md-2 col-lg-2"></div>
    </div>
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-2 col-lg-2">
            <p class="lead">Tareas</p>
        </div>
        <div class="col-md-8 col-lg-8"></div>
    </div>    
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>Asunto</th>
                        <th>Fecha de vencimiento</th>
                        <th>Estado</th>
                        <th>Prioridad</th>
                        <th>Notas</th>                    
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>    
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-2 col-lg-2">
            <p class="lead">Evento</p>
        </div>
        <div class="col-md-8 col-lg-8"></div>
    </div>    
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Ubicacion</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>    
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Ubicacion</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>    
        </div>
    </div>           
</div>
@stop