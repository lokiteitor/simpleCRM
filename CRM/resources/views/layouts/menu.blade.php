<nav class=" navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a href="/"><img src="{{asset('img/logo-top.jpg')}}" class="logo" alt=""></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse navbar-right">
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar">
                            <span class="input-group-btn"><button class="btn btn-default" type="button">Buscar</button></span>
                        </div>
                    </div>
                </form>
                
                <ul class="nav navbar-nav">
                    <li><a style="color:#B6B6B6" href="#"><span class="glyphicon glyphicon-bell"></span></a></li>
                    <li><a style="color:#B6B6B6" href="#">{{$usuario}}</a></li>
                    <li class="dropdown hidden-md hidden-lg">
                        <a href="#" class="dropdow-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a style="color:#B6B6B6" href='http://remisiones.vantec.mx'>Remisiones</a></li>
                            <li><a style="color:#B6B6B6" href='{{url("/ver/prospectos")}}'>Prospectos</a></li>
                            <li><a style="color:#B6B6B6" href='{{url("/ver/clientes")}}'>Clientes</a></li>
                            {{-- <li><a style="color:#B6B6B6" href='{{url("/ver/cuentas")}}'>Cuentas</a></li>                             --}}
                            <li><a style="color:#B6B6B6" href='{{url("/ver/campanas")}}'>Campañas</a></li>                            
                            <li><a style="color:#B6B6B6" href='{{url("/ver/oportunidades")}}'>Oportunidades</a></li>
                            <li><a style="color:#B6B6B6" href='{{url("/ver/tareas")}}'>Tareas</a></li>
                            <li><a style="color:#B6B6B6" href='{{url("/ver/eventos")}}'>Eventos</a></li>
                            <li role="separator" class="divider"></li>
                            @if (Auth::user()->id == 1)
                                <li><a style="color:#B6B6B6" href='{{url("/auth/registro")}}'>Registrar Usuario</a></li>
                            @endif
                            
                            <li><a style="color:#B6B6B6" href="{{url('/auth/logout')}}">Salir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div id="navapp" class="visible-md-block visible-lg-block">
    <div class=" col-md-12  col-lg-12">
        <div class="btn-group  btn-group-vertical ">
            <div>
                <a href='http://remisiones.vantec.mx'><button name="home" type="button" class="btn btn-default"><span class="glyphicon glyphicon-home"></span>  Remisiones</button></a>
            </div>            
            <div>
                <a href='{{url("/ver/prospectos")}}'><button name="cliente" type="button" class="btn btn-default"><span class="glyphicon glyphicon-user"></span>  Prospectos</button></a>
            </div>
            <div>
                <a href='{{url("/ver/clientes")}}'><button name="contacto" type="button" class="btn btn-default"><span class="glyphicon glyphicon-briefcase"></span>  Clientes</button></a>
            </div>
            {{-- <div>
                <a href='{{url("/ver/cuentas")}}'><button name="cuenta" type="button" class="btn btn-default"><span class="glyphicon glyphicon-credit-card"></span>  Cuentas</button></a>
            </div> --}}            
            <div>
                <a href='{{url("/ver/campanas")}}'><button name="campaña" type="button" class="btn btn-default"><span class="glyphicon glyphicon-bullhorn"></span> Campañas</button></a>
            </div>            
            <div>
                <a href='{{url("/ver/oportunidades")}}'><button name="oportunidad" type="button" class="btn btn-default"><span class="glyphicon glyphicon-usd"></span>  Oportunidades</button></a>
            </div>
            <div>
                <a href='{{url("/ver/tareas")}}'><button name="tarea" type="button" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span>  Tareas</button></a>
            </div>
            <div>
                <a href='{{url("/ver/eventos")}}'><button name="evento" type="button" class="btn btn-default"><span class="glyphicon glyphicon-calendar"></span>  Eventos</button></a>
            </div>            
            <div>
                <a href='{{url("/ver/informes")}}'><button name="evento" type="button" class="btn btn-default"><span class="glyphicon glyphicon-signal"></span>  Informes</button></a>
            </div>                        
            @if (Auth::user()->id == 1)
                <div>
                    <a href='{{url("/auth/registro")}}'><button name="registro" type="button" class="btn btn-default"><span class="glyphicon glyphicon-wrench"></span>  Registro de usuario</button></a>
                </div>                 
            @endif

            <div>
                <a href='{{url("/auth/logout")}}'><button name="logout" type="button" class="btn btn-default"><span class="glyphicon glyphicon-log-out"></span>Salir</button></a>
            </div>             
        </div>
    </div>
</div>
<button name="toogle" type="button" value="hide" class="btn btn-default toogleMenu visible-md-block visible-lg-block"><span class="glyphicon glyphicon-menu-left"></span></button>
