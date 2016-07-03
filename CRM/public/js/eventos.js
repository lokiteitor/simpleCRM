jQuery(document).ready(function($) {
    // conectar con la api y regresar los eventos del mes actual

    // convertir a timestap de unix en segundos
    Date.prototype.getUnixTime = function() { return this.getTime()/1000|0 };
    if(!Date.now) Date.now = function() { return new Date(); }
    Date.time = function() { return Date.now().getUnixTime(); }


    date = new Date()
    options = {}
    options.lang = "es"
    options.header = {"left":"prev,next,today","center":"title","right":"month,agendaWeek,agendaDay"}
    options.buttonText = {today:"hoy","month":"mes","week":"semana"}
    options.eventLimit = true;
    options.events = getEventMonth(date.getUnixTime())

    console.log(options);

    $("#calendario").fullCalendar(options);
    var moment = $("#calendario").fullCalendar('getDate')


});



function getEventMonth (timedata) {
     // pide al servidor los eventos del mes y los devuelve en el formato de fullcalendar
    eventos = new Array();
     $.ajax({
         url: '/obtener/eventos',
         type: 'GET',
         dataType: 'json',
         data: {"date":timedata,'here':window.location.pathname},
         async:false
     })
     .done(function(json) {
         console.log(json);
         console.log('ok')
         for (var i = 0; i < json.length; i++) {
             eventos.push({"title":json[i].titulo,"start":json[i].tiempo,
                "end":json[i].tiempofin,allDay:json[i].isallday,
                "url":window.location.origin + "/editar/evento/"+ json[i].id })
         };
     })
     .fail(function() {
         console.log("error");
         alert("Error al conectar con el servidor")
     })
     .always(function() {
         console.log("complete");
     });

    return eventos;     
}