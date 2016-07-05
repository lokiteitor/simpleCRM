jQuery(document).ready(function($) {
    //ha esta pagina se proviene de /ver/clientes por lo tanto se asume que 
    //se tiene un cookie con los perfiles a editar

    //borrar el id correspondiente a esta pagina
    var registros = readCookie("registros");
    var actual = window.location.pathname.split("/");
    actual = actual[actual.length - 1];
    var indice = -1;
    var ServerData;
    var salida;
    var seccion;   

    if (registros != null) {
        registros = registros.split(",");        
        indice = registros.indexOf(actual);
        
    }
    else{
        alert("Error durante la navegacion el registro no exite");
    }
    if (registros.length == 1 || registros == null) {
        // borrar las flechas
        $('button[name="next"]').remove();
        $('button[name="prev"]').remove();
    }
    // desactivar los botones si no se tiene elementos consecuentes
    if (indice == registros.length -1) {
        $('button[name="next"]').attr('disabled', 'disabled');
    }
    else if (indice == 0){
        $('button[name="prev"').attr('disabled', 'disabled');
    }

    // secciones 
    if (window.location.pathname == "/detalles/prospecto/"+actual) {
        var APIdata = {
            "/obtener/prospecto":{"id":actual},
            "/obtener/tareas":{"isMember":actual},
            "/obtener/eventos":{"isMember":actual},
        }
        ServerData = getMixedDataFromServer(APIdata)
        salida = "/ver/prospecto/"
        seccion = "/detalles/prospecto/"
        llenarMixedFormulario(ServerData);
    };
    if (window.location.pathname == "/detalles/cliente/"+actual) {
        var APIdata = {
            "/obtener/cliente":{"id":actual},
            "/obtener/tareas":{"isMember":actual},
            "/obtener/eventos":{"isMember":actual},
        }
        ServerData = getMixedDataFromServer(APIdata)
        salida = "/ver/clientes/"
        seccion = "/detalles/cliente/"
        llenarMixedFormulario(ServerData);
    }; 
    if (window.location.pathname == "/detalles/campana/"+actual) {
        var APIdata = {
            "/obtener/campana":{"id":actual},            
            "/obtener/oportunidades":{"isMember":actual},            
        }
        ServerData = getMixedDataFromServer(APIdata)
        salida = "/ver/campanas/"
        seccion = "/detalles/campana/"
        llenarMixedFormulario(ServerData);
    };      
             

    console.log(registros)
    // moverse entre los registros
    $('button[name="next"]').click(function(event) {
        event.preventDefault();
        // buscar el elemento actual y pasar al siguiente
        var destino = window.location.origin + seccion + registros[indice+1];
        window.location = destino;
    });
    $('button[name="prev"]').click(function(event) {
        event.preventDefault();
        // buscar el elemento actual y pasar al siguiente
        var destino = window.location.origin + seccion + registros[indice-1];
        window.location = destino;
    });    

    // al guardar algun registro eliminar ese elemento de la lista
    $('button[name="salir"]').click(function(event) {
        borrarCookie("registros");
        window.location = window.location.origin + salida
    });

});


function getMixedDataFromServer (data) {
    // devuelve un arreglo con los objetos json
    // desde el servidor se juntan los datos
    console.log(data);
    var rtrn;

    $.ajax({
        url: "/obtener/detalles",
        type: 'GET',
        dataType: 'json',
        data: data,
        async:false,
    })
    .done(function(json) {
        console.log(json);
        rtrn = json;
        console.log(rtrn)
    })
    .fail(function() {
        alert("Error al conectar al servidor")
    })
    .always(function(json) {
        console.log("complete");
    });
    return rtrn;
}

function llenarMixedFormulario (data) {
    console.log(data)
    var keys = Object.keys(data);       
    for (var i = 0; i < keys.length; i++) {
        console.log(keys[i])

        var internal = Object.keys(data[keys[i]])
        for (var x = 0; x < internal.length; x++) {
            var texto = data[keys[i]];
            if (typeof(texto[internal[x]]) == "object") {
                construirMixedFila(keys[i],texto[internal[x]])
            }
            else{
                var campo = '.'+keys[i] + ' [name="'+ internal[x] + '"]';
                $(campo).text(texto[internal[x]])
                console.log(campo);
                console.log(texto[internal[x]]);
            }                    
        };     
    };
}


function construirMixedFila(tabla,data) {
    // objeto que constituye el nombre_campo:valor
    // modificar los campos del objeto
    var keys = Object.keys(data);
    console.log(data);
    console.log(tabla);
    var $contenedor = $("<tr></tr>");
    var contenido = new Array();

    var check =  '<th><a href="'+ data.url + '">Ver</a>' + '</th>'
    contenido.push(check);

    for (var i = 0; i < keys.length; i++) {
        if (keys[i] == "url") {
            continue;   
        }
        th = '<th name="' + keys[i] + '">' + data[keys[i]] + '</th>';
        contenido.push(th);        
    };
    contenido = contenido.join("");
    console.log(contenido);
    $(contenido).appendTo($contenedor);
    console.log($contenedor)
    tabla = 'table[name="' + tabla + '"] tbody'
    console.log(tabla)
    $(tabla).append($contenedor);
}