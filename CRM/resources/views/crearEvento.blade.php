@extends('layouts.base')

@section('libs')
@parent
    <script src='{{asset("/js/lib/datetimepicker/jquery.datetimepicker.full.min.js")}}'></script>
    <link rel="stylesheet" href='{{asset("/js/lib/datetimepicker/jquery.datetimepicker.min.css")}}'>
@stop

@section('body')
@include('layouts.menu')
<div class="container-fluid">
    <form action='{{url("/crear/evento")}}' method="post" class="form-horizontal" name="evento">
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-8 col-lg-8">

                <div class="form-group">
                    <label for="nombre">Titulo del evento</label>
                    <input type="text" class="form-control" placeholder="Titulo del evento" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="titulo">Asunto</label>
                    <input type="text" class="form-control" placeholder="Asunto" name="titulo" required>
                </div>
                <div class="form-group">
                    <label for="ubicacion">Ubicacion</label>
                    <input type="text" class="form-control" placeholder="Asunto" name="ubicacion" required>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="allday">
                        Todo el dia
                    </label>
                </div>
                <div class="form-inline">
                    <label for="defecha">De:</label>
                    <br>                                
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="2016/06/24 12:30 PM" required name="defecha" id="defecha">
                    </div>                                   
                </div>            
                <div class="form-inline">
                    <label for="afecha">A:</label>
                    <br>                                
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="2016/06/24 12:30 PM" required name="afecha" id="afecha">
                    </div>                           
                </div>
                <hr class="featurette-divider section">
                <h4>Participantes</h4>
                <ul id="participantes" class="list-unstyled">
                    <li><a href="#" name="add">Añadir</a></li>
                </ul>
                <div class="form-group">
                    <label for="relacionado">Relacionado con:</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="relacionado" value="radiocliente" checked>
                            Posible Cliente
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="relacionado" value="radiocontacto">
                            Contacto
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="relacionado" value="radiotro">
                            Otro
                        </label>
                    </div>                    
                </div>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-search"></span>
                    <input type="text" class="form-control" placeholder="Buscar..." list="busqueda">
                    <datalist id="busqueda"></datalist>
                </div>
                <hr class="featurette-divider section">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="repetir">
                        Repetir Evento
                    </label>
                </div>  
                <div class="form-group">
                    <label for="inicio">Fecha de inicio</label>
                    <input type="text" class="form-control" placeholder="2016/06/24 " required name="inicio" id="inicio">
                </div>  
                <div class="form-group">
                    <label for="finalizacion">Fecha de finalizacion</label>
                    <input type="text" class="form-control" placeholder="2016/06/24 " required name="finalizacion" id="finalizacion">
                </div>  
                <div class="form-group">
                    <label for="repetira">Repetir cada </label>
                    <select name="repetira" class="form-control">
                        <option value="diaria">Diariamente</option>
                        <option value="semanal">Semanalmente</option>
                        <option value="mensual">Mensualmente</option>
                        <option value="anual">Anualmente</option>
                    </select>
                </div>

            </div>
            <div class="col-md-2 col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-4 col-lg-4">
                <h3>Descripcion</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-9 col-lg-9">
                <textarea name="descripcion" rows="5" class="form-control"></textarea>
            </div>
            <div class="col-md-2 col-lg-1"></div>
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
