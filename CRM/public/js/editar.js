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

    if (window.location.pathname == "/editar/oportunidad/"+actual) {
        registros = actual.toString();
        var data = {"id":actual};
        ServerData = getDataFromServer("/obtener/oportunidad/",data)
        salida = "/ver/oportunidades/"
        seccion = "/editar/oportunidad/"
    };

    if (window.location.pathname == "/editar/tarea/"+actual) {
        registros = actual.toString();
        var data = {"id":actual};
        ServerData = getDataFromServer("/obtener/tarea/",data)
        salida = "/ver/tareas/"
        seccion = "/editar/tarea/"
    };

    if (window.location.pathname == "/editar/evento/"+actual) {
        registros = actual.toString();
        var data = {"id":actual};
        ServerData = getDataFromServer("/obtener/evento/",data)
        salida = "/ver/eventos/"
        seccion = "/editar/evento/"
    };        

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
    // cargar los datos del formulario
    if (window.location.pathname == "/editar/prospecto/"+actual) {
        var data = {"id":actual};
        ServerData = getDataFromServer("/obtener/prospecto/",data)
        salida = "/ver/prospectos/"
        seccion = "/editar/prospecto/"
    };
    if (window.location.pathname == "/editar/cliente/"+actual) {
        var data = {"id":actual};
        ServerData = getDataFromServer("/obtener/cliente/",data)
        salida = "/ver/clientes/"
        seccion = "/editar/cliente/"
    };
    if (window.location.pathname == "/editar/cuenta/"+actual) {
        var data = {"id":actual};
        ServerData = getDataFromServer("/obtener/cuenta/",data)
        salida = "/ver/cuentas/"
        seccion = "/editar/cuenta/"
    }; 
    if (window.location.pathname == "/editar/campana/"+actual) {
        var data = {"id":actual};
        ServerData = getDataFromServer("/obtener/campana/",data)
        salida = "/ver/campanas/"
        seccion = "/editar/campana/"
    }; 
    $('form.form-horizontal').append('<input type="hidden" name="_id">')
    $('input[name="_id"]').val(actual);
    llenarFormulario(ServerData);



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


function getDataFromServer (ruta,data) {
    // devuelve un arreglo con los objetos json
    var rtrn;

    $.ajax({
        url: ruta,
        type: 'GET',
        dataType: 'json',
        data: data,
        async:false,
    })
    .done(function(json) {
        rtrn = json;
    })
    .fail(function(json) {
        alert("Error al conectar al servidor")
    })
    .always(function(json) {
    });
    return rtrn;
}

function llenarFormulario (data) {
    var keys = Object.keys(data);       

    for (var i = 0; i < keys.length; i++) {
        var campo = '[name="'+ keys[i] + '"]';
    
        if ($(campo).is('input[type="checkbox"]')) {
            $(campo).prop('checked', data[keys[i]]);
            if ($(campo).attr('name') == 'recordatorio' && data[keys[i]] == 1 ) {
                $('[name="divrecordatorio"]').show('200');
            }
            else if ($(campo).attr('name') == 'repetir' && data[keys[i]] == 1) {
                $('[name="divrepetir"]').show('200');
            }
        }
        else{
            $(campo).val(data[keys[i]]);
        }        
    };
}