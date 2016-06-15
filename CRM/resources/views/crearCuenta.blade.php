@extends('layouts.base')
@section('body')
@include('layouts.menu')
<div class="container-fluid">
    <form action='{{url("/crear/cliente")}}' method="post" class="form-horizontal" name="cliente">
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
                    <label for="fcalle">Calle de facturacion </label>
                    <input type="text" class="form-control" placeholder="Nombre de la Calle de facturacion" name="fcalle">
                </div>
                <div class="form-group">
                    <label for="fciudad">Ciudad de facturacion </label>
                    <input type="text" class="form-control" placeholder="Ciudad de facturacion" name="fciudad">
                </div>
                <div class="form-group">
                    <label for="festado">Estado de facturacion </label>
                    <input type="text" class="form-control" placeholder="Estado de facturacion" name="festado">
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
            </div>
            <div class="col-md-1 col-lg-1"></div>
        </div>
    </form>
</div>
@stop