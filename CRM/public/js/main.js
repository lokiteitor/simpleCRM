jQuery(document).ready(function($) {

// ocultar el menu lateral al presionar hide
$('button[name="toogle"]').click(function(event) {
    event.preventDefault();
    if ($(this).val() == "hide" ) {
        $("#navapp").animate({
             width: parseInt($("#navapp").css("width"))== 0?"-="+$("#navapp").outerWidth():0,
             opacity:parseInt($("#navapp").css("opacity")) == 1 ? 0 : 1
         });
        $(this).val("show");
       $(this).find('span').removeClass('glyphicon-menu-left');
       $(this).find('span').addClass('glyphicon-menu-right');        
    }
    else{
       $("#navapp").animate({
            // mientras no sea igual 15% de body
            width: parseInt($("#navapp").css("width"))== parseInt($('body').width() *.15 )?"+="+parseInt($('body').width() * .15) :parseInt($('body').width() * .15),
            opacity:parseInt($("#navapp").css("opacity")) == 1 ? 0 : 1
        });        
       $(this).val("hide");
       $(this).find('span').removeClass('glyphicon-menu-right');
       $(this).find('span').addClass('glyphicon-menu-left');
    }
});
    
var opt = {
    "evento": [["#defecha",{"date":false}],["#afecha",{"date":false}],["#inicio",{"time":false}],["#finalizacion",{"time":false}],["#fecha",{"time":false}],["#horaRecord",{"date":false}]] ,
    "tarea": [["#vencimiento",{"time":false}],["#horaRecord",{"date":false}],["#inicio",{"time":false}],["#finalizacion",{"time":false}]],
    "oportunidad": [["#cierre",{"time":false}]],
    "campana": [["#inicio",{"time":false}],["#finalizacion",{"time":false}]]
}

var regex = new RegExp("\/(editar|crear)\/(tarea|evento|campana|oportunidad)\/*[0-9]*")
var seccion = new RegExp("(evento|tarea|campana|oportunidad)")


if (regex.test(window.location.pathname)) {
    var opciones = opt[seccion.exec(window.location.pathname)[0]]
    for (var i = 0; i < opciones.length; i++) {
        mostrarCalendario(opciones[i][0],opciones[i][1])
    };
}
// si la pagina actual tiene elementos que se ocultan con un checkbox

var regexTarea = new RegExp("\/(editar|crear)\/tarea\/*[0-9]*")
if (regexTarea.test(window.location.pathname)) {  

    $('div[name="divrecordatorio"]').hide(300);
    $('div[name="divrepetir"]').hide(300);
    $('input[name="recordatorio"]').change(function(event) {
        $('div[name="divrecordatorio"]').toggle(300);
    });    
    $('input[name="repetir"]').change(function(event) {
        $('div[name="divrepetir"]').toggle(300);
    });
}

var regexEvento = new RegExp("\/(editar|crear)\/evento\/*[0-9]*")
if (regexEvento.test(window.location.pathname)) {  

    $('div[name="divrepetir"]').hide(300);
    $('div[name="divrecordatorio"]').hide(300);
    $('input[name="allday"]').change(function(event) {
        $('div[name="divallday"]').toggle(300);
    });    
    $('input[name="repetir"]').change(function(event) {
        $('div[name="divrepetir"]').toggle(300);
    });
     $('input[name="recordatorio"]').change(function(event) {
        $('div[name="divrecordatorio"]').toggle(300);
    });
       
}

$('button[name="cancel"]').click(function(event) {
    event.preventDefault();    
    var anterior = new RegExp("(evento|tarea|campana|oportunidad|cuenta|contacto|cliente)")    
    var evaluacion = anterior.exec(window.location.pathname)
    if (evaluacion != null ) {
        if (evaluacion[0] != "oportunidad") {
            window.location = window.location.origin + "/ver/" + evaluacion[0] +  "s"
        } 
        else{
            window.location = window.location.origin + "/ver/" + evaluacion[0] +  "es"      
        }
        
    } else{
        window.location = window.location.origin;
    }
});


if (window.location.pathname == '/crear/campana') {
    // si el campo de seleccion tipo tiene seleccionado el campo otro 
    // mostrar el campo input correspondiente
    $('input[name="otro"]').hide('100');
    $('select[name="tipo"]').change(function(event) {
        if ($(this).val() == 'Otro') {
            $('input[name="otro"]').show('100');
        }
        else{
            $('input[name="otro"]').hide('100');
        }
    });
};


if (window.location.pathname == '/crear/tarea') {
    $('input[name="otro"]').hide('100');
    $('select[name="repetira"]').change(function(event) {
        if ($(this).val() == 'Otro') {
            $('input[name="otro"]').show('100');
        }
        else{
            $('input[name="otro"]').hide('100');
        }
    });    
};
if (window.location.pathname == '/crear/evento') {
    $('input[name="otrorepeticion"]').hide('100');
    $('select[name="repetira"]').change(function(event) {
        if ($(this).val() == 'Otro') {
            $('input[name="otrorepeticion"]').show('100');
        }
        else{
            $('input[name="otrorepeticion"]').hide('100');
        }
    });           
};


});

function mostrarCalendario (id,opt=null) {
    var opciones = {};
    $.datetimepicker.setLocale('es');
    if (opt != null) {

        if (opt.hasOwnProperty("time")) {
            opciones.timepicker = false;
            opciones.format = "Y-m-d"
        }
        if (opt.hasOwnProperty("date")) {
            opciones.datepicker = false;
            opciones.format = "H:i:s"
        }
        $(id).datetimepicker(opciones);    
    }
    else{
        opciones.format = 'Y-m-d H:i:s'
        $(id).datetimepicker(opciones);    
    }
    
}
