jQuery(document).ready(function($) {
    // conectar con la api y regresar los eventos del mes actual
    date = new Date()
    options = {}
    options.lang = "es"
    options.header = {"left":"prev,next,today","center":"title","right":"month,agendaWeek,agendaDay"}
    options.buttonText = {today:"hoy","month":"mes","week":"semana"}
    options.eventLimit = true;
    options.events = getEventMonth(date.getFullYear(),date.getMonth()+1)
    options.eventClick =  function  (evento,jsevent,view) {
         //  al dar click sobre un objeto dirijirse al menu vista del evento
    }


    console.log(options);

    $("#calendario").fullCalendar(options);

});



function getEventMonth (anio,mes) {
     // pide al servidor los eventos del mes y los devuelve en el formato de fullcalendar
    eventos = new Array();
     $.ajax({
         url: '/obtener/eventos',
         type: 'GET',
         dataType: 'json',
         data: {"mes":mes,"anio":anio},
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
     })
     .always(function() {
         console.log("complete");
     });

    return eventos;     
}