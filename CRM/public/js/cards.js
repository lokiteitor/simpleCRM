// Este archivo contiene la programacion para armar las tarjetas de las secciones 
// oportunidades y tareas
var pila = new Array([],[],[]);
// crear la ruta 

jQuery(document).ready(function($) {
    var scrollcrr;
    var ruta;
    var pagina;
    // determinar la ruta actual
    if (window.location.pathname == "/ver/oportunidades") {
        pagina = 0;
        scrollcrr = ($(document).height() / 10 ) * 2;
        console.log("scrollcrr:" + scrollcrr)
        // si el lugar es oportunidades 
        // estraer el orden
        ordenby = $('select[name="orden"]').val()        
        // armar los parametros
        data = {"pagina":pagina,"nextpag":pagina+10,"ordenby":ordenby};
        ruta = "/obtener/oportunidades";
        pagina += 10;
    }
    if (window.location.pathname == "/ver/tareas") {
        // por defecto ordenar por fecha
        pagina = 0;
        scrollcrr = ($(document).height() / 10 ) * 4;
        console.log("scrollcrr:" + scrollcrr)
        // si el lugar es oportunidades 
        // estraer el orden
        ordenby = $('select[name="orden"]').val()        
        // armar los parametros , acultar las tareas cumplidas
        data = {"pagina":pagina,"nextpag":pagina+10,"ordenby":ordenby,"showall":false};
        ruta = "/obtener/tareas";
        pagina += 10;        

    };

    dataServer = getDataFromServer(ruta,data);
    makeCards(window.location.pathname,dataServer)
    // si el navegador llega al fondo volver a realizar la peticion
    $(document).scroll(function(event) {
        if ($(document).scrollTop() > scrollcrr) {
            // el scroll avanzo
            scrollcrr = $(document).scrollTop() + ($(document).height() / 10 ) * 3;
            data.pagina = pagina;
            pagina += 3
            data.nextpag = pagina;
            dataServer = getDataFromServer(ruta,data);
            makeCards(window.location.pathname,dataServer)
        };
        console.log($(document).scrollTop())
    });    
});


function getDataFromServer (ruta,$data) {
    // devuelve un arreglo con los objetos json
    console.log($data);
    var rtrn;

    $.ajax({
        url: ruta,
        type: 'GET',
        dataType: 'json',
        data: $data,
        async:false,
    })
    .done(function(json) {
        console.log(json);
        rtrn = json;
        console.log(rtrn)
    })
    .fail(function() {
        console.log(json);
        alert("Error al conectar al servidor")
    })
    .always(function(json) {
        console.log("complete");
    });
    return rtrn;
}


function makeCards (rutaActual,data) {
    // armar los objetos en memoria y mostrarlos en el DOM
    console.log("Creando Cartas")
    console.log(rutaActual)
    console.log(data)
    var $row
    var nrow = 0;
    var rutaPlantilla;


    if (rutaActual == "/ver/oportunidades") {
        rutaPlantilla =  "/js/html/carta.html" + " #cartaOportunidad";
        console.log(rutaPlantilla)
    }
    else if (rutaActual == "/ver/tareas") {
        rutaPlantilla =  "/js/html/carta.html" + " #cartaTarea";
        console.log(rutaPlantilla)         
     }

    columna = 0;
    for (var i = 1; i <= data.length; i++) {
        individualdata  =  data[i-1];
        if (columna == 3) {
            columna = 1
        }
        else{
            columna += 1;
        } 
        console.log(individualdata);
        // crear las columnas en memoria}    
        construirCartas(rutaPlantilla,columna-1,individualdata);            
        // agregar tres a la fila
    };

    setTimeout(function  () {
        // compilar la pula y agregarla al DOM
        for (var i = 0; i < pila.length; i++) {
            pila[i].join("")
            var dest = "div[name=col" + (i+1) + "]"
            $(dest).append(pila[i]);
        };
    }, 400)

}

function construirCartas (plantilla,destino,data) {
    // objeto que constituye el nombre_campo:valor
    // modificar los campos del objeto
    keys = Object.keys(data);
    $carta = $("<div></div>").load(plantilla,function () {
        for(var i=0;i<keys.length;i++){
            select = "[name=" + keys[i] + "]";
            $(this).find(select).text(data[keys[i]]);
        }
        if (data.prioridad == "Muy alta") {
            clase = "panel-danger";
        }
        else if (data.prioridad == "Alta") {
            clase = "panel-warning";
        }
        else if (data.prioridad == "normal"){
            clase = "panel-info"
        }
        else{
            clase = "panel-default";
        }
        $(this).find('.panel').addClass(clase);
        pila[destino].push($(this).html())
        console.log($(this).html());
    })
}

