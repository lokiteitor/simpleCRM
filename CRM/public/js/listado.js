jQuery(document).ready(function($) {
    
    var ruta;
    var tipoElemento;
    var cookiepath;
    var edicion;
    var vercookiepath;
    var ver;

    data = {}
    pagina = 10;
    nextpag = pagina + 10
    $(".numactual").text(pagina);
    $(".numnext").text(nextpag);
    $(".numprev").text(pagina-10);

    if (window.location.pathname == "/ver/prospectos") {
        ruta = "/obtener/contactos";
        data.tipoElemento = "prospecto"
        data.pagina = pagina;
        data.nextpag = nextpag;
        data.orderby = $('select[name="orden"]').val();
        data.here = window.location.pathname
        cookiepath = ";path=/editar/prospecto/"
        edicion = "/editar/prospecto/"
        vercookiepath = ";path=/detalles/prospecto/"
        ver = "/detalles/prospecto/"        

    }

    if (window.location.pathname == "/ver/clientes") {
        ruta = "/obtener/clientes";
        data.tipoElemento = "cliente"
        data.here = window.location.pathname
        data.pagina = pagina;
        data.nextpag = nextpag;
        data.orderby = $('select[name="orden"]').val();
        cookiepath = ";path=/editar/cliente/"
        edicion = "/editar/cliente/"
        vercookiepath = ";path=/detalles/cliente/"
        ver = "/detalles/cliente/"            
    }
    if (window.location.pathname == "/ver/cuentas") {
        ruta = "/obtener/cuentas";
        tipoElemento = "cuenta"
        data.pagina = pagina;
        data.nextpag = nextpag;
        data.here = window.location.pathname
        data.orderby = $('select[name="orden"]').val();
        cookiepath = ";path=/editar/cuenta/"
        edicion = "/editar/cuenta/"
        vercookiepath = ";path=/detalles/cuenta/"
        ver = "/detalles/cuenta/"            
    }    
    if (window.location.pathname == "/ver/campanas") {
        ruta = "/obtener/campanas";
        data.here = window.location.pathname
        data.tipoElemento = "campaña"
        data.pagina = pagina;
        data.nextpag = nextpag;
        data.orderby = $('select[name="orden"]').val();
        cookiepath = ";path=/editar/campana/"
        edicion = "/editar/campana/"
        vercookiepath = ";path=/detalles/campana/"
        ver = "/detalles/campana/"
        data.vertodas = $('input[name="verinactivas"]').prop('checked')
        $('input[name="verinactivas"]').change(function(event) {
            $("tbody").empty();
            data.pagina = 10;
            data.nextpag = 20
            data.vertodas = $(this).prop('checked')
            // obtener los datos
            ServerData = getDataServer(ruta,data);
            // dibujar los datos 
            for (var i = 0; i < ServerData.length; i++) {
                construirFila(ServerData[i],tipoElemento);
            };
            $(".numactual").text(data.pagina);
            $(".numnext").text(data.pagina+10);
            $(".numprev").text(data.pagina-10);            

        });

    }  

    // obtener los datos
    ServerData = getDataServer(ruta,data);
    // dibujar los datos 
    for (var i = 0; i < ServerData.length; i++) {
        construirFila(ServerData[i],tipoElemento);
    };

    // recargar cuando cambie el orden
    $('select[name="orden"]').change(function(event) {

        $("tbody").empty();
        data.pagina = 10;
        data.nextpag = 20
        data.orderby = $(this).val();
        // obtener los datos
        ServerData = getDataServer(ruta,data);
        // dibujar los datos 
        for (var i = 0; i < ServerData.length; i++) {
            construirFila(ServerData[i],tipoElemento);
        };
        $(".numactual").text(data.pagina);
        $(".numnext").text(data.pagina+10);
        $(".numprev").text(data.pagina-10);        
    });

    // avanzar el paginado
    $('a[name="prev"]').click(function(event) {
        event.preventDefault();
        if (pagina - 10 != 0) {
            $("tbody").empty();
            data.nextpag = nextpag - 10;
            data.pagina = pagina -10;
            pagina -= 10;
            ServerData = getDataServer(ruta,data);
            // dibujar los datos 
            for (var i = 0; i < ServerData.length; i++) {
                construirFila(ServerData[i],tipoElemento);
            };
            $(".numactual").text(data.pagina);
            $(".numnext").text(data.pagina+10);
            $(".numprev").text(data.pagina-10);            
        }

    });
    $('a[name="next"]').click(function(event) {
        event.preventDefault();
        $("tbody").empty();
        data.nextpag = nextpag +10;
        data.pagina = pagina +10;
        pagina += 10;        
        ServerData = getDataServer(ruta,data);
        // dibujar los datos 
        for (var i = 0; i < ServerData.length; i++) {
            construirFila(ServerData[i],tipoElemento);
        };
        $(".numactual").text(data.pagina);
        $(".numnext").text(data.pagina+10);
        $(".numprev").text(data.pagina-10);        
    });
    // remover los campos seleccionados
    $('button[name="eliminar"]').click(function(event) {
        event.preventDefault();
        // obtener los datos
        var candidatos = new Array();
        var nombresCandidatos = new Array();
        $('input[type="checkbox"]:checked').each(function(index, el) {
            candidatos.push($(el).val());            
            nombresCandidatos.push($(el).parents("tr").find('th[name="nombre"]').text());
            
            
        });
        // avisar al usuario si desea elimanarlos
        var r = confirm("Desea eliminar los siguientes registros?:" +nombresCandidatos.join(","));
        if (r) {
            // eliminar y recargar la pagina
            data.delete = candidatos;
            $("tbody").empty();
            ServerData = getDataServer(ruta,data);
            for (var i = 0; i < ServerData.length; i++) {
                construirFila(ServerData[i],tipoElemento);
            };
            $(".numactual").text(data.pagina);
            $(".numnext").text(data.pagina+10);
            $(".numprev").text(data.pagina-10);              
        }
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
        
        var registros = new Array();
        $('input[type="checkbox"]:checked').each(function(index, el) {
            registros.push($(el).val());            
        });
        var redireccion = window.location.origin + edicion + registros[0];
        registros.join(",");
        // crear la cookie
        document.cookie = "registros="+encodeURIComponent(registros) + cookiepath;
        // enviar al primer registro en la lista
        window.location = redireccion;        
    });
    $('button[name="ver"]').click(function(event) {
        // si presiona editar obtener las url's de los campos seleccionados 
        // para guardarlos en una cookie
        event.preventDefault();
        
        var registros = new Array();
        $('input[type="checkbox"]:checked').each(function(index, el) {
            registros.push($(el).val());            
        });
        var redireccion = window.location.origin + ver + registros[0];
        registros.join(",");
        // crear la cookie
        document.cookie = "registros="+encodeURIComponent(registros) + vercookiepath;
        // enviar al primer registro en la lista
        window.location = redireccion;        
    });


});

function getDataServer(url,data){
    console.log(data)
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
        if (keys[i] == "creacion" || keys[i] == 'inicio' || keys[i] == 'fin') {

            var d = new Date(data.creacion.date)
            th = '<th name="' + keys[i] + '">' + d.toLocaleDateString()  + '</th>';    
            contenido.push(th);        
            continue;
        }
        if (keys[i] == 'activa') {
            if (data.activa == true) {
                estado = 'Activa';
            }
            else{
                estado = 'Inactiva';
            }
            th = '<th name="' + keys[i] + '">' + estado  + '</th>';    
            contenido.push(th);
            continue        

        }

        th = '<th name="' + keys[i] + '">' + data[keys[i]] + '</th>';
        contenido.push(th);        
    };
    contenido = contenido.join("");
    
    $(contenido).appendTo($contenedor);
    
    $('table[name="listado"] tbody').append($contenedor);
}