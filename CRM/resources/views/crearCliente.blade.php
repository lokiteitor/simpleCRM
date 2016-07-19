@extends('layouts.base')

@section('libs')
    @parent
    @if ($edicion)
        <script src='{{asset("/js/cookiemanager.js")}}'></script>
        <script src='{{asset("/js/editar.js")}}'></script>        
    @endif
@stop

@section('body')
@include('layouts.menu')
@section("titlehead")
@parent
<div class=" col-md-2 col-lg-2"></div>
<div class=" col-md-2 col-lg-2">
    @if (isset($edicion) && $edicion == true)
        <button type="button" name="next" class="btn btn-default botonseccion btn-form"><span class="glyphicon glyphicon-chevron-right"></span></button>
        <button type="button" name="prev" class="btn btn-default botonseccion btn-form"><span class="glyphicon glyphicon-chevron-left"></span></button>
    @endif        
</div>
@stop

<div class="container-fluid">
    <form action="{{url('/crear/prospecto')}}" method="post" class="form-horizontal" name="cliente">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="nombre">Nombre del contacto</label>
                    <div class="input-group">
                        <div class="input-group-btn" style="width:18%">
                            <select name="sexo" id="inputSexo" class="form-control" required>
                                <option value="Sr.">Sr.</option>
                                <option value="Sra.">Sra.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Ing.">Ing.</option>
                                <option value="Lic.">Lic.</option>
                                <option value="Arq.">Arq.</option>
                                <option value="Prof.">Prof.</option>
                            </select>            
                        </div>
                        {{  $errors->first('nombre') }}
                        <input type="text" name="nombre" id="inputNombre" class="form-control" required placeholder="Nombre"> 
                    </div>
                </div>

                <div class="form-group">
                    {{  $errors->first('apellidos') }}
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" placeholder="Apellidos de Cliente" name="apellidos" required>
                </div>
                <div class="form-group">
                    {{  $errors->first('telefono') }}
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" placeholder="Formato: 444-123-4567" name="telefono">
                </div>
                <div class="form-group">
                    {{  $errors->first('celular') }}
                    <label for="celular">Celular</label>
                    <input type="text" class="form-control" placeholder="Formato:04444-123-4567" name="celular">
                </div>
                <div class="form-group">
                    <label for="origen">Origen del cliente</label>
                    <select name="origen" class="form-control" required>
                        <option value="Anuncio">Anuncio</option>
                        <option value="Folleto">Folleto</option>
                        <option value="Referencia de empleado">Referencia de empleado</option>
                        <option value="Referencia de otro cliente">Referencia de otro cliente</option>
                        <option value="Sitio Web">Sitio web</option>
                        <option value="Anuncio via email">Anuncio via email</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo de cliente</label>
                    <select name="tipo" class="form-control" required>
                        <option value="Particular">Particular</option>
                        <option value="Educacion">Educacion</option>
                        <option value="Gobierno">Gobierno</option>
                        <option value="Empresa">Empresa</option>
                    </select>
                </div>                
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="atiende-correo">
                        Suele Atender al correo?
                    </label>
                </div>
            </div>
            <div class="col-md-1 col-lg-1"></div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    {{  $errors->first('empresa') }}
                    <label for="empresa">Empresa</label>
                    <input type="text" class="form-control" name="empresa" placeholder="Empresa donde trabaja">
                </div>
                <div class="form-group">
                    {{  $errors->first('web') }}
                    <label for="correo">Sitio web</label>
                    <input type="text" class="form-control" name="web" placeholder="Formato: http://www.sitio.com">
                </div>
                <div class="form-group">
                    {{  $errors->first('correo') }}
                    <label for="correo">Correo</label>
                    <input type="text" class="form-control" placeholder="Formato:usuario@dominio.com" name="correo">
                </div>
                <div class="form-group">
                    <label for="estado">Estado del cliente</label>
                    <select name="estado" class="form-control" required>
                        <option value="Contactado">Contactado</option>
                        <option value="Contactar a futuro">Contactar a futuro</option>
                        <option value="Intento de contacto fallido">Intento de contacto fallido</option>
                        <option value="Iniciativa perdida">Iniciativa perdida</option>
                        <option value="Sin contactar">Sin contactar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="calificacion">Calificacion</label>
                    <select name="calificacion" class="form-control" required>
                        <option value="Adquirido">Adquirido</option>
                        <option value="Activo">Activo</option>
                        <option value="Mediano-Largo Plazo">Mediano-Largo Plazo</option>
                        <option value="Proyecto Cancelado">Proyecto Cancelado</option>
                        <option value="Cerrado">Cerrado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="valoracion">Valoracion</label>
                    <select name="valoracion" class="form-control" required>
                        <option value="Caliente">Caliente</option>
                        <option value="Templado">Templado</option>
                        <option value="Frio">Frio</option>
                    </select>
                </div>                
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control buscador" list="campañas" placeholder="Campaña de origen" name="campañas" data-busqueda="campaña">
                        <span class="input-group-btn"><button class="btn btn-default" name="buscar-campaña" type="button"><span class="glyphicon glyphicon-search">Campaña</span></button></span>
                        
                    </div>
                </div>                          
            </div>
        </div>
        <div class="row">
            <hr class="featurette-divider section">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-4 col-lg-4">
                <h3>Informacion de Contacto</h3>
                <div class="form-group">
                    {{  $errors->first('calle') }}
                    <label for="calle">Calle </label>
                    <input type="text" class="form-control" placeholder="Nombre de la calle" name="calle">
                </div>
                <div class="form-group">
                    {{  $errors->first('numero') }}
                    <label for="numero">Numero Exterior</label>
                    <input type="text" class="form-control" placeholder="Formato: 222" name="numero">
                </div>
            </div>
            <div class="col-md-1 col-lg-1"></div>
            <div class="col-md-4 col-lg-4">
                <br>
                <br>
                <br>
                <div class="form-group">
                    {{  $errors->first('colonia') }}
                    <label for="colonia">Fraccionamiento o colonia</label>
                    <input type="text" class="form-control" placeholder="Fraccionamiento o colonia" name="colonia">
                </div>
                <div class="form-group">
                    <label for="codigo postal">Codigo Postal</label>
                    <input type="text" class="form-control" placeholder="79399" name="cpostal">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-9 col-lg-9">
                <label for="descripcion">Notas sobre el cliente</label>
                <textarea name="descripcion" rows="5" class="form-control"></textarea>
            </div>
            <div class="col-md-1 col-lg-1"></div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6"></div>
            <div class="col-md-4 col-lg-4">                
                <button type="button" name="cancel" class="btn btn-default btn-form">Cancelar</button>
                <button type="submit" name="guardar" class="btn btn-success btn-form">Guardar</button>
                @if($edicion)
                    <button type="button" name="salir" class="btn btn-default btn-form">Salir</button>
                @endif
            </div>
            <div class="col-md-1 col-lg-1"></div>
        </div>
    </form>
</div>
@stop
