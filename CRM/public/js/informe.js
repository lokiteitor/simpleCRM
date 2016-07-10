jQuery(document).ready(function($) {
// armar las opciones del request

// {elemento:{campos:[],inicio:0000-00-00,fin:0000-00-00,cliente:boolean}}

opciones = {'timepicker':false,'format':'Y-m-d'};
$.datetimepicker.setLocale('es');
$('input[name="inicio"]').datetimepicker(opciones);
$('input[name="fin"]').datetimepicker(opciones);

var data = {};

if (window.location.pathname == "/ver/informe/cliente/clasificacion") {
    console.log('cliente')
    data.contacto = {campos:['ingresos','tipo','origen'],cliente:true};
    getDataFromServer(data);
}
    
});


function getDataFromServer (data) {
    // obtener los datos requeridos para el informe 
    // ambos sirven para el grafico y la tabulacion
    $.ajax({
        url: '/obtener/datos/informes',
        type: 'GET',
        dataType: 'json',
        data: data
    })
    .done(function(json) {
        console.log("success");
        // cuando los datos esten listos pasar a la funciones que 
        // los muestran en pantalla
        mostrarTabulacion(json);
        mostrarGrafico(json);
    })
    .fail(function() {
        alert('Error al conectar con el servidor')
    })
    .always(function() {
        console.log("complete");
    });
        
}

function mostrarTabulacion (json) {
    // armar la tabla en base a los datos pasados en la tabulacion

    if (window.location.pathname == "/ver/informe/cliente/clasificacion" ) {
        clienteClasificacion(json);
    };

}

function clienteClasificacion (json) {
    var tipo = {
        'particular':{'cantidad':0,'ingresos':0},
        'gobierno':{'cantidad':0,'ingresos':0},
        'empresa':{'cantidad':0,'ingresos':0},
        'educacion':{'cantidad':0,'ingresos':0}

    }

    for (var i = 0; i < json['contacto'].length; i++) {
        if (json['contacto'][i].tipo == "Particular") {
            tipo.particular.cantidad += 1
            tipo.particular.ingresos += json['contacto'][i].ingresos - json['contacto'][i].inversion
            $('tr[name="particular"] td.cantidad').text(tipo.particular.cantidad);
            $('tr[name="particular"] td.ingresos').text(tipo.particular.ingresos);
        };

        if (json['contacto'][i].tipo == "Gobierno") {
            tipo.gobierno.cantidad += 1
            tipo.gobierno.ingresos += json['contacto'][i].ingresos - json['contacto'][i].inversion
            $('tr[name="gobierno"] td.cantidad').text(tipo.gobierno.cantidad);
            $('tr[name="gobierno"] td.ingresos').text(tipo.gobierno.ingresos);            
        };

        if (json['contacto'][i].tipo == "Empresa") {
            tipo.empresa.cantidad += 1
            tipo.empresa.ingresos += json['contacto'][i].ingresos - json['contacto'][i].inversion
            $('tr[name="empresa"] td.cantidad').text(tipo.empresa.cantidad);
            $('tr[name="empresa"] td.ingresos').text(tipo.empresa.ingresos);            
        };
        if (json['contacto'][i].tipo == "Educacion") {
            tipo.educacion.cantidad += 1
            tipo.educacion.ingresos += json['contacto'][i].ingresos - json['contacto'][i].inversion
            $('tr[name="educacion"] td.cantidad').text(tipo.educacion.cantidad);
            $('tr[name="educacion"] td.ingresos').text(tipo.educacion.ingresos);    
        };        
    };    
}

