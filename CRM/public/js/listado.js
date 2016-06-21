jQuery(document).ready(function($) {
    
    var ruta;
    var tipoElemento;
    data = {}
    pagina = 10;
    nextpag = pagina + 10
    $(".numactual").text(pagina);
    $(".numnext").text(nextpag);
    $(".numprev").text(pagina-10);

    if (window.location.pathname == "/ver/clientes") {
        ruta = "/obtener/clientes";
        tipoElemento = "cliente"
        data.pagina = pagina;
        data.nextpag = nextpag;
        data.orderby = $('select[name="orden"]').val();

    }

    if (window.location.pathname == "/ver/contactos") {
        ruta = "/obtener/contactos";
        tipoElemento = "contacto"
        data.pagina = pagina;
        data.nextpag = nextpag;
        data.orderby = $('select[name="orden"]').val();

    }

    // obtener los datos
    ServerData = getDataServer(ruta,data);
    // dibujar los datos 
    for (var i = 0; i < ServerData.length; i++) {
        construirFila(ServerData[i],tipoElemento);
    };

    $('a[name="prev"]').click(function(event) {
        event.preventDefault();
        if (pagina - 10 != 0) {
            $("tbody").empty();
            data.nextpag = pagina - 10;
            data.pagina = pagina;
            pagina -= 10;
            ServerData = getDataServer(ruta,data);
            // dibujar los datos 
            for (var i = 0; i < ServerData.length; i++) {
                construirFila(ServerData[i],tipoElemento);
            };
            $(".numactual").text(pagina);
            $(".numnext").text(pagina+10);
            $(".numprev").text(pagina-10);            
        }

    });
    $('a[name="next"]').click(function(event) {
        event.preventDefault();
        $("tbody").empty();
        data.nextpag = pagina + 10;
        data.pagina = pagina;
        pagina += 10;        
        ServerData = getDataServer(ruta,data);
        // dibujar los datos 
        for (var i = 0; i < ServerData.length; i++) {
            construirFila(ServerData[i],tipoElemento);
        };
        $(".numactual").text(pagina);
        $(".numnext").text(pagina+10);
        $(".numprev").text(pagina-10);        
    });
    // si se seleccionan todos
    $('input[name="check-all"]').change(function(event) {
        if ($(this).prop('checked')) {
            $("input:checkbox").each(function(index, el) {
                $(el).prop('checked', true);
            });
        }
        else{
            $("input:checkbox").each(function(index, el) {
                $(el).prop('checked', false);
            });            
        }        
    });

    $('button[name="editar"]').click(function(event) {
        // si presiona editar obtener las url's de los campos seleccionados 
        // para guardarlos en una cookie
        event.preventDefault();
        console.log('editar')
        var registros = new Array();
        $('input[type="checkbox"]:checked').each(function(index, el) {
            registros.push($(el).val());
        });
        var redireccion = window.location.origin + "/editar/cliente/" + registros[0];
        registros.join(",");
        // crear la cookie
        document.cookie = "registros="+encodeURIComponent(registros) + ";path=/editar/cliente/";
        // enviar al primer registro en la lista
        window.location = redireccion;
        
    });
});

function getDataServer(url,data){
    var rtrn;
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        data: data,
        async: false
    })
    .done(function(json) {
        console.log(json);
        rtrn = json
    })
    .fail(function() {
        console.log("error");
        alert("Error al conectar con el servidor")
    })
    .always(function() {
        console.log("complete");
    });
    return rtrn;
}


function construirFila(data,tipo) {
    // objeto que constituye el nombre_campo:valor
    // modificar los campos del objeto
    var keys = Object.keys(data);
    console.log(data);
    var $contenedor = $("<tr></tr>");
    var contenido = new Array();

    var check =  '<th><input type="checkbox" value="'+ data.id + '"></th>'
    contenido.push(check);

    for (var i = 0; i < keys.length; i++) {
        if (keys[i] == "id") {
            continue;   
        }
        th = "<th>" + data[keys[i]] + "</th>";
        contenido.push(th);        
    };
    contenido = contenido.join("");
    console.log(contenido);
    $(contenido).appendTo($contenedor);
    console.log($contenedor)
    $('table[name="listado"] tbody').append($contenedor);
}



