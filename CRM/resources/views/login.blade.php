@extends('layouts.base')
@section('body')

<div class="container-fluid">
    <div class=" col-sm-3 col-md-4 col-lg-4"></div>
    <div class=" col-sm-6 col-md-4 col-lg-4 login">
        <h2 class="bg-primary text-center">Login</h2>
        <form action="/auth" method="post" class="form-horizontal" name="login">
            <div class="input-group">
                <span class="input-group-addon glyphicon glyphicon-user"></span>
                <input name="correo" type="text" class="form-control" placeholder="Usuario" required>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon glyphicon glyphicon-lock"></span>
                <input name="correo" type="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <br>
            <button type="submit" class="btn btn-success btn-block">Ingresar</button>
        </form>
    </div>
    <div class=" col-sm-3 col-md-4 col-lg-4"></div>
</div>
@stop