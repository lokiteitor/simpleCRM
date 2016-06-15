@extends('layouts.base')
@section('body')
@include('layouts.menu')
<div class="container-fluid">
    <form action='{{url("/crear/cliente")}}' method="post" class="form-horizontal" name="cliente">
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="nombre">Nombre del contacto</label>
                    <div class="input-group">
                        <div class="input-group-btn" style="width:18%">
                            <select name="sexo" id="inputSexo" class="form-control" required>
                                <option value="sr">Sr.</option>
                                <option value="sra">Sra.</option>
                                <option value="dr">Dr.</option>
                                <option value="ing">Ing.</option>
                                <option value="lic">Lic.</option>
                                <option value="arq">Arq.</option>
                                <option value="prof">Prof.</option>
                            </select>            
                        </div>
                        <input type="text" name="nombre" id="inputNombre" class="form-control" required placeholder="Nombre">                            
                    </div>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" placeholder="Apellidos de Cliente" name="apellidos" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" placeholder="Telefono de Cliente" name="telefono" required>
                </div>
                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="text" class="form-control" placeholder="Celular de Cliente" name="celular">
                </div>
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
                    <label>
                        <input type="checkbox" name="atiende-correo">
                        Suele Atender al correo?
                    </label>
                </div>
            </div>
            <div class="col-md-1 col-lg-1"></div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="empresa">Empresa</label>
                    <input type="text" class="form-control" name="empresa" placeholder="Empresa donde trabaja">
                </div>
                <div class="form-group">
                    <label for="correo">Sitio web</label>
                    <input type="text" class="form-control" name="web" placeholder="Sitio web de la empresa">
                </div>
                <div class="form-group">
                    <label for="empresa">Correo</label>
                    <input type="text" class="form-control" placeholder="Correo del cliente" name="correo">
                </div>
                <div class="form-group">
                    <label for="estado">Estado del cliente</label>
                    <select name="estado" class="form-control" name="estado" required>
                        <option value="Contactado">Contactado</option>
                        <option value="Contactar a futuro">Contactar a futuro</option>
                        <option value="Intento de contacto fallido">Intento de contacto fallido</option>
                        <option value="Iniciativa perdida">Iniciativa perdida</option>
                        <option value="Sin contactar">Sin contactar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="calificacion">Calificacion</label>
                    <select name="calificacion" class="form-control" name="calificacion" required>
                        <option value="Adquirido">Adquirido</option>
                        <option value="Activo">Activo</option>
                        <option value="Mercado Fallido">Mercado Fallido</option>
                        <option value="Proyecto Cancelado">Proyecto Cancelado</option>
                        <option value="Cerrado">Cerrado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="valoracion">Valoracion</label>
                    <select name="valoracion" class="form-control" name="valoracion" required>
                        <option value="Caliente">Caliente</option>
                        <option value="Templado">Templado</option>
                        <option value="Frio">Frio</option>
                    </select>
                </div>                
            </div>
        </div>
        <div class="row">
            <hr class="featurette-divider section">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-4 col-lg-4">
                <h3>Informacion de Contacto</h3>
                <div class="form-group">
                    <label for="calle">Calle </label>
                    <input type="text" class="form-control" placeholder="Nombre de la calle" name="calle">
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
                <label for="descripcion">Notas sobre el cliente</label>
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
