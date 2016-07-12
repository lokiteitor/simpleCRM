@extends('layouts.base')
@section('body')

<div class="container-fluid">
    <div class=" col-sm-3 col-md-4 col-lg-4"></div>
    <div class=" col-sm-6 col-md-4 col-lg-4 login">
        <h2 class="bg-primary text-center">Registro de nuevo usuario</h2>
        <form action="/auth/registro" method="post" class="form-horizontal" name="register">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="input-group">
                <span class="input-group-addon glyphicon glyphicon-user"></span>
                <input name="name" type="text" class="form-control" placeholder="Nombre" required
                value="{{old('name')}}">
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon glyphicon glyphicon-envelope"></span>
                <input name="email" type="text" class="form-control" placeholder="Email" required
                value="{{old('email')}}">
            </div>
            <br>            
            <div class="input-group">
                <span class="input-group-addon glyphicon glyphicon-lock"></span>
                <input name="password" type="password" class="form-control" placeholder="Nueva contraseña" required id="password">
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon glyphicon glyphicon-lock"></span>
                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirmar contraseña" required>
            </div>
            <br>            
            <button type="submit" class="btn btn-success btn-block">Registrar</button>
        </form>
    </div>
    <div class=" col-sm-3 col-md-4 col-lg-4"></div>
</div>
@stop