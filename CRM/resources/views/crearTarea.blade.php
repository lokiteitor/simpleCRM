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
    <form action='{{url("/crear/tarea")}}' method="post" class="form-horizontal" name="tarea">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-8 col-lg-8">
                <div class="form-group">
                    <label for="nombre">Titulo de la tarea</label>
                    {{  $errors->first('nombre') }}
                    <input type="text" class="form-control" placeholder="Titulo de la tarea" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="asunto">Asunto</label>
                    {{  $errors->first('asunto') }}
                    <input type="text" class="form-control" placeholder="Asunto" name="asunto" required>
                </div>
                <div class="form-group">
                    <label for="vencimiento">Fecha de vencimiento</label>
                    {{  $errors->first('vencimiento') }}
                    <input type="text" class="form-control" placeholder="Formato: 2016-06-24 " required name="vencimiento" id="vencimiento">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control buscador" list="cliente" placeholder="Contacto o posible cliente" name="cliente"
                        data-busqueda="cliente">
                        <span class="input-group-btn"><button class="btn btn-default" name="buscar-contacto" type="button"><span class="glyphicon glyphicon-search">Contacto/posible cliente</span></button></span>

                        <datalist id="cliente"></datalist>
                    </div>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    {{  $errors->first('estado') }}
                    <select name="estado" class="form-control" required>
                        <option value="Sin Empezar">Sin empezar</option>
                        <option value="Diferido">Diferido</option>
                        <option value="En Progreso">En progreso</option>
                        <option value="Completada">Completada</option>
                        <option value="Esperando">Esperando</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="prioridad">Prioridad</label>
                    {{  $errors->first('prioridad') }}
                    <select name="prioridad" class="form-control" required>
                        <option value="Muy Alta">Muy Alta</option>
                        <option value="Alta">Alta</option>
                        <option value="Normal">Normal</option>
                        <option value="Baja">Baja</option>
                        <option value="Muy Baja">Muy Baja</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="notificarcorreo">
                        Notificacion por correo
                    </label>
                </div>
                <hr class="featurette-divider section">
                
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="recordatorio">
                        Recordatorio
                    </label>
                </div>
                <div name="divrecordatorio">
                    <div class="form-inline">
                        <div class="form-group">
                            <label for="recordar">Recorda a </label>
                            {{  $errors->first('recordar') }}
                            {{  $errors->first('horaRecord') }}
                            <select name="recordar" class="form-control">
                                <option value="1">1 dia</option>
                                <option value="2">2 dias</option>
                                <option value="3">3 dias</option>
                                <option value="4">4 dias</option>
                                <option value="5">5 dias</option>
                                <option value="6">6 dias</option>
                                <option value="7">1 semana</option>
                                <option value="14">2 semanas</option>
                                <option value="21">3 semanas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Horario. Formato: 23:00:00" name="horaRecord" id="horaRecord">
                        </div>
                    </div>
                </div>
                <hr class="featurette-divider section">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="repetir">
                        Repetir tarea
                    </label>
                </div>
                <div name="divrepetir">
                    <div class="form-group">
                        <label for="inicio">Fecha de inicio</label>
                        {{  $errors->first('inicio') }}
                        <input type="text" class="form-control" placeholder="Formato: 2016-06-24" name="inicio" id="inicio">
                    </div>
                    <div class="form-group">
                        <label for="finalizacion">Fecha de finalizacion</label>
                        {{  $errors->first('finalizacion') }}
                        <input type="text" class="form-control" placeholder="Formato: 2016-06-24" name="finalizacion" id="finalizacion">
                    </div>
                    <div class="form-group">
                        <label for="repetira">Repetir cada </label>
                        {{  $errors->first('repetira') }}
                        <select name="repetira" class="form-control">
                            <option value="1">Diariamente(1)</option>
                            <option value="7">Semanalmente(7)</option>
                            <option value="31">Mensualmente(31)</option>
                            <option value="365">Anualmente(365)</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        {{  $errors->first('otro') }}
                        <input type="text" class="form-control" placeholder="Numero de dias" name="otro">
                    </div>                     
                </div>
            </div>
            <div class="col-md-2 col-lg-2"></div>
        </div>
        <div class="row">
            <hr class="featurette-divider section">
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
                <button type="button" name="cancel" class="btn btn-default btn-form">Cancelar</button>
                <button type="submit" class="btn btn-success btn-form">Guardar</button>
            </div>
            <div class="col-md-1 col-lg-1"></div>
        </div>
    </form>
</div>
@stop