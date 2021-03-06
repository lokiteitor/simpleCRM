// Este archivo contiene la programacion para armar las tarjetas de las secciones 
// oportunidades y tareas
var pila = new Array([],[],[]);
var edicion;
// crear la ruta 

jQuery(document).ready(function($) {
    var scrollcrr;
    var ruta;
    var pagina;
    edicion;
    // determinar la ruta actual
    if (window.location.pathname == "/ver/oportunidades") {
        pagina = 0;
        scrollcrr = ($(document).height() / 10 ) * 2;
        // si el lugar es oportunidades 
        // estraer el orden
        // armar los parametros
        data = {"pagina":pagina,"nextpag":pagina+10};
        data.orderby = $('select[name="orden"]').val()        
        data.here = window.location.pathname
        ruta = "/obtener/oportunidades";
        edicion = "/editar/oportunidad/"
    }
    if (window.location.pathname == "/ver/tareas") {
        // por defecto ordenar por fecha
        pagina = 0;
        scrollcrr = ($(document).height() / 10 ) * 4;
        data = {"pagina":pagina,"nextpag":pagina+10};        
        // si el lugar es oportunidades 
        // estraer el orden
        data.orderby = $('select[name="orden"]').val()        
        // armar los parametros , acultar las tareas cumplidas
        data.here = window.location.pathname
        ruta = "/obtener/tareas";
        edicion = "/editar/tarea/"
    };

    dataServer = getDataFromServer(ruta,data);
    makeCards(window.location.pathname,dataServer)

    $('select[name="orden"]').change(function(event) {
        data.pagina = 0;
        data.nextpag = pagina+10;
        data.orderby = $('select[name="orden"]').val()
        $('div[name="col1"]').empty();
        $('div[name="col2"]').empty();
        $('div[name="col3"]').empty();
        pila = new Array([],[],[]); 
        dataServer = getDataFromServer(ruta,data);
        makeCards(window.location.pathname,dataServer)

    });

    // si el navegador llega al fondo volver a realizar la peticion
    $(document).scroll(function(event) {
        if ($(document).scrollTop() > scrollcrr) {
            // el scroll avanzo
            scrollcrr = $(document).scrollTop() + ($(document).height() / 10 ) * 2;
            data.pagina = data.nextpag;
            data.nextpag += 12;
            dataServer = getDataFromServer(ruta,data);
            makeCards(window.location.pathname,dataServer)
        };
        
    });    
});


function getDataFromServer (ruta,$data) {
    // devuelve un arreglo con los objetos json
    console.log(data)
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
    .fail(function(json) {
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
    var $row
    var nrow = 0;
    var rutaPlantilla;
    pila = new Array([],[],[]);


    if (rutaActual == "/ver/oportunidades") {
        rutaPlantilla =  "/js/html/carta.html" + " #cartaOportunidad";
        
    }
    else if (rutaActual == "/ver/tareas") {
        rutaPlantilla =  "/js/html/carta.html" + " #cartaTarea";
        
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
            if (keys[i] == "id") {
                continue
            } 
            select = "[name=" + keys[i] + "]";
            $(this).find(select).text(data[keys[i]]);
        }
        $(this).find('a[name="url"]').attr('href', window.location.origin + edicion+ data.id);

        if (data.prioridad == "Muy Alta") {
            clase = "panel-danger";
        }
        else if (data.prioridad == "Alta") {
            clase = "panel-warning";
        }
        else if (data.prioridad == "Normal"){
            clase = "panel-info"
        }
        else{
            clase = "panel-default";
        }
        $(this).find('.panel').addClass(clase);
        pila[destino].push($(this).html())
        
    })
}

