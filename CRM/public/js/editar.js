jQuery(document).ready(function($) {
    //ha esta pagina se proviene de /ver/clientes por lo tanto se asume que 
    //se tiene un cookie con los perfiles a editar

    //borrar el id correspondiente a esta pagina
    var registros = readCookie("registros");
    var actual = window.location.pathname.split("/");
    actual = actual[actual.length - 1];
    var indice = -1;
    var ServerData;

    if (registros != null) {
        registros = registros.split(",");        
        indice = registros.indexOf(actual);
        
    }
    else{
        alert("Error durante la navegacion el cliente no exite");
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
    // cargar los datos del formulario
    if (window.location.pathname == "/editar/cliente/"+actual) {
        var data = {"id":actual};
        ServerData = getDataFromServer("/obtener/cliente/",data)
    };
    llenarFormulario(ServerData);



    console.log(registros)
    // moverse entre los registros
    $('button[name="next"]').click(function(event) {
        event.preventDefault();
        // buscar el elemento actual y pasar al siguiente
        var destino = window.location.origin + "/editar/cliente/" + registros[indice+1];
        window.location = destino;
    });
    $('button[name="prev"]').click(function(event) {
        event.preventDefault();
        // buscar el elemento actual y pasar al siguiente
        var destino = window.location.origin + "/editar/cliente/" + registros[indice-1];
        window.location = destino;
    });    

    // al guardar algun registro eliminar ese elemento de la lista
    $('button[name="salir"]').click(function(event) {
        borrarCookie("registros");
        window.location = window.location.origin + "/ver/clientes/"
    });

});


function getDataFromServer (ruta,data) {
    // devuelve un arreglo con los objetos json
    console.log(data);
    var rtrn;

    $.ajax({
        url: ruta,
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
        console.log(json);
        alert("Error al conectar al servidor")
    })
    .always(function(json) {
        console.log("complete");
    });
    return rtrn;
}

function llenarFormulario (data) {
    console.log(data)
    var keys = Object.keys(data);       

    for (var i = 0; i < keys.length; i++) {
        var campo = '[name="'+ keys[i] + '"]';
        console.log(campo)
    
        if ($(campo).is('input[type="checkbox"]')) {
            $(campo).prop('checked', data[keys[i]]);
            console.log(data[keys[i]])
        }
        else{
            $(campo).val(data[keys[i]]);
        }        
    };
}