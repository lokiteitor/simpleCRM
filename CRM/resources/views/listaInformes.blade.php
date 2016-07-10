@extends('layouts.base')

@section('libs')
    @parent

@stop

@section('body')
@include('layouts.menu')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10 col-lg-10">
            <h3>Informes Clientes</h3>
        </div>
    </div>        
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10">
            <div class="table-responsive">
                <table class="table table-striped table-hover" name="listado">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contacto por clasificacion</td>
                            <td>Muestra los contactos por tipo/sector/antiguedad</td>
                            <td><a href='{{url("/ver/informe/cliente/clasificacion")}}'>Generar</a></td>
                        </tr>
                        <tr>
                            <td>Contactos generados</td>
                            <td>Muestra los contactos generados en un lapso de tiempo</td>
                            <td><a href='{{url("/ver/informe/cliente/generados")}}'>Generar</a></td>
                        </tr>
                        <tr>
                            <td>Contactos Clave</td>
                            <td>Contactos con el mayor numero de oportunidades</td>
                            <td><a href='{{url("/ver/informe/cliente/clave")}}'>Generar</a></td>
                        </tr>
                        <tr>
                            <td>Contactos olvidados</td>
                            <td>Contactos con el menor numero de oportunindades</td>
                            <td><a href='{{url("/ver/informe/cliente/olvidados")}}'>Generar</a></td>
                        </tr>
                        <tr>
                            <td>Contactos/oportunidades</td>
                            <td>Relacion entre el numero de oportunidades por contacto</td>
                            <td><a href='{{url("/ver/informe/cliente/relacion")}}' >Generar</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10 col-lg-10">
            <h3>Informes Oportunidades</h3>
        </div>        
    </div>
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10">
            <div class="table-responsive">
                <table class="table table-striped table-hover" name="listado">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Oportunidades Perdidas</td>
                            <td>Cantidad de oportunidades perdidas</td>
                            <td><a href='{{url("/ver/informe/oportunidad/perdida")}}'>Generar</a></td>
                        </tr>
                        <tr>
                            <td>Oportunidades Abiertas</td> 
                            <td>Oportunidades que estan pendientes</td>
                            <td><a href='{{url("/ver/informe/oportunidad/abierta")}}' >Generar</a></td>
                        </tr>
                        <tr>
                            <td>Oportunidades por Probabilidad</td>
                            <td>Oportunidades por su porcentaje de probabilidad</td>
                            <td><a href='{{url("/ver/informe/oportunidad/probabilidad")}}'>Generar</a></td>                            
                        </tr>
                        <tr>
                            <td>Oportunidades por fase</td>
                            <td>Oportunidades por fase en la que se encuentran</td>
                            <td><a href='{{url("/ver/informe/oportunidad/fase")}}'>Generar</a></td>
                        </tr>
                        <tr>
                            <td>Oportunidades por tipo</td>
                            <td>Oportunidades clasificadas por su tipo</td>
                            <td><a href='{{url("/ver/informe/oportunidad/tipo")}}'>Generar</a></td>
                        </tr>
                        <tr>
                            <td>Oportunidades por fuente de cliente</td>
                            <td>Ventas generadas por fuente del cliente</td>
                            <td><a href='{{url("/ver/informe/oportunidad/origen")}}'>Generar</a></td>
                        </tr>
                        <tr>
                            <td>Oportunidades que cierran esta semana</td>
                            <td>Oportunidades cuyo fecha de cierre es en los proximos dias</td>
                            <td><a href='{{url("/ver/informe/oportunidad/proximos")}}'>Generar</a></td>
                        </tr>                        
                        <tr>
                            <td>Informe de rendimiento</td>
                            <td>Informe sobre el rendimiento de miembro del equipo de ventas</td>
                            <td><a href=>Generar</a></td>
                        </tr>
                        <tr>
                            <td>Ventas del mes</td>
                            <td>Resumen de oportunidades cerradas favorablemente este mes</td>
                            <td><a href='{{url("/ver/informe/oportunidad/mes")}}'>Generar</a></td>
                        </tr>
                        <tr>
                            <td>Informe de ventas de hoy</td>
                            <td>Resumen de ventas generadas por dia</td>
                            <td><a href='{{url("/ver/informe/oportunidad/hoy")}}'>Generar</a></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10 col-lg-10">
            <h3>Informes Prospectos</h3>
        </div>        
    </div>    
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10">
            <div class="table-responsive">
                <table class="table table-striped table-hover" name="listado">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Prospectos por tipo</td>
                            <td>Cantidad de prospectos por el tipo</td>
                            <td><a href='{{url("/ver/informe/prospecto/tipo")}}' >Generar</a></td>
                        </tr>
                        <tr>
                            <td>Prospectos por fuente</td>
                            <td>Prospectos por fuente de origen</td>
                            <td><a href='{{url("/ver/informe/prospecto/origen")}}'>Generar</a></td>
                        </tr>
                        <tr>
                            <td>Prospectos por estado</td>
                            <td>Prospectos por el estado en que se encuentran</td>
                            <td><a href='{{url("/ver/informe/prospecto/estado")}}'>Generar</a></td>
                        </tr>                
                    </tbody>
                </table>
            </div>
        </div>
    </div>        
</div>


@stop