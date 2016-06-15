jQuery(document).ready(function($) {
    /**
    @brief incluye toda la logica de la aplicacion
    */


// ocultar el menu lateral al presionar hide
$('#navapp button[name="hide"]').click(function(event) {
    event.preventDefault();
   $("#navapp").animate({
        width: parseInt($("#navapp").css("width"))== 0?"-="+$("#navapp").outerWidth():0,
        opacity:parseInt($("#navapp").css("opacity")) == 1 ? 0 : 1
    });
   $('button[name="show"]').addClass('btn-show');
});

// mostrar el menu lateral
$('button[name="show"]').click(function(event) {
    event.preventDefault();
    console.log('show');
   $("#navapp").animate({
        // mientras no sea igual 15% de body
        width: parseInt($("#navapp").css("width"))== parseInt($('body').width() *.15 )?"+="+parseInt($('body').width() * .15) :parseInt($('body').width() * .15),
        opacity:parseInt($("#navapp").css("opacity")) == 1 ? 0 : 1
    });
    $('button[name="show"]').removeClass('btn-show')
});
    
var sitecalendario = [["/crear/oportunidad","#cierre"],["/crear/tarea","#vencimiento"],
["/crear/evento","#defecha"],["/crear/evento","#afecha"],["/crear/evento","#inicio",{"time":false}],
["/crear/evento","#finalizacion",{time:false}],["/crear/tarea","#vencimiento",{"time":false}],
["/crear/tarea","#horaRecord",{"date":false}],["/crear/tarea","#inicio",{"time":false}],
["/crear/tarea","#finalizacion",{"time":false}],["/crear/oportunidad","#cierre",{"time":false}]]

for(var i = 0; i< sitecalendario.length;i++ ){
    if (window.location.pathname == sitecalendario[i][0]) {
        if (sitecalendario[i].length > 2) {
            mostrarCalendario(sitecalendario[i][1],sitecalendario[i][2]);
        }
        else {
            mostrarCalendario(sitecalendario[i][1]);   
        }

    };
}


});


function mostrarCalendario (id,opt=null) {
    var opciones = {};
    if (opt != null) {

        if (opt.hasOwnProperty("time")) {
            opciones.timepicker = false;
            opciones.format = "Y/m/d"
        }
        if (opt.hasOwnProperty("date")) {
            opciones.datepicker = false;
            opciones.format = "H:i"
        };

        $(id).datetimepicker(opciones);    
    }
    else{
        $(id).datetimepicker();    
    }
    
}