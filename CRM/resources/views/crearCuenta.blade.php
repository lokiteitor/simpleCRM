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
    <form action={{$action}} method="post" class="form-horizontal" name="cuenta">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">       
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="nombre">Nombre de la cuenta</label>
                    <input type="text" class="form-control" placeholder="Nombre de la Cuenta" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="">
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="correo">Sitio web</label>
                    <input type="text" class="form-control" name="web" placeholder="Sitio web de la empresa">
                </div>
                <div class="form-group">
                    <label for="calificacion">Calificacion</label>
                    <select name="calificacion" class="form-control" required>
                        <option value="Adquirido">Adquirido</option>
                        <option value="Activo">Activo</option>
                        <option value="Mercado Fallido">Mercado Fallido</option>
                        <option value="Proyecto Cancelado">Proyecto Cancelado</option>
                        <option value="Cerrado">Cerrado</option>
                    </select>
                </div>
            </div>
            <div class="col-md-1 col-lg-1"></div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" placeholder="Telefono de Cliente" name="telefono" required>
                </div>
                <div class="form-group">
                    <label for="sector">Sector</label>
                    <select name="sector" class="form-control" required>
                        <option value="agrucultura">Agricultura</option>
                        <option value="quimica">Quimica</option>
                        <option value="comunicaciones">Comunicaciones</option>
                        <option value="construccion">Construccion</option>
                        <option value="consultora">Consultura</option>
                        <option value="educacion">Educacion</option>
                        <option value="electronica">Electronica</option>
                        <option value="energia">Energia</option>
                        <option value="ingenieria">Ingenieria</option>
                        <option value="entretenimiento">Entretenimiento</option>
                        <option value="entorno">Entorno</option>
                        <option value="finanzas">Finanzas</option>
                        <option value="alimentos">Alimentos</option>
                        <option value="gobierno">Gobierno</option>
                        <option value="salud">Salud</option>
                        <option value="maquinaria">Maquinaria</option>
                        <option value="manofactura">Manofactura</option>
                        <option value="recreacion">Recreacion</option>
                        <option value="tecnologia">Tecnologia</option>
                        <option value="transporte">Transporte</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="empleados">Empleados</label>
                    <input type="text" class="form-control" placeholder="Cantidad de empleados" name="empleados">
                </div>
            </div>
            <div class="col-md-1 col-lg-1"></div>
        </div>
        <div class="row">
            <hr class="featurette-divider section">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-4 col-lg-4">
                <h3>Informacion de direccion</h3>
                <div class="form-group">
                    <label for="calle">Calle </label>
                    <input type="text" class="form-control" placeholder="Nombre de la Calle" name="calle">
                </div>
                <div class="form-group">
                    <label for="ciudad">Ciudad </label>
                    <input type="text" class="form-control" placeholder="Ciudad" name="ciudad">
                </div>
                <div class="form-group">
                    <label for="estado">Estado </label>
                    <input type="text" class="form-control" placeholder="Estado" name="estado">
                </div>
                <div class="form-group">
                    <label for="numero">Numero Exterior</label>
                    <input type="text" class="form-control" placeholder="222" name="numero">
                </div>
            </div>
            <div class="col-md-1 col-lg-1"></div>
            <div class="col-md-4 col-lg-4">
                <br>
                <br>
                <br>
                <div class="form-group">
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
                <label for="descripcion">Notas sobre la cuenta</label>
                <textarea name="descripcion" rows="5" class="form-control"></textarea>
            </div>
            <div class="col-md-1 col-lg-1"></div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6"></div>
            <div class="col-md-4 col-lg-4">
                <button type="button" class="btn btn-default btn-form">Cancelar</button>
                <button type="submit" class="btn btn-success btn-form">Guardar</button>
                @if($edicion)
                    <button type="button" name="salir" class="btn btn-default btn-form">Salir</button>
                @endif                
            </div>
            <div class="col-md-1 col-lg-1"></div>
        </div>
    </form>
</div>
@stop