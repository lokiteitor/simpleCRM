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
    <div class="row cuenta" >
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-4 col-lg-4">
            <p class="lead" name="nombre"></p>
            <ul class="list-inline">
                <li><strong>Telefono: </strong></li>
                <li name="telefono"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Sitio Web: </strong> </li>
                <li name="web"></li>
            </ul>                          
             
        </div>
        <div class="col-md-1 col-lg-1"></div>
        <div class="col-md-4 col-lg-4">
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
                <li><strong>Codigo Postal: </strong> </li>
                <li name="cpostal"></li>
            </ul>            
            <ul class="list-inline">
                <li><strong>Ciudad: </strong> </li>
                <li name="ciudad"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Estado: </strong> </li>
                <li name="estado"></li>
            </ul>                                                
        </div>
    </div>
    <br>
    <div class="row cuenta" >
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-4 col-lg-4">
            <p class="lead">Caracteristicas de la cuenta</p>
            <ul class="list-inline">
                <li><strong>Tipo de la cuenta: </strong> </li>
                <li name="tipo"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Calificacion de la cuenta: </strong> </li>
                <li name="calificacion"></li>
            </ul>
            <ul class="list-inline">
                <li><strong>Sector: </strong> </li>
                <li name="sector"></li>
            </ul> 
            <ul class="list-inline">
                <li><strong>Numero de empleados: </strong> </li>
                <li name="empleados"></li>
            </ul>                          
            <h4>Notas:</h4>                        
        </div>
        <div class="col-md-6 col-lg-6"></div>
    </div>
    <div class="row cuenta">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-8 col-lg-8">
            <textarea name="notas" rows="5" class="form-control"></textarea>
        </div>
        <div class="col-md-2 col-lg-2"></div>
    </div>
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-2 col-lg-2">
            <p class="lead">Contactos</p>
        </div>
        <div class="col-md-8 col-lg-8"></div>
    </div>    
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="table-responsive col-md-10 col-lg-10">
            <table class="table table-stripped" name="contactos">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Nombre del contacto</th>
                        <th>Correo electronico</th>
                        <th>Telefono</th>
                        <th>Fecha de creacion</th>
                        <th>Departamento</th>                    
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
            <p class="lead">Oportunidades</p>
        </div>
        <div class="col-md-8 col-lg-8"></div>
    </div>    
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="table-responsive col-md-10 col-lg-10">
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
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-2 col-lg-2">
            <p class="lead">Tareas</p>
        </div>
        <div class="col-md-8 col-lg-8"></div>
    </div>    
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="table-responsive col-md-10 col-lg-10">
            <table class="table table-stripped" name="tareas">
                <thead>
                    <tr>
                        <th>Edicion</th>
                        <th>Asunto</th>
                        <th>Fecha de vencimiento</th>
                        <th>Estado</th>
                        <th>Prioridad</th>   
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>    
        </div>
    </div>               
</div>
@stop